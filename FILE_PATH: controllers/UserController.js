const User = require('../models/User');

class UserController {
    static async getAllUsers(req, res) {
        const users = await User.find();
        return res.send(users);
    }

    static async getUserById(req, res) {
        const { id } = req.params;
        const user = await User.findById(id);
        if (!user) {
            return res.status(404).send('User not found');
        }
        return res.send(user);
    }

    static async createUser(req, res) {
        const { name, role, pin } = req.body;
        const user = new User(null, name, role, pin);
        await user.save();
        return res.send('User created successfully');
    }

    static async updateUser(req, res) {
        const { id } = req.params;
        const { name, role, pin } = req.body;
        const user = await User.findById(id);
        if (!user) {
            return res.status(404).send('User not found');
        }
        user.name = name;
        user.role = role;
        user.pin = pin;
        await user.save();
        return res.send('User updated successfully');
    }

    static async deleteUser(req, res) {
        const { id } = req.params;
        const user = await User.findById(id);
        if (!user) {
            return res.status(404).send('User not found');
        }
        await user.remove();
        return res.send('User deleted successfully');
    }
}

module.exports = UserController;
