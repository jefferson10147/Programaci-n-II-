<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Evento</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<nav class="navbar navbar-light bg-faded">
    <h1></h1>
    <a class="btn btn-outline-danger" href="../controllers/logout_controller.php">Cerrar Sesión</a>
</nav>
<div class="modal-dialog">
        <div class="col-sm-15 main-section">
            <div class="modal-content">
                <div class="row justify-content-center">
                    <h1>Registro de Evento</h1>
                </div>
                <form action="../controllers/registerEvent_controller.php" method="post" class="col-12">
                    <div class="form-group">
                        <label>Nombre del Evento:</label>
                        <input type="text" name="eventName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha del Evento:</label>
                        <input type="date" name="eventDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Número de asientos altos:</label>
                        <input type="number" name="amountOfHigh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Número de asientos medios:</label>
                        <input type="number" name="amountOfHalf" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Número de asientos VIP:</label>
                        <input type="number" name="amountOfVip" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Número de asientos Platinum:</label>
                        <input type="number" name="amountOfPlatinum" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-15">
                            <div class="row justify-content-center">
                                <button type="submit" name="saveEvent" class="btn btn-primary">Enviar</button>
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