const rolePermissions = {
  Manager: ['Forget PIN', 'Void / Cancel Orders', 'View Reports', 'Batch Open / Close'],
  Cashier: ['Place Orders', 'Hold Orders', 'Apply Discount', 'Split Payment'],
};

const getPermissions = (role) => {
  return rolePermissions[role.name];
};

module.exports = { getPermissions };
