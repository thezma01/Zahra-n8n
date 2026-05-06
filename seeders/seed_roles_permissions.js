'use strict';

require('dotenv').config();

const { db } = require('../src/config/database');
const bcrypt = require('bcryptjs');
const { v4: uuidv4 } = require('uuid');

const permissions = [
  // Manager permissions
  { name: 'forget_pin', display_name: 'Forgot PIN Reset', category: 'auth', description: 'Reset PIN via email OTP' },
  { name: 'void_orders', display_name: 'Void / Cancel Orders', category: 'orders', description: 'Void or cancel placed orders' },
  { name: 'view_reports', display_name: 'View Reports', category: 'reports', description: 'Access sales and business reports' },
  { name: 'batch_open_close', display_name: 'Batch Open / Close', category: 'operations', description: 'Open and close batch/day' },
  { name: 'manage_users', display_name: 'Manage Users', category: 'admin', description: 'Add, edit, delete users' },
  { name: 'manage_settings', display_name: 'Manage Settings', category: 'admin', description: 'Configure system settings' },

  // Cashier permissions
  { name: 'place_orders', display_name: 'Place Orders', category: 'orders', description: 'Create and submit new orders' },
  { name: 'hold_orders', display_name: 'Hold Orders', category: 'orders', description: 'Place orders on hold' },
  { name: 'apply_discount', display_name: 'Apply Discount', category: 'orders', description: 'Apply discounts to orders' },
  { name: 'split_payment', display_name: 'Split Payment', category: 'payments', description: 'Split payments across methods' },
  { name: 'process_refund', display_name: 'Process Refund', category: 'payments', description: 'Process customer refunds' },
  { name: 'view_transactions', display_name: 'View Transactions', category: 'reports', description: 'View own transaction history' },
];

const roles = [
  {
    name: 'manager',
    display_name: 'Manager',
    description: 'Full access to POS operations and management',
    badge_color: '#7c3aed',
    permissions: [
      'forget_pin', 'void_orders', 'view_reports', 'batch_open_close',
      'manage_users', 'manage_settings', 'place_orders', 'hold_orders',
      'apply_discount', 'split_payment', 'process_refund', 'view_transactions',
    ],
  },
  {
    name: 'cashier',
    display_name: 'Cashier',
    description: 'Standard POS cashier operations',
    badge_color: '#0891b2',
    permissions: [
      'place_orders', 'hold_orders', 'apply_discount',
      'split_payment', 'view_transactions',
    ],
  },
];

async function seed() {
  try {
    console.log('🌱 Starting seed...');

    // Insert permissions
    const permissionIds = {};
    for (const perm of permissions) {
      const existing = await db('permissions').where({ name: perm.name }).first();
      if (!existing) {
        const [inserted] = await db('permissions')
          .insert({ id: uuidv4(), ...perm })
          .returning('*');
        permissionIds[perm.name] = inserted.id;
        console.log(`  ✅ Permission: ${perm.name}`);
      } else {
        permissionIds[perm.name] = existing.id;
        console.log(`  ⏭️  Permission exists: ${perm.name}`);
      }
    }

    // Insert roles and role_permissions
    for (const role of roles) {
      let roleRecord = await db('roles').where({ name: role.name }).first();
      if (!roleRecord) {
        const [inserted] = await db('roles')
          .insert({
            id: uuidv4(),
            name: role.name,
            display_name: role.display_name,
            description: role.description,
            badge_color: role.badge_color,
          })
          .returning('*');
        roleRecord = inserted;
        console.log(`  ✅ Role: ${role.name}`);
      } else {
        console.log(`  ⏭️  Role exists: ${role.name}`);
      }

      // Assign permissions
      for (const permName of role.permissions) {
        const permId = permissionIds[permName];
        if (!permId) continue;
        const exists = await db('role_permissions')
          .where({ role_id: roleRecord.id, permission_id: permId })
          .first();
        if (!exists) {
          await db('role_permissions').insert({
            id: uuidv4(),
            role_id: roleRecord.id,
            permission_id: permId,
          });
        }
      }
      console.log(`  ✅ Assigned ${role.permissions.length} permissions to ${role.name}`);
    }

    // Create default admin/manager user
    const managerRole = await db('roles').where({ name: 'manager' }).first();
    const existingAdmin = await db('users').where({ email: 'admin@pos.com' }).first();
    if (!existingAdmin && managerRole) {
      const pinHash = await bcrypt.hash('12345', 12);
      await db('users').insert({
        id: uuidv4(),
        name: 'Admin Manager',
        email: 'admin@pos.com',
        pin_hash: pinHash,
        initials: 'AM',
        color: '#7c3aed',
        role_id: managerRole.id,
        is_active: true,
      });
      console.log('  ✅ Default manager user created (PIN: 12345)');
    }

    // Create default cashier user
    const cashierRole = await db('roles').where({ name: 'cashier' }).first();
    const existingCashier = await db('users').where({ email: 'cashier@pos.com' }).first();
    if (!existingCashier && cashierRole) {
      const pinHash = await bcrypt.hash('67890', 12);
      await db('users').insert({
        id: uuidv4(),
        name: 'Jane Cashier',
        email: 'cashier@pos.com',
        pin_hash: pinHash,
        initials: 'JC',
        color: '#0891b2',
        role_id: cashierRole.id,
        is_active: true,
      });
      console.log('  ✅ Default cashier user created (PIN: 67890)');
    }

    console.log('\n🎉 Seeding complete!');
    process.exit(0);
  } catch (error) {
    console.error('❌ Seeding failed:', error.message);
    console.error(error.stack);
    process.exit(1);
  }
}

seed();
