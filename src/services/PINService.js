const generateOtp = () => {
  const otp = Math.floor(100000 + Math.random() * 900000);
  return otp.toString();
};

const validatePin = (userPin, inputPin) => {
  return userPin === inputPin;
};

const validateOtp = (otp) => {
  // todo: implement otp validation
  return true;
};

module.exports = { generateOtp, validatePin, validateOtp };
