// Get elements
const pinInput = document.getElementById('pin');
const submitButton = document.getElementById('submit-pin');
const errorMessage = document.getElementById('error-message');
const forgotPinLink = document.getElementById('forgot-pin');

// Add event listeners
submitButton.addEventListener('click', submitPin);
forgotPinLink.addEventListener('click', forgotPin);

// Submit pin function
function submitPin() {
  const pin = pinInput.value;
  // Validate pin and proceed with login
  if (pin.length === 5) {
    // Call login API
    console.log('Pin submitted:', pin);
  } else {
    errorMessage.textContent = 'Invalid PIN';
  }
}

// Forgot pin function
function forgotPin() {
  // Call forgot pin API
  console.log('Forgot PIN clicked');
}
