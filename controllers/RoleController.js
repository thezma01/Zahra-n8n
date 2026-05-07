const Role = require('../models/Role');
const roleUtils = require('../utils/roleUtils');

class RoleController {
  async getAllRoles() {
    const roles = await Role.find();
    return roles;
  }

  async getRoleById(id) {
    const role = await Role.findById(id);
    return role;
  }

  async createRole(role) {
    const newRole = new Role(role);
    await newRole.save();
    return newRole;
  }

  async updateRole(id, role) {
    const updatedRole = await Role.findByIdAndUpdate(id, role, { new: true });
    return updatedRole;
  }

  async deleteRole(id) {
    await Role.findByIdAndDelete(id);
  }

  async getPermissions(role) {
    const permissions = roleUtils.getPermissions(role);
    return permissions;
  }
}

module.exports = RoleController;
