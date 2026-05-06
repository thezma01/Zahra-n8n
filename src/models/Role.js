'use strict';

const { db } = require('../config/database');

class Role {
  static get TABLE() {
    return 'roles';
  }

  /**
   * Find all active roles
   */
  static async findAll() {
    return db(this.TABLE).where({ is_active: true }).orderBy('name');
  }

  /**
   * Find role by ID with permissions
   */
  static async findById(id) {
    const role = await db(this.TABLE).where({ id }).first();
    if (!role) return null;
    role.permissions = await this.getPermissions(id);
    return role;
  }

  /**
   * Find role by name
   */
  static async findByName(name) {
    const role = await db(this.TABLE).where({ name, is_active: true }).first();
    if (!role) return null;
    role.permissions = await this.getPermissions(role.id);
    return role;
  }

  /**
   * Get all permissions for a role
   */
  static async getPermissions(roleId) {
    return db('permissions')
      .join('role_permissions', 'permissions.id', 'role_permissions.permission_id')
      .where('role_permissions.role_id', roleId)
      .where('permissions.is_active', true)
      .select('permissions.*');
  }

  /**
   * Get permission names array for a role
   */
  static async getPermissionNames(roleId) {
    const perms = await this.getPermissions(roleId);
    return perms.map((p) => p.name);
  }

  /**
   * Create a role
   */
  static async create(data) {
    const { v4: uuidv4 } = require('uuid');
    const [record] = await db(this.TABLE)
      .insert({ id: uuidv4(), ...data })
      .returning('*');
    return record;
  }

  /**
   * Update a role
   */
  static async update(id, data) {
    const [record] = await db(this.TABLE)
      .where({ id })
      .update({ ...data, updated_at: db.fn.now() })
      .returning('*');
    return record;
  }

  /**
   * Assign permissions to role (replaces existing)
   */
  static async syncPermissions(roleId, permissionIds) {
    const { v4: uuidv4 } = require('uuid');
    await db('role_permissions').where({ role_id: roleId }).delete();
    if (!permissionIds || permissionIds.length === 0) return;
    const rows = permissionIds.map((pid) => ({
      id: uuidv4(),
      role_id: roleId,
      permission_id: pid,
    }));
    await db('role_permissions').insert(rows);
  }
}

module.exports = Role;
