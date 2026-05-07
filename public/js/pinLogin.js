const pinLength = 5;
const pinInput = document.getElementById('pin-input');
const loginButton = document.getElementById('login-button');
const error_message = document.getElementById('error-message');

let pin = '';

pinInput.addEventListener('input', (e) => {
  const digit = e.target.value;
  if (digit.length > pinLength) {
    e.target.value = pin;
  } else {
    pin = digit;
    e.target.value = Array(digit.length + 1).join('*');
  }
});

loginButton.addEventListener('click', () => {
  if (pin.length !== pinLength) {
    error_message.textContent = 'Incorrect PIN length';
  } else {
    // Send request to server to verify PIN
    fetch('/verify-pin', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ pin }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Login successful, redirect to dashboard
          window.location.href = '/dashboard';
        } else {
          error_message.textContent = 'Incorrect PIN, please try again';
          pinInput.value = '';
          pin = '';
        }
      })
      .catch((error) => console.error(error));
  }
});
