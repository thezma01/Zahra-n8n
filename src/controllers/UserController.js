const User = require('../models/User');

class UserController {
  getAllUsers(req, res) {
    // TO DO: implement get all users logic
    res.send('Users retrieved successfully');
  }

  getUserById(req, res) {
    const { id } = req.params;
    // TO DO: implement get user by id logic
    res.send('User retrieved successfully');
  }

  createUser(req, res) {
    const { name, role, pin } = req.body;
    const user = new User(null, name, role, pin);
    // TO DO: implement create user logic
    res.send('User created successfully');
  }

  updateUser(req, res) {
    const { id } = req.params;
    const { name, role, pin } = req.body;
    // TO DO: implement update user logic
    res.send('User updated successfully');
  }

  deleteUser(req, res) {
    const { id } = req.params;
    // TO DO: implement delete user logic
    res.send('User deleted successfully');
  }
}

module.exports = new UserController();
