'use strict';

const nodemailer = require('nodemailer');
const authConfig = require('../config/auth.config');
const logger = require('../utils/logger');

class EmailService {
  constructor() {
    this.transporter = this._createTransporter();
  }

  _createTransporter() {
    const config = {
      host: process.env.SMTP_HOST || 'smtp.gmail.com',
      port: parseInt(process.env.SMTP_PORT, 10) || 587,
      secure: process.env.SMTP_SECURE === 'true',
      auth: {
        user: process.env.SMTP_USER || '',
        pass: process.env.SMTP_PASS || '',
      },
    };

    if (process.env.NODE_ENV === 'test' || process.env.NODE_ENV === 'development') {
      return nodemailer.createTransport({
        jsonTransport: true,
      });
    }

    return nodemailer.createTransport(config);
  }

  _buildEmailBody(otp, expiryMinutes) {
    const template = authConfig.email.template.body;
    return template
      .replace('{{OTP}}', otp)
      .replace('{{EXPIRY}}', expiryMinutes);
  }

  _buildHtmlBody(otp, expiryMinutes, userName) {
    const primaryColor = authConfig.ui.primaryColor;
    return `
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PIN Reset OTP</title>
</head>
<body style="margin:0;padding:0;background:#f9fafb;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9fafb;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="500" cellpadding="0" cellspacing="0"
          style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);">
          <tr>
            <td style="background:${primaryColor};padding:32px;text-align:center;">
              <h1 style="color:#ffffff;margin:0;font-size:24px;font-weight:700;">POS System</h1>
              <p style="color:#dcfce7;margin:8px 0 0;font-size:14px;">PIN Reset Request</p>
            </td>
          </tr>
          <tr>
            <td style="padding:40px 32px;">
              <p style="color:#374151;font-size:16px;margin:0 0 16px;">Hello ${userName},</p>
              <p style="color:#6b7280;font-size:15px;line-height:1.6;margin:0 0 32px;">
                You requested a PIN reset. Use the OTP below to proceed.
                This code will expire in <strong>${expiryMinutes} minutes</strong>.
              </p>
              <div style="background:#f0fdf4;border:2px solid ${primaryColor};border-radius:12px;
                          padding:24px;text-align:center;margin:0 0 32px;">
                <p style="color:#6b7280;font-size:13px;margin:0 0 8px;text-transform:uppercase;
                           letter-spacing:1px;font-weight:600;">Your OTP Code</p>
                <span style="color:${primaryColor};font-size:48px;font-weight:800;
                             letter-spacing:12px;">${otp}</span>
              </div>
              <p style="color:#9ca3af;font-size:13px;margin:0;">
                If you did not request this, please ignore this email.
                Do not share this OTP with anyone.
              </p>
            </td>
          </tr>
          <tr>
            <td style="background:#f9fafb;padding:20px 32px;text-align:center;border-top:1px solid #e5e7eb;">
              <p style="color:#9ca3af;font-size:12px;margin:0;">
                © ${new Date().getFullYear()} POS System. All rights reserved.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>`;
  }

  async sendOTPEmail(toEmail, userName, otp) {
    const expiryMinutes = authConfig.otp.expiryMinutes;
    const subject = authConfig.email.template.subject;
    const textBody = this._buildEmailBody(otp, expiryMinutes);
    const htmlBody = this._buildHtmlBody(otp, expiryMinutes, userName);

    const mailOptions = {
      from: `"${authConfig.email.fromName}" <${authConfig.email.from}>`,
      to: toEmail,
      subject,
      text: textBody,
      html: htmlBody,
    };

    try {
      const info = await this.transporter.sendMail(mailOptions);
      logger.info(`OTP email sent to ${toEmail}`, { messageId: info.messageId });
      return { success: true, messageId: info.messageId };
    } catch (error) {
      logger.error('Failed to send OTP email', { error: error.message, toEmail });
      throw new Error('Failed to send OTP email. Please try again.');
    }
  }

  async verifyConnection() {
    try {
      if (process.env.NODE_ENV === 'test' || process.env.NODE_ENV === 'development') {
        return true;
      }
      await this.transporter.verify();
      return true;
    } catch (error) {
      logger.error('Email transporter verification failed', { error: error.message });
      return false;
    }
  }
}

module.exports = new EmailService();
