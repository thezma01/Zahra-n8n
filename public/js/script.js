// Get elements
const pinInput = document.getElementById('pin');
const loginButton = document.getElementById('login-button');
const forgotPinButton = document.getElementById('forgot-pin-button');
const errorMessage = document.getElementById('error-message');

// Add event listeners
loginButton.addEventListener('click', checkPin);
forgotPinButton.addEventListener('click', forgotPin);

// Function to check PIN
function checkPin() {
  const pin = pinInput.value;
  if (pin.length === 5) {
    // Send request to server to verify PIN
    // For now, just log the PIN to the console
    console.log('PIN:', pin);
  } else {
    errorMessage.textContent = 'Invalid PIN';
  }
}

// Function to handle forgot PIN
function forgotPin() {
  // Send request to server to send OTP
  // For now, just log a message to the console
  console.log('Forgot PIN clicked');
}
