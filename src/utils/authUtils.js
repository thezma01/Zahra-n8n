class AuthUtils {
  generateOTP() {
    // TO DO: implement generate OTP logic
    return '123456';
  }

  sendOTP(email, otp) {
    // TO DO: implement send OTP logic
    console.log(`OTP sent to ${email}: ${otp}`);
  }

  verifyOTP(otp) {
    // TO DO: implement verify OTP logic
    return true;
  }
}

module.exports = new AuthUtils();
