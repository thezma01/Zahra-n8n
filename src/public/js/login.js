'use strict';

const API_BASE = '/api/auth';

const state = {
  selectedUser: null,
  pin: '',
  pinLength: 5,
  otpLength: 6,
  otpExpiryMinutes: 5,
  primaryColor: '#16a34a',
  appName: 'POS System',
  forgotPinStep: 'request', // request | verify | reset | done
  resetToken: null,
  users: [],
};

// ─── DOM Refs ────────────────────────────────────────────────────────────────
const screens = {
  loading:   () => document.getElementById('screen-loading'),
  users:     () => document.getElementById('screen-users'),
  pin:       () => document.getElementById('screen-pin'),
  forgot:    () => document.getElementById('screen-forgot'),
};

function showScreen(name) {
  Object.keys(screens).forEach((k) => {
    const el = screens[k]();
    if (el) el.classList.toggle('d-none', k !== name);
  });
}

// ─── API Helpers ─────────────────────────────────────────────────────────────
async function apiFetch(path, options = {}) {
  const res = await fetch(`${API_BASE}${path}`, {
    headers: { 'Content-Type': 'application/json' },
    ...options,
  });
  return res.json();
}

// ─── Init ────────────────────────────────────────────────────────────────────
async function init() {
  showScreen('loading');

  try {
    const [cfgRes, usersRes] = await Promise.all([
      apiFetch('/config'),
      apiFetch('/users'),
    ]);

    if (cfgRes.success) {
      const d = cfgRes.data;
      state.pinLength        = d.pinLength        || 5;
      state.otpLength        = d.otpLength         || 6;
      state.otpExpiryMinutes = d.otpExpiryMinutes  || 5;
      state.primaryColor     = d.primaryColor      || '#16a34a';
      state.appName          = d.appName           || 'POS System';

      applyBrandColor(state.primaryColor);
      document.querySelectorAll('.app-name').forEach((el) => {
        el.textContent = state.appName;
      });
    }

    if (usersRes.success) {
      state.users = usersRes.data || [];
      renderUsers(state.users);
    }

    showScreen('users');
  } catch (err) {
    showToast('Failed to connect to server. Please refresh.', 'danger');
    showScreen('users');
  }
}

function applyBrandColor(color) {
  document.documentElement.style.setProperty('--pos-primary', color);
}

// ─── User Selection ───────────────────────────────────────────────────────────
function renderUsers(users) {
  const grid = document.getElementById('user-grid');
  grid.innerHTML = '';

  if (!users.length) {
    grid.innerHTML = `
      <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-people fs-1 d-block mb-2"></i>
        No active users found.
      </div>`;
    return;
  }

  users.forEach((user) => {
    const card = document.createElement('div');
    card.className = 'col-6 col-sm-4 col-md-3';
    card.innerHTML = `
      <button class="user-card w-100" data-id="${user.id}" aria-label="Select ${user.name}">
        <div class="user-avatar" aria-hidden="true">${
          user.avatarUrl
            ? `<img src="${user.avatarUrl}" alt="${user.name}" class="avatar-img">`
            : `<span>${escHtml(user.initials || '??')}</span>`
        }</div>
        <div class="user-name">${escHtml(user.name)}</div>
        <span class="role-badge role-${user.role}">${capitalize(user.role)}</span>
      </button>`;
    card.querySelector('.user-card').addEventListener('click', () => selectUser(user));
    grid.appendChild(card);
  });
}

function selectUser(user) {
  state.selectedUser = user;
  state.pin = '';

  document.getElementById('pin-user-name').textContent  = user.name;
  document.getElementById('pin-user-role').textContent  = capitalize(user.role);
  document.getElementById('pin-user-role').className    = `role-badge role-${user.role}`;

  const avatarEl = document.getElementById('pin-user-avatar');
  avatarEl.innerHTML = user.avatarUrl
    ? `<img src="${user.avatarUrl}" alt="${user.name}" class="avatar-img">`
    : `<span>${escHtml(user.initials || '??')}</span>`;

  const forgotLink = document.getElementById('forgot-pin-link');
  forgotLink.classList.toggle('d-none', user.role !== 'manager');

  clearPinDisplay();
  clearPinError();
  showScreen('pin');
}

// ─── PIN Pad ─────────────────────────────────────────────────────────────────
function updatePinDisplay() {
  const dots = document.querySelectorAll('.pin-dot');
  dots.forEach((dot, i) => dot.classList.toggle('filled', i < state.pin.length));
}

function clearPinDisplay() {
  state.pin = '';
  updatePinDisplay();
}

function clearPinError() {
  const el = document.getElementById('pin-error');
  if (el) { el.textContent = ''; el.classList.add('d-none'); }
}

function showPinError(msg) {
  const el = document.getElementById('pin-error');
  if (el) { el.textContent = msg; el.classList.remove('d-none'); }
}

document.addEventListener('DOMContentLoaded', () => {
  // Render PIN dots dynamically
  rebuildPinDots();

  // Keypad digit buttons
  document.querySelectorAll('.keypad-btn[data-digit]').forEach((btn) => {
    btn.addEventListener('click', () => {
      if (state.pin.length >= state.pinLength) return;
      state.pin += btn.dataset.digit;
      updatePinDisplay();
      if (state.pin.length === state.pinLength) submitPin();
    });
  });

  // Backspace
  document.getElementById('keypad-backspace').addEventListener('click', () => {
    state.pin = state.pin.slice(0, -1);
    clearPinError();
    updatePinDisplay();
  });

  // Clear
  document.getElementById('keypad-clear').addEventListener('click', () => {
    clearPinDisplay();
    clearPinError();
  });

  // Back to users
  document.getElementById('back-to-users').addEventListener('click', () => {
    state.selectedUser = null;
    clearPinDisplay();
    clearPinError();
    showScreen('users');
  });

  // Forgot PIN
  document.getElementById('forgot-pin-link').addEventListener('click', openForgotPin);

  // Forgot PIN form handlers
  document.getElementById('btn-send-otp').addEventListener('click', sendOtp);
  document.getElementById('btn-verify-otp').addEventListener('click', verifyOtp);
  document.getElementById('btn-reset-pin').addEventListener('click', resetPin);
  document.getElementById('btn-forgot-back').addEventListener('click', closeForgotPin);
  document.getElementById('btn-forgot-done').addEventListener('click', closeForgotPin);

  // Physical keyboard support
  document.addEventListener('keydown', handleKeyboard);

  init();
});

function rebuildPinDots() {
  // Will be rebuilt after config loads; pre-build with default 5
  buildDots(state.pinLength);
}

function buildDots(length) {
  const container = document.getElementById('pin-dots');
  container.innerHTML = '';
  for (let i = 0; i < length; i++) {
    const dot = document.createElement('span');
    dot.className = 'pin-dot';
    container.appendChild(dot);
  }
}

function handleKeyboard(e) {
  const activeScreen = document.querySelector('.screen:not(.d-none)');
  if (!activeScreen) return;

  if (activeScreen.id === 'screen-pin') {
    if (/^[0-9]$/.test(e.key)) {
      if (state.pin.length < state.pinLength) {
        state.pin += e.key;
        updatePinDisplay();
        if (state.pin.length === state.pinLength) submitPin();
      }
    } else if (e.key === 'Backspace') {
      state.pin = state.pin.slice(0, -1);
      clearPinError();
      updatePinDisplay();
    }
  }
}

// ─── Login Submission ─────────────────────────────────────────────────────────
async function submitPin() {
  if (!state.selectedUser) return;

  setKeypadLoading(true);

  try {
    const res = await apiFetch('/login', {
      method: 'POST',
      body: JSON.stringify({ userId: state.selectedUser.id, pin: state.pin }),
    });

    if (res.success) {
      localStorage.setItem('pos_access_token',  res.data.accessToken);
      localStorage.setItem('pos_refresh_token', res.data.refreshToken);
      localStorage.setItem('pos_user',          JSON.stringify(res.data.user));
      showToast('Login successful! Redirecting…', 'success');
      setTimeout(() => { window.location.href = '/pos'; }, 800);
    } else {
      showPinError(res.message || 'Incorrect PIN, please try again.');
      clearPinDisplay();
    }
  } catch {
    showPinError('Connection error. Please try again.');
    clearPinDisplay();
  } finally {
    setKeypadLoading(false);
  }
}

function setKeypadLoading(loading) {
  document.querySelectorAll('.keypad-btn').forEach((b) => (b.disabled = loading));
}

// ─── Forgot PIN Flow ──────────────────────────────────────────────────────────
function openForgotPin() {
  state.forgotPinStep = 'request';
  state.resetToken    = null;

  showForgotStep('step-request');
  document.getElementById('otp-input').value     = '';
  document.getElementById('new-pin-input').value  = '';
  document.getElementById('confirm-pin-input').value = '';
  clearForgotError();
  showScreen('forgot');
}

function closeForgotPin() {
  if (state.selectedUser) {
    clearPinDisplay();
    clearPinError();
    showScreen('pin');
  } else {
    showScreen('users');
  }
}

function showForgotStep(stepId) {
  ['step-request', 'step-verify', 'step-reset', 'step-done'].forEach((id) => {
    const el = document.getElementById(id);
    if (el) el.classList.toggle('d-none', id !== stepId);
  });
}

function clearForgotError() {
  const el = document.getElementById('forgot-error');
  if (el) { el.textContent = ''; el.classList.add('d-none'); }
}

function showForgotError(msg) {
  const el = document.getElementById('forgot-error');
  if (el) { el.textContent = msg; el.classList.remove('d-none'); }
}

async function sendOtp() {
  if (!state.selectedUser) return;
  clearForgotError();
  setBtnLoading('btn-send-otp', true);

  try {
    const res = await apiFetch('/forgot-pin/request', {
      method: 'POST',
      body: JSON.stringify({ userId: state.selectedUser.id }),
    });

    if (res.success) {
      document.getElementById('otp-masked-email').textContent =
        res.data?.maskedEmail || 'your email';
      document.getElementById('otp-expiry').textContent =
        res.data?.expiryMinutes || state.otpExpiryMinutes;
      showForgotStep('step-verify');
    } else {
      showForgotError(res.message || 'Failed to send OTP.');
    }
  } catch {
    showForgotError('Connection error. Please try again.');
  } finally {
    setBtnLoading('btn-send-otp', false);
  }
}

async function verifyOtp() {
  clearForgotError();
  const otp = document.getElementById('otp-input').value.trim();

  if (!otp) { showForgotError('Please enter the OTP.'); return; }

  setBtnLoading('btn-verify-otp', true);

  try {
    const res = await apiFetch('/forgot-pin/verify', {
      method: 'POST',
      body: JSON.stringify({ userId: state.selectedUser.id, otp }),
    });

    if (res.success) {
      state.resetToken = res.data.resetToken;
      showForgotStep('step-reset');
    } else {
      showForgotError(res.message || 'Invalid OTP.');
    }
  } catch {
    showForgotError('Connection error. Please try again.');
  } finally {
    setBtnLoading('btn-verify-otp', false);
  }
}

async function resetPin() {
  clearForgotError();
  const newPin     = document.getElementById('new-pin-input').value.trim();
  const confirmPin = document.getElementById('confirm-pin-input').value.trim();

  if (!newPin || !confirmPin)        { showForgotError('Please fill in both PIN fields.'); return; }
  if (newPin !== confirmPin)          { showForgotError('PINs do not match.'); return; }
  if (!/^\d+$/.test(newPin))          { showForgotError('PIN must contain digits only.'); return; }
  if (newPin.length !== state.pinLength) {
    showForgotError(`PIN must be exactly ${state.pinLength} digits.`); return;
  }

  setBtnLoading('btn-reset-pin', true);

  try {
    const res = await apiFetch('/forgot-pin/reset', {
      method: 'POST',
      body: JSON.stringify({ resetToken: state.resetToken, newPin }),
    });

    if (res.success) {
      showForgotStep('step-done');
    } else {
      showForgotError(res.message || 'Failed to reset PIN.');
    }
  } catch {
    showForgotError('Connection error. Please try again.');
  } finally {
    setBtnLoading('btn-reset-pin', false);
  }
}

// ─── Toast ───────────────────────────────────────────────────────────────────
function showToast(msg, type = 'info') {
  const container = document.getElementById('toast-container');
  const id = 'toast-' + Date.now();
  const bgClass = type === 'success' ? 'bg-success' : type === 'danger' ? 'bg-danger' : 'bg-dark';
  container.insertAdjacentHTML('beforeend', `
    <div id="${id}" class="toast align-items-center text-white ${bgClass} border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">${escHtml(msg)}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>`);
  setTimeout(() => { document.getElementById(id)?.remove(); }, 3500);
}

// ─── Utilities ────────────────────────────────────────────────────────────────
function escHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

function capitalize(str) {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}

function setBtnLoading(btnId, loading) {
  const btn = document.getElementById(btnId);
  if (!btn) return;
  btn.disabled = loading;
  btn.dataset.originalText = btn.dataset.originalText || btn.innerHTML;
  btn.innerHTML = loading
    ? `<span class="spinner-border spinner-border-sm me-1"></span> Please wait…`
    : btn.dataset.originalText;
}
