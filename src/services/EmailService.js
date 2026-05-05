'use strict';

const nodemailer = require('nodemailer');
const authConfig = require('../config/auth.config');

class EmailService {
  constructor() {
    this.transporter = nodemailer.createTransport({
      host: process.env.SMTP_HOST || 'smtp.mailtrap.io',
      port: parseInt(process.env.SMTP_PORT, 10) || 587,
      secure: process.env.SMTP_SECURE === 'true',
      auth: {
        user: process.env.SMTP_USER || '',
        pass: process.env.SMTP_PASS || '',
      },
    });
  }

  /**
   * Build the OTP email HTML body.
   * @param {object} params
   * @param {string} params.userName
   * @param {string} params.otp
   * @param {number} params.expiryMinutes
   * @returns {string}
   */
  buildOtpEmailHtml({ userName, otp, expiryMinutes }) {
    const primaryColor = authConfig.ui.primaryColor;
    const appName = authConfig.ui.appName;

    return `
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PIN Reset OTP</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="520" cellpadding="0" cellspacing="0"
          style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);">
          <!-- Header -->
          <tr>
            <td style="background:${primaryColor};padding:28px 40px;text-align:center;">
              <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:700;letter-spacing:0.5px;">
                ${appName}
              </h1>
              <p style="margin:6px 0 0;color:rgba(255,255,255,0.85);font-size:14px;">
                PIN Reset Request
              </p>
            </td>
          </tr>
          <!-- Body -->
          <tr>
            <td style="padding:36px 40px;">
              <p style="margin:0 0 16px;color:#333;font-size:16px;">
                Hi <strong>${userName}</strong>,
              </p>
              <p style="margin:0 0 24px;color:#555;font-size:15px;line-height:1.6;">
                We received a request to reset your POS PIN. Use the OTP code below to proceed.
                This code is valid for <strong>${expiryMinutes} minutes</strong>.
              </p>
              <!-- OTP Box -->
              <div style="text-align:center;margin:0 0 28px;">
                <div style="display:inline-block;background:#f0fdf4;border:2px solid ${primaryColor};
                  border-radius:10px;padding:18px 40px;">
                  <span style="font-size:38px;font-weight:800;letter-spacing:10px;color:${primaryColor};">
                    ${otp}
                  </span>
                </div>
              </div>
              <p style="margin:0 0 12px;color:#888;font-size:13px;line-height:1.6;">
                If you did not request a PIN reset, please ignore this email.
                Your PIN will remain unchanged.
              </p>
              <hr style="border:none;border-top:1px solid #eee;margin:24px 0;" />
              <p style="margin:0;color:#aaa;font-size:12px;text-align:center;">
                This is an automated message from ${appName}. Do not reply to this email.
              </p>
            </td>
          </tr>
          <!-- Footer -->
          <tr>
            <td style="background:#f9f9f9;padding:16px 40px;text-align:center;">
              <p style="margin:0;color:#ccc;font-size:11px;">
                © ${new Date().getFullYear()} ${appName}. All rights reserved.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>`.trim();
  }

  /**
   * Send OTP email to a user.
   * @param {object} params
   * @param {string} params.toEmail
   * @param {string} params.userName
   * @param {string} params.otp
   * @returns {Promise<void>}
   */
  async sendOtpEmail({ toEmail, userName, otp }) {
    const { expiryMinutes } = authConfig.otp;
    const { otpSubject, from, fromName } = authConfig.email;

    const html = this.buildOtpEmailHtml({ userName, otp, expiryMinutes });

    await this.transporter.sendMail({
      from: `"${fromName}" <${from}>`,
      to: toEmail,
      subject: otpSubject,
      html,
    });
  }
}

module.exports = new EmailService();
