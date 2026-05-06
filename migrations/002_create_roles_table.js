'use strict';

/**
 * Migration: Create roles table
 */
exports.up = async function (knex) {
  // Create roles table
  await knex.schema.createTable('roles', (table) => {
    table.uuid('id').primary().defaultTo(knex.raw('gen_random_uuid()'));
    table.string('name', 50).notNullable().unique();
    table.string('display_name', 100).notNullable();
    table.text('description').nullable();
    table.string('badge_color', 7).notNullable().defaultTo('#16a34a');
    table.boolean('is_active').notNullable().defaultTo(true);
    table.timestamp('created_at').notNullable().defaultTo(knex.fn.now());
    table.timestamp('updated_at').notNullable().defaultTo(knex.fn.now());
  });

  // Create role_permissions pivot table
  await knex.schema.createTable('role_permissions', (table) => {
    table.uuid('id').primary().defaultTo(knex.raw('gen_random_uuid()'));
    table.uuid('role_id').notNullable().references('id').inTable('roles').onDelete('CASCADE');
    table.uuid('permission_id').notNullable().references('id').inTable('permissions').onDelete('CASCADE');
    table.timestamp('created_at').notNullable().defaultTo(knex.fn.now());
    table.unique(['role_id', 'permission_id']);
  });

  // Add FK from users to roles
  await knex.schema.alterTable('users', (table) => {
    table.foreign('role_id').references('id').inTable('roles').onDelete('SET NULL');
  });

  console.log('✅ Created roles and role_permissions tables');
};

exports.down = async function (knex) {
  await knex.schema.alterTable('users', (table) => {
    table.dropForeign(['role_id']);
  });
  await knex.schema.dropTableIfExists('role_permissions');
  await knex.schema.dropTableIfExists('roles');
  console.log('✅ Dropped roles tables');
};
