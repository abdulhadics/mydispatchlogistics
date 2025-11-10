const express = require('express');
const router = express.Router();
const mongoose = require('mongoose');

const contactSchema = new mongoose.Schema(
  {
    name: String,
    email: String,
    phone: String,
    company: String,
    message: String,
    service: String,
  },
  { timestamps: true }
);

const Contact = mongoose.models.Contact || mongoose.model('Contact', contactSchema);

router.post('/', async (req, res, next) => {
  try {
    const saved = await Contact.create(req.body);
    // TODO: integrate nodemailer with SMTP creds in .env
    res.status(201).json({ ok: true, id: saved._id });
  } catch (e) { next(e); }
});

module.exports = router;

