let pin = '';
let users = [
  { name: 'John Doe', role: 'Manager' },
  { name: 'Jane Doe', role: 'Cashier' }
];

document.addEventListener('DOMContentLoaded', function() {
  const userList = document.getElementById('user-list');
  users.forEach(user => {
    const li = document.createElement('li');
    li.textContent = user.name + ' (' + user.role + ')';
    userList.appendChild(li);
  });

  const pinInput = document.getElementById('pin');
  const forgotPinButton = document.getElementById('forgot-pin');
  const errorMessage = document.getElementById('error-message');

  forgotPinButton.addEventListener('click', function() {
    // TODO: implement forgot PIN functionality
  });

  function enterPinDigit(digit) {
    pin += digit;
    pinInput.value = Array(pin.length).fill('*').join('');
    if (pin.length === 5) {
      // TODO: implement PIN verification
    }
  }
});
