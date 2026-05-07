const express = require('express');
const app = express();
const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const config = require('./config');

mongoose.connect(config.databaseUrl, { useNewUrlParser: true, useUnifiedTopology: true });

app.use(express.json());

const authController = require('./controllers/AuthController');
const userController = require('./controllers/UserController');
const authRoutes = require('./routes/auth');
const userRoutes = require('./routes/users');

app.use('/api/auth', authRoutes);
app.use('/api/users', userRoutes);

app.listen(config.port, () => {
  console.log(`Server started on port ${config.port}`);
});
