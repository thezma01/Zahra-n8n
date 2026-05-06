import React from 'react';

interface PinPadProps {
  pin: string;
  pinLength: number;
  loading: boolean;
  primaryColor: string;
  onChange: (pin: string) => void;
}

const KEYS = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '', '0', 'del'];

const PinPad: React.FC<PinPadProps> = ({ pin, pinLength, loading, primaryColor, onChange }) => {
  const handleKey = (key: string) => {
    if (loading) return;

    if (key === 'del') {
      onChange(pin.slice(0, -1));
      return;
    }

    if (key === '') return;

    if (pin.length < pinLength) {
      onChange(pin + key);
    }
  };

  return (
    <div className="pinpad-grid" role="group" aria-label="PIN pad">
      {KEYS.map((key, index) => {
        if (key === '') {
          return <div key={index} className="pinpad-key pinpad-key--empty" />;
        }

        if (key === 'del') {
          return (
            <button
              key={index}
              className="pinpad-key pinpad-key--action"
              onClick={() => handleKey('del')}
              disabled={loading || pin.length === 0}
              aria-label="Delete last digit"
              type="button"
            >
              <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M22 3H7c-.69 0-1.23.35-1.59.88L0 12l5.41 8.11c.36.53.9.89 1.59.89h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-3 12.59L17.59 17 14 13.41 10.41 17 9 15.59 12.59 12 9 8.41 10.41 7 14 10.59 17.59 7 19 8.41 15.41 12 19 15.59z" />
              </svg>
            </button>
          );
        }

        return (
          <button
            key={index}
            className="pinpad-key pinpad-key--digit"
            onClick={() => handleKey(key)}
            disabled={loading || pin.length >= pinLength}
            aria-label={`Digit ${key}`}
            type="button"
            style={
              {
                '--pin-primary': primaryColor,
              } as React.CSSProperties
            }
          >
            {key}
          </button>
        );
      })}
    </div>
  );
};

export default PinPad;
