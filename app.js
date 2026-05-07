const express = require('express');
const app = express();
const authController = require('./controllers/AuthController');
const authRoutes = require('./routes/auth');

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use('/auth', authRoutes);

app.listen(3000, () => {
    console.log('Server listening on port 3000');
});
