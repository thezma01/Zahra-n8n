const User = require('../models/User');

class AuthController {
    constructor() {
        this.users = [];
    }

    getAllUsers() {
        return this.users;
    }

    getUserById(id) {
        return this.users.find(user => user.id === id);
    }

    authenticateUser(id, pin) {
        const user = this.getUserById(id);
        if (user && user.pin === pin) {
            return user;
        }
        return null;
    }

    forgotPin(id) {
        // Send OTP to user's email
        // ...
    }

    resetPin(id, newPin) {
        const user = this.getUserById(id);
        if (user) {
            user.pin = newPin;
        }
    }
}

module.exports = AuthController;
