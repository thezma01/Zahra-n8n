const express = require('express');
const app = express();
const config = require('./config');
const authRoutes = require('./routes/auth');
const userRoutes = require('./routes/users');

app.use(express.json());

app.use('/api/auth', authRoutes);
app.use('/api/users', userRoutes);

app.listen(config.port, () => {
  console.log(`Server started on port ${config.port}`);
});
