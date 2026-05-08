const express = require('express');
const app = express();
const authRoutes = require('./routes/auth');

app.use(express.json());
app.use('/api/auth', authRoutes);

const port = 3000;
app.listen(port, () => {
  console.log(`Server started on port ${port}`);
});
