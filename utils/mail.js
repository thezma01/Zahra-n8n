const nodemailer = require('nodemailer');

const sendMail = async (to, subject, text, html) => {
  const transporter = nodemailer.createTransport({
    host: 'smtp.example.com',
    port: 587,
    secure: false, // or 'STARTTLS'
    auth: {
      user: 'username',
      pass: 'password',
    },
  });

  const mailOptions = {
    from: 'sender@example.com',
    to,
    subject,
    text,
    html,
  };

  try {
    await transporter.sendMail(mailOptions);
  } catch (error) {
    console.error(error);
  }
};

module.exports = { sendMail };
