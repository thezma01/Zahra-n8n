const nodemailer = require('nodemailer');

const sendEmail = async (to, subject, text) => {
  try {
    const transporter = nodemailer.createTransport({
      host: 'smtp.example.com',
      port: 587,
      secure: false,
      auth: {
        user: 'your-email@example.com',
        pass: 'your-password'
      }
    });

    const mailOptions = {
      from: 'your-email@example.com',
      to,
      subject,
      text
    };

    await transporter.sendMail(mailOptions);
  } catch (error) {
    console.error(error);
  }
};

module.exports = sendEmail;
