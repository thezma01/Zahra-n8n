import React from 'react';

const KEYS = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '', '0', 'del'];

export default function NumericKeypad({ onKey, disabled = false, primaryColor = '#16a34a' }) {
  return (
    <div className="numeric-keypad" role="group" aria-label="PIN keypad">
      {KEYS.map((key, idx) => {
        if (key === '') {
          return <div key={idx} className="keypad-spacer" />;
        }
        if (key === 'del') {
          return (
            <button
              key={idx}
              type="button"
              className="keypad-btn keypad-del"
              onClick={() => !disabled && onKey('del')}
              disabled={disabled}
              aria-label="Delete"
            >
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                <line x1="18" y1="9" x2="12" y2="15" />
                <line x1="12" y1="9" x2="18" y2="15" />
              </svg>
            </button>
          );
        }
        return (
          <button
            key={idx}
            type="button"
            className="keypad-btn keypad-digit"
            onClick={() => !disabled && onKey(key)}
            disabled={disabled}
            aria-label={key}
            style={{ '--keypad-primary': primaryColor }}
          >
            <span className="keypad-digit-num">{key}</span>
          </button>
        );
      })}
    </div>
  );
}
