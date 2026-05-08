// Constants for the application
export const DEFAULT_PIN_LENGTH = 5;
export const DEFAULT_OTP_LENGTH = 6;
export const DEFAULT_OTP_EXPIRY = 5; // in minutes
export const PRIMARY_THEME_COLOR = 'green';
export const MANAGER_ROLE = 'Manager';
export const CASHIER_ROLE = 'Cashier';
export const PERMISSIONS = {
  [MANAGER_ROLE]: ['forgetPin', 'voidOrders', 'viewReports', 'batchOpenClose'],
  [CASHIER_ROLE]: ['placeOrders', 'holdOrders', 'applyDiscount', 'splitPayment']
};
