const nodemailer = require('nodemailer');
 
// Configurar el transporte SMTP de Gmail
const transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'jesusernestoortiz405@gmail.com', // tu Gmail
    pass: 'vnijgnhgnhhuurix', // contraseña de aplicación generada
  },
});
 
// Configurar el mensaje
const mailOptions = {
  from: 'jesusernestoortiz405@gmail.com',
  to: 'jesusernestoortiz405@gmail.com',
  subject: 'Correo de prueba desde Node.js',
  text: 'Hola! Este correo fue enviado desde Node.js usando Gmail y contraseña de aplicación.',
};
 
// Enviar el correo
transporter.sendMail(mailOptions, (error, info) => {
  if (error) {
    return console.log('Error:', error);
  }
  console.log('Correo enviado:', info.response);
});