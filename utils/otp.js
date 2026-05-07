const otpGenerator = require('otp-generator');

const generateOtp = () => {
  return otpGenerator.generate(6, { upperCase: false, specialChars: false });
};

const verifyOtp = (otp, userOtp) => {
  return otp === userOtp;
};

module.exports = { generateOtp, verifyOtp };
