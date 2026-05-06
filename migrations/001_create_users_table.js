'use strict';

/**
 * Migration: Create users table
 */
exports.up = async function (knex) {
  await knex.schema.createTable('users', (table) => {
    table.uuid('id').primary().defaultTo(knex.raw('gen_random_uuid()'));
    table.string('name', 100).notNullable();
    table.string('email', 255).unique().nullable();
    table.string('pin_hash', 255).notNullable();
    table.string('avatar_url', 500).nullable();
    table.string('initials', 5).nullable();
    table.string('color', 7).nullable().defaultTo('#16a34a');

    // Role reference (FK added after roles table)
    table.uuid('role_id').nullable();

    // Account status
    table.boolean('is_active').notNullable().defaultTo(true);
    table.integer('failed_attempts').notNullable().defaultTo(0);
    table.timestamp('locked_until').nullable();

    // OTP fields
    table.string('otp_hash', 255).nullable();
    table.timestamp('otp_expires_at').nullable();
    table.integer('otp_attempts').notNullable().defaultTo(0);

    // Refresh token
    table.string('refresh_token_hash', 255).nullable();

    // Timestamps
    table.timestamp('last_login_at').nullable();
    table.timestamp('created_at').notNullable().defaultTo(knex.fn.now());
    table.timestamp('updated_at').notNullable().defaultTo(knex.fn.now());
    table.timestamp('deleted_at').nullable();

    // Indexes
    table.index(['email']);
    table.index(['role_id']);
    table.index(['is_active']);
  });

  console.log('✅ Created users table');
};

exports.down = async function (knex) {
  await knex.schema.dropTableIfExists('users');
  console.log('✅ Dropped users table');
};
