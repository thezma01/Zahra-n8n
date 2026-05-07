const express = require('express');
const router = express.Router();
const RoleController = require('../controllers/RoleController');

const roleController = new RoleController();

router.get('/roles', roleController.getAllRoles);
router.get('/roles/:id', roleController.getRoleById);
router.post('/roles', roleController.createRole);
router.put('/roles/:id', roleController.updateRole);
router.delete('/roles/:id', roleController.deleteRole);
router.get('/roles/:id/permissions', roleController.getPermissions);

module.exports = router;
