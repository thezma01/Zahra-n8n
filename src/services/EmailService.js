'use strict';

const nodemailer = require('nodemailer');
const authConfig = require('../config/auth.config');

class EmailService {
  /**
   * Create and return a nodemailer transporter based on env config.
   * @returns {import('nodemailer').Transporter}
   */
  static _createTransporter() {
    // Support SMTP or well-known services (Gmail, SendGrid, etc.)
    const host = process.env.EMAIL_HOST;
    const service = process.env.EMAIL_SERVICE; // e.g. 'gmail'

    if (service) {
      return nodemailer.createTransport({
        service,
        auth: {
          user: process.env.EMAIL_USER,
          pass: process.env.EMAIL_PASS,
        },
      });
    }

    return nodemailer.createTransport({
      host: host || 'localhost',
      port: parseInt(process.env.EMAIL_PORT, 10) || 587,
      secure: process.env.EMAIL_SECURE === 'true',
      auth: process.env.EMAIL_USER
        ? {
            user: process.env.EMAIL_USER,
            pass: process.env.EMAIL_PASS,
          }
        : undefined,
    });
  }

  /**
   * Build the OTP email HTML body.
   * Uses configurable template (default or custom).
   * @param {{ userName: string, otp: string }} params
   * @returns {string}
   */
  static _buildOtpHtml({ userName, otp }) {
    const appName = authConfig.ui.appName;
    const expiryMinutes = authConfig.otp.expiryMinutes;
    const primaryColor = authConfig.ui.primaryColor;
    const template = authConfig.email.otpTemplate;

    // Custom template override via environment (basic string interpolation)
    if (template && template !== 'default' && process.env.OTP_EMAIL_HTML_TEMPLATE) {
      return process.env.OTP_EMAIL_HTML_TEMPLATE
        .replace('{{userName}}', userName)
        .replace('{{otp}}', otp)
        .replace('{{appName}}', appName)
        .replace('{{expiryMinutes}}', String(expiryMinutes));
    }

    // Default built-in template
    return `
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>${authConfig.email.otpSubject}</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f5;font-family:Arial,Helvetica,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f5;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="520" cellpadding="0" cellspacing="0"
               style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
          <!-- Header -->
          <tr>
            <td style="background:${primaryColor};padding:32px 40px;text-align:center;">
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
            <td style="padding:40px 40px 32px;">
              <p style="margin:0 0 16px;color:#374151;font-size:16px;">
                Hello, <strong>${userName}</strong>
              </p>
              <p style="margin:0 0 24px;color:#6b7280;font-size:15px;line-height:1.6;">
                You requested a PIN reset for your ${appName} account.
                Use the one-time code below to proceed. This code expires in
                <strong>${expiryMinutes} minute(s)</strong>.
              </p>
              <!-- OTP Box -->
              <div style="background:#f9fafb;border:2px dashed ${primaryColor};border-radius:10px;
                          padding:28px 20px;text-align:center;margin:0 0 28px;">
                <p style="margin:0 0 8px;color:#6b7280;font-size:13px;text-transform:uppercase;
                           letter-spacing:1px;font-weight:600;">Your OTP Code</p>
                <p style="margin:0;color:#111827;font-size:42px;font-weight:800;
                           letter-spacing:12px;font-family:'Courier New',monospace;">
                  ${otp}
                </p>
              </div>
              <p style="margin:0 0 12px;color:#9ca3af;font-size:13px;line-height:1.5;">
                If you did not request a PIN reset, please ignore this email.
                Your PIN will remain unchanged.
              </p>
              <p style="margin:0;color:#9ca3af;font-size:13px;">
                For security, do not share this code with anyone.
              </p>
            </td>
          </tr>
          <!-- Footer -->
          <tr>
            <td style="background:#f9fafb;padding:20px 40px;border-top:1px solid #e5e7eb;text-align:center;">
              <p style="margin:0;color:#9ca3af;font-size:12px;">
                &copy; ${new Date().getFullYear()} ${appName}. All rights reserved.
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
    `.trim();
  }

  /**
   * Send OTP email to a user.
   * @param {{ toEmail: string, userName: string, otp: string }} params
   * @returns {Promise<void>}
   */
  static async sendOtpEmail({ toEmail, userName, otp }) {
    const transporter = EmailService._createTransporter();

    const mailOptions = {
      from: `"${authConfig.email.fromName}" <${authConfig.email.from}>`,
      to: toEmail,
      subject: authConfig.email.otpSubject,
      html: EmailService._buildOtpHtml({ userName, otp }),
      text: `Hello ${userName},\n\nYour OTP code is: ${otp}\n\nThis code expires in ${authConfig.otp.expiryMinutes} minute(s).\n\nIf you did not request this, please ignore this email.\n\n${authConfig.ui.appName}`,
    };

    try {
      const info = await transporter.sendMail(mailOptions);
      if (process.env.NODE_ENV !== 'production') {
        console.log(`[EmailService] OTP email sent to ${toEmail} — MessageId: ${info.messageId}`);
        // Log Ethereal preview URL in development
        const previewUrl = nodemailer.getTestMessageUrl(info);
        if (previewUrl) {
          console.log(`[EmailService] Preview URL: ${previewUrl}`);
        }
      }
    } catch (err) {
      console.error(`[EmailService] Failed to send OTP email to ${toEmail}:`, err.message);
      throw new Error('Failed to send OTP email. Please try again.');
    }
  }

  /**
   * Create an Ethereal test account transporter for development/testing.
   * Call once at app startup in development mode.
   * @returns {Promise<void>}
   */
  static async setupTestAccount() {
    if (process.env.NODE_ENV === 'production') return;
    if (process.env.EMAIL_HOST || process.env.EMAIL_SERVICE) return;

    try {
      const testAccount = await nodemailer.createTestAccount();
      process.env.EMAIL_HOST = 'smtp.ethereal.email';
      process.env.EMAIL_PORT = '587';
      process.env.EMAIL_USER = testAccount.user;
      process.env.EMAIL_PASS = testAccount.pass;
      console.log(`[EmailService] Ethereal test account created: ${testAccount.user}`);
    } catch (err) {
      console.warn('[EmailService] Could not create Ethereal test account:', err.message);
    }
  }
}

module.exports = EmailService;
