const nodemailer = require('nodemailer');

exports.validatePin = (userPin, inputPin) => {
  return userPin === inputPin;
};

exports.generateOtp = () => {
  return Math.floor(100000 + Math.random() * 900000);
};

exports.sendOtpEmail = (email, otp) => {
  const transporter = nodemailer.createTransport({
    host: 'smtp.gmail.com',
    port: 587,
    secure: false,
    auth: {
      user: 'your-email@gmail.com',
      pass: 'your-password'
    }
  });

  const mailOptions = {
    from: 'your-email@gmail.com',
    to: email,
    subject: 'OTP for PIN reset',
    text: `Your OTP is: ${otp}`
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.log(error);
    } else {
      console.log('Email sent: ' + info.response);
    }
  });
};
