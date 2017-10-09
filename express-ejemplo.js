var express = require('express');
var app = express();
app.use(app.router);

// Cargamos express en vez de http
var express = require('express');
var saludador = require('./models/saludador');

// Lo iniciamos
var app = express();

// Definimos la ruta principal
app.get('/', function (req, res) { // <-- Esta es la ruta!
  // Obtenemos el nombre (no necesitamos el modulo url!)
  var nombre = req.query.nombre;
  res.send('<h1>' + saludador.saludar(nombre) + '</h1>');
});

// Decimos en que puerto queremos escuchar (el 8000)
app.listen(8000, function () {
  console.log("Esperando requests en el puerto 8000");
});

//Rutas en profundidad

app.get('/saludo', function (req, res) {
  var nombre = req.query.nombre;
  res.send('<h1>Hola ' + saludador.saludar(nombre) + '</h1>');
});

app.get('/despedida', function (req, res) {
  var nombre = req.query.nombre;
  res.send('<h1>Chau ' + saludador.saludar(nombre) + '</h1>');
});


//saludadorController.js

var saludador = require('../models/saludador');

function saludo (req, res) {
  var nombre = req.query.nombre;
  res.send('<h1>Hola ' + saludador.saludar(nombre) + '</h1>');
}

function despedida (req, res) {
  var nombre = req.query.nombre;
  res.send('<h1>Chau ' + saludador.saludar(nombre) + '</h1>');
}

module.exports = {
  saludo: saludo,
  despedida: despedida
};

//app.js

// Cargamos express en vez de http
var express = require('express');
var saludador = require('./controllers/saludadorController');

// Lo iniciamos
var app = express();

app.get('/saludo', saludador.saludo);
app.get('/despedida', saludador.despedida);

// Decimos en que puerto queremos escuchar (el 8000)
app.listen(8000, function () {
  console.log("Esperando requests en el puerto 8000");
});


//router.js

var saludador = require('../controllers/saludadorController');

module.exports = function(app) {
  app.get('/saludo', saludador.saludo);
  app.get('/despedida', saludador.despedida);
};

//app.js luego de router.js

// Cargamos express en vez de http
var express = require('express');
var routes =  require('./config/routes');

// Lo iniciamos
var app = express();

routes(app);

// Decimos en que puerto queremos escuchar (el 8000)
app.listen(8000, function () {
  console.log("Esperando requests en el puerto 8000");
});
