<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario - Gestión de turnos</title>
    <style>
    body {
      background: url("https://i.pinimg.com/1200x/9b/e2/12/9be212df4fc8537ddc31c3f7fa147b42.jpg") no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .card-form {
      background: rgba(0, 22, 41, 0.9);
      /* card oscura */
      padding: 30px;
      border-radius: 12px;
      width: 400px;
      color: #fff;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
    }

    .card-form h1 {
      text-align: center;
      margin-bottom: 25px;
      color: #fff;
    }

    .card-form label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
      font-size: 0.9em;
    }

    .card-form select,
    .card-form input {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: none;
      margin-bottom: 15px;
      font-size: 0.95em;
    }

    .card-form button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background: #00b4ff;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .card-form button:hover {
      background: #008ccc;
    }

    #resultado-busqueda {
      margin-top: 20px;
      background: rgba(255, 255, 255, 0.1);
      padding: 15px;
      border-radius: 8px;
      max-height: 300px;
      overflow-y: auto;
    }

    #resultado-busqueda div {
      background: rgba(255, 255, 255, 0.15);
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
    }

    #resultado-busqueda h4 {
      margin: 0;
      color: #00ff99;
    }

    #resultado-busqueda button {
      background: #1e88e5;
      margin-top: 5px;
      padding: 6px 12px;
      border-radius: 5px;
    }

    #resultado-busqueda button:hover {
      background: #1565c0;
    }
  </style>
</head>
<body>
    <form action="../../Logica/Paciente/registroPaciente.php" method="POST" enctype="multipart/form-data">
        <h2>Registro de Usuario</h2>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label>Tipo de documento:</label>
        <div>
            <label><input type="radio" name="tipo_documento" value="DNI" required> DNI</label>
            <label><input type="radio" name="tipo_documento" value="Pasaporte"> Pasaporte</label>
            <label><input type="radio" name="tipo_documento" value="Otro"> Otro</label>
        </div>

        <label for="numero_documento">Número de documento:</label>
        <input type="text" id="numero_documento" name="numero_documento" required>

        <label for="imagen_dni">Imagen del DNI (frente y dorso):</label>
        <input type="file" id="imagen_dni" name="imagen_dni" accept="image/*" required>

        <label>Género:</label>
        <div>
            <label><input type="radio" name="genero" value="Masculino" required> Masculino</label>
            <label><input type="radio" name="genero" value="Femenino"> Femenino</label>
            <label><input type="radio" name="genero" value="Otro"> Otro</label>
        </div>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

        <label for="domicilio">Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio" required>

        <label for="numero_contacto">Número de contacto:</label>
        <input type="tel" id="numero_contacto" name="numero_contacto" required>

        
        <label>Cobertura de salud:</label>
        <div class="radio-group">
            <label><input type="radio" name="cobertura_salud" value="UOM" checked required> UOM</label>
            <label><input type="radio" name="cobertura_salud" value="OSDE"> OSDE</label>
            <label><input type="radio" name="cobertura_salud" value="Swiss Medical"> Swiss Medical</label>
            <label><input type="radio" name="cobertura_salud" value="Galeno"> Galeno</label>
            <label><input type="radio" name="cobertura_salud" value="Otra"> Otra</label>
        </div>

        <label for="numero_afiliado">Número de afiliado:</label>
        <input type="text" id="numero_afiliado" name="numero_afiliado" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label>
            <input type="checkbox" name="terminos" required> Acepto los términos y condiciones
        </label>

        <div>
            <button type="submit">Registrarse</button>
            ¿Ya tienes cuenta? <a href="../../index.php">Inicia sesión</a>
        </div>
  </form>
</body>
</html>