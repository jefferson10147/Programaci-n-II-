<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <?php
        if(isset($_SESSION['message'])):
    ?>
    <div class="alert alert-<?=$_SESSION['msgType']?>">
        <?php echo 
            $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php
        endif;
    ?>
    <div class="modal-dialog">
        <div class="col-sm-15 main-section">
            <div class="modal-content">
                <div class="row justify-content-center">
                    <h1>Registro de Usuario</h1>
                </div>
                <form action="../controllers/register_controller.php" method="post" class="col-12">
                    <div class="form-group">
                        <label>Nombres:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Apellidos:</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Cedula: V-</label>
                        <input type="text" name="ci" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="maleOrFemale" value="M"> Hombre
                        <input type="radio" name="maleOrFemale" value="F"> Mujer
                    </div>
                    <div class="form-group">
                        <label>Teléfono: +58 04</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="userName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Repetir Contraseña:</label>
                        <input type="password" name="passwordR" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-15">
                            <div class="row justify-content-center">
                                <button type="submit" name="save" class="btn btn-primary"> Enviar </button>
                                <a class="btn btn-danger" href="../views/login.php" role="button">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>