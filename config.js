const config = {
  port: 3000,
  dbUrl: 'mongodb://localhost:27017/pos-system',
  pinLength: 5,
  otpLength: 6,
  otpExpiry: 5, // in minutes
  emailTemplate: 'Hello, your OTP is {{otp}}',
  primaryColor: '#34C759' // green primary theme
};

module.exports = config;
