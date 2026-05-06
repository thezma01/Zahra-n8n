const express = require('express');
const app = express();
const authRoutes = require('./routes/auth');
const userRoutes = require('./routes/users');
const config = require('./config');

app.use(express.json());
app.use('/api/auth', authRoutes);
app.use('/api/users', userRoutes);

app.listen(config.port, () => {
    console.log(`Server started on port ${config.port}`);
});
