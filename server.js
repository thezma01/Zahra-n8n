const express = require('express');
const app = express();
const mongoose = require('mongoose');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

mongoose.connect('mongodb://localhost/pos-system', { useNewUrlParser: true, useUnifiedTopology: true });

const User = require('./models/User');

app.use(express.json());

app.listen(3000, () => {
  console.log('Server started on port 3000');
});
