'use strict';

import React, { useCallback, useEffect } from 'react';

const DIGITS = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

/**
 * PinKeypad — Large, tap-friendly numeric keypad.
 * Props:
 *   onDigit:  (digit: string) => void
 *   onDelete: () => void
 *   onClear:  () => void
 *   disabled: boolean
 *   loading:  boolean
 */
export default function PinKeypad({ onDigit, onDelete, onClear, disabled = false, loading = false }) {
  // Keyboard support
  const handleKeyDown = useCallback((e) => {
    if (disabled) return;
    if (/^[0-9]$/.test(e.key)) {
      onDigit(e.key);
    } else if (e.key === 'Backspace') {
      onDelete();
    } else if (e.key === 'Escape') {
      onClear();
    }
  }, [disabled, onDigit, onDelete, onClear]);

  useEffect(() => {
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [handleKeyDown]);

  const isDisabled = disabled || loading;

  function renderDigitBtn(digit) {
    return (
      <button
        key={digit}
        type="button"
        className="pos-keypad__btn pos-keypad__btn--digit"
        onClick={() => onDigit(digit)}
        disabled={isDisabled}
        aria-label={`Enter digit ${digit}`}
      >
        {digit}
      </button>
    );
  }

  return (
    <div className="pos-keypad" role="group" aria-label="PIN keypad">
      {/* Row 1: 1 2 3 */}
      <div className="pos-keypad__row">
        {DIGITS.slice(0, 3).map(renderDigitBtn)}
      </div>

      {/* Row 2: 4 5 6 */}
      <div className="pos-keypad__row">
        {DIGITS.slice(3, 6).map(renderDigitBtn)}
      </div>

      {/* Row 3: 7 8 9 */}
      <div className="pos-keypad__row">
        {DIGITS.slice(6, 9).map(renderDigitBtn)}
      </div>

      {/* Row 4: Clear  0  Delete */}
      <div className="pos-keypad__row">
        <button
          type="button"
          className="pos-keypad__btn pos-keypad__btn--action"
          onClick={onClear}
          disabled={isDisabled}
          aria-label="Clear PIN"
        >
          C
        </button>

        <button
          type="button"
          className="pos-keypad__btn pos-keypad__btn--digit"
          onClick={() => onDigit('0')}
          disabled={isDisabled}
          aria-label="Enter digit 0"
        >
          {loading ? <span className="pos-spinner pos-spinner--sm" aria-hidden="true" /> : '0'}
        </button>

        <button
          type="button"
          className="pos-keypad__btn pos-keypad__btn--delete"
          onClick={onDelete}
          disabled={isDisabled}
          aria-label="Delete last digit"
        >
          ⌫
        </button>
      </div>
    </div>
  );
}
