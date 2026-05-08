// Import required modules
const crypto = require('crypto');

// Define otp utils
class OtpUtils {
  constructor() {}

  // Generate otp function
  generateOtp(length) {
    return crypto.randomInt(100000, 999999).toString().substring(0, length);
  }

  // Verify otp function
  verifyOtp(otp, input) {
    return otp === input;
  }
}

// Export otp utils
module.exports = OtpUtils;
