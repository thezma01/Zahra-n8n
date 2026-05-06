'use strict';

require('dotenv').config();

const { db } = require('../src/config/database');

async function runMigrations() {
  try {
    console.log('🔄 Running migrations...');

    // Run in order: permissions first, then users, then roles (which adds FK)
    const migration003 = require('./003_create_permissions_table');
    const migration001 = require('./001_create_users_table');
    const migration002 = require('./002_create_roles_table');

    await migration003.up(db);
    await migration001.up(db);
    await migration002.up(db);

    console.log('✅ All migrations completed successfully');
    process.exit(0);
  } catch (error) {
    console.error('❌ Migration failed:', error.message);
    console.error(error.stack);
    process.exit(1);
  }
}

runMigrations();
