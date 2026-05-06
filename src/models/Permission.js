'use strict';

const { db } = require('../config/database');

class Permission {
  static get TABLE() {
    return 'permissions';
  }

  /**
   * Find all active permissions
   */
  static async findAll() {
    return db(this.TABLE)
      .where({ is_active: true })
      .orderBy('category')
      .orderBy('display_name');
  }

  /**
   * Find permissions by category
   */
  static async findByCategory(category) {
    return db(this.TABLE)
      .where({ category, is_active: true })
      .orderBy('display_name');
  }

  /**
   * Find a permission by name
   */
  static async findByName(name) {
    return db(this.TABLE).where({ name, is_active: true }).first();
  }

  /**
   * Find permission by ID
   */
  static async findById(id) {
    return db(this.TABLE).where({ id }).first();
  }

  /**
   * Create a permission
   */
  static async create(data) {
    const { v4: uuidv4 } = require('uuid');
    const [record] = await db(this.TABLE)
      .insert({ id: uuidv4(), ...data })
      .returning('*');
    return record;
  }

  /**
   * Update a permission
   */
  static async update(id, data) {
    const [record] = await db(this.TABLE)
      .where({ id })
      .update({ ...data, updated_at: db.fn.now() })
      .returning('*');
    return record;
  }

  /**
   * Toggle permission active status
   */
  static async toggle(id) {
    const perm = await this.findById(id);
    if (!perm) throw new Error('Permission not found');
    return this.update(id, { is_active: !perm.is_active });
  }
}

module.exports = Permission;
