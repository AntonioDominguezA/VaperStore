<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/vape.png">

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">

    <script src="js/main.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>SingUp</title>
</head>
<body>
    <header>
        <a href="/Proyecto">INICIO</a>
    </header>
    <img src="img/vape.png" alt="Vaper" style="width: 10%;height:10%">

    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="signup.php" method="post">
        <input type="text" id="user" name="user" placeholder="Ingresar Usuario">
        <label for="tipo">Select a speed</label>
        <select name="tipo" id="tipo">
            <option>root</option>
            <option>normal</option>
        </select>
        <input type="text" id="emple" name="idempleado" placeholder="ID del empleado">
        <input type="password" id="pass" name="password" placeholder="Ingresa contraseña">
        <input type="button" value="Crear" id="enviar">
    </form>


</body>
</html>
