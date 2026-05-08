// Import required modules
const nodemailer = require('nodemailer');

// Define email utils
class EmailUtils {
  constructor() {
    this.transporter = nodemailer.createTransport({
      host: 'smtp.example.com',
      port: 587,
      secure: false, // or 'STARTTLS'
      auth: {
        user: 'username',
        pass: 'password'
      }
    });
  }

  // Send email function
  sendEmail(to, subject, text, html) {
    const mailOptions = {
      from: 'sender@example.com',
      to: to,
      subject: subject,
      text: text,
      html: html
    };

    this.transporter.sendMail(mailOptions, (error, info) => {
      if (error) {
        console.log(error);
      } else {
        console.log('Email sent: ' + info.response);
      }
    });
  }
}

// Export email utils
module.exports = EmailUtils;
