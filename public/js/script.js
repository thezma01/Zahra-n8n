const pinInput = document.getElementById('pin');
const userList = document.getElementById('user-list');
const forgotPinButton = document.getElementById('forgot-pin');
const errorMessage = document.getElementById('error-message');

const users = [
  { id: 1, name: 'John Doe', role: 'Manager' },
  { id: 2, name: 'Jane Doe', role: 'Cashier' },
];

users.forEach((user) => {
  const li = document.createElement('li');
  li.textContent = user.name;
  li.addEventListener('click', () => {
    // Login logic here
  });
  userList.appendChild(li);
});

const numButtons = document.querySelectorAll('.num-button');

numButtons.forEach((button) => {
  button.addEventListener('click', () => {
    const num = button.getAttribute('data-num');
    pinInput.value += num;
  });
});

forgotPinButton.addEventListener('click', () => {
  // Forgot PIN logic here
});
