'use strict';

require('dotenv').config();

const knex = require('knex');

const config = {
  client: process.env.DB_CLIENT || 'pg',
  connection: {
    host: process.env.DB_HOST || '127.0.0.1',
    port: parseInt(process.env.DB_PORT) || 5432,
    database: process.env.DB_NAME || 'pos_db',
    user: process.env.DB_USER || 'postgres',
    password: process.env.DB_PASSWORD || '',
  },
  pool: {
    min: parseInt(process.env.DB_POOL_MIN) || 2,
    max: parseInt(process.env.DB_POOL_MAX) || 10,
  },
  migrations: {
    tableName: 'knex_migrations',
    directory: './migrations',
  },
  seeds: {
    directory: './seeders',
  },
};

const db = knex(config);

/**
 * Test database connection
 */
async function testConnection() {
  try {
    await db.raw('SELECT 1');
    console.log('✅ Database connected successfully');
    return true;
  } catch (error) {
    console.error('❌ Database connection failed:', error.message);
    throw error;
  }
}

module.exports = { db, testConnection, config };
