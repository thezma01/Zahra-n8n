const pinInput = document.getElementById('pin');
const submitPinButton = document.getElementById('submit-pin');
const errorMessage = document.getElementById('error-message');
const forgotPinLink = document.getElementById('forgot-pin');

submitPinButton.addEventListener('click', () => {
  const pin = pinInput.value;
  if (pin.length !== 5) {
    errorMessage.textContent = 'Invalid PIN length';
  } else {
    // send pin to server for verification
    console.log('PIN submitted:', pin);
  }
});

forgotPinLink.addEventListener('click', () => {
  // send forgot pin request to server
  console.log('Forgot PIN link clicked');
});
