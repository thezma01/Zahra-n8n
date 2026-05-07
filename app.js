const express = require('express');
const app = express();
const authRouter = require('./routes/auth');
const connectDB = require('./config/database');
const authenticate = require('./middleware/authMiddleware');

app.use(express.json());
app.use('/api/auth', authRouter);
app.use(authenticate);

connectDB();

const port = 3000;
app.listen(port, () => {
  console.log(`Server started on port ${port}`);
});
