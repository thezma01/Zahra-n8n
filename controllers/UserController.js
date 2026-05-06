const User = require('../models/User');

class UserController {
  async getAllUsers(req, res) {
    const users = [new User(1, 'John Doe', 'Manager', '12345')];
    res.send(users);
  }

  async getUserById(req, res) {
    const id = req.params.id;
    const user = new User(id, 'John Doe', 'Manager', '12345');
    res.send(user);
  }

  async createUser(req, res) {
    const { name, role, pin } = req.body;
    const user = new User(2, name, role, pin);
    res.send(user);
  }

  async updateUser(req, res) {
    const id = req.params.id;
    const { name, role, pin } = req.body;
    const user = new User(id, name, role, pin);
    res.send(user);
  }

  async deleteUser(req, res) {
    const id = req.params.id;
    res.send(`User ${id} deleted`);
  }
}

module.exports = UserController;
