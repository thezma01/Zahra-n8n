const nodemailer = require('nodemailer');

const sendOtp = (email, otp) => {
  const transporter = nodemailer.createTransport({
    host: 'smtp.example.com',
    port: 587,
    secure: false, // or 'STARTTLS'
    auth: {
      user: 'username',
      pass: 'password'
    }
  });

  const mailOptions = {
    from: 'sender@example.com',
    to: email,
    subject: 'Otp for pin reset',
    text: `Your otp is ${otp}`
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      return console.log(error);
    }
    console.log('Email sent: ' + info.response);
  });
};

module.exports = { sendOtp };
