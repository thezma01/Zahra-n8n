'use strict';

/**
 * Migration: Create permissions table
 * NOTE: Must run BEFORE roles migration due to FK reference
 */
exports.up = async function (knex) {
  await knex.schema.createTable('permissions', (table) => {
    table.uuid('id').primary().defaultTo(knex.raw('gen_random_uuid()'));
    table.string('name', 100).notNullable().unique();
    table.string('display_name', 150).notNullable();
    table.string('category', 50).notNullable();
    table.text('description').nullable();
    table.boolean('is_active').notNullable().defaultTo(true);
    table.timestamp('created_at').notNullable().defaultTo(knex.fn.now());
    table.timestamp('updated_at').notNullable().defaultTo(knex.fn.now());

    table.index(['category']);
    table.index(['name']);
  });

  console.log('✅ Created permissions table');
};

exports.down = async function (knex) {
  await knex.schema.dropTableIfExists('permissions');
  console.log('✅ Dropped permissions table');
};
