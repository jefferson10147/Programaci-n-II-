<?php
    include_once '../models/tickets_model.php';
    $ticketsModel = new TicketsModel ();
    if(isset($_SESSION['idToUpdate']))
    {
        $registry = array ('id'=>$_SESSION['idToUpdate']);
        $result = $ticketsModel->readOneRegistryToDBId($registry);
    }else
    {
        $registry = array ('id'=>$_GET['id']);
        $result = $ticketsModel->readOneRegistryToDBId($registry);
    }
    session_start();
    $_SESSION['idToUpdate'] = $registry['id'];
    $_SESSION['locationToUpdate'] = $result ['eventLocation'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Ticket</title>
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
    <nav class="navbar navbar-light bg-faded">
        <h1></h1>
        <a class="btn btn-outline-danger" href="../controllers/logout_controller.php">Cerrar Sesión</a>
    </nav>
    <div class="modal-dialog">
        <div class="col-sm-15 main-section">
            <div class="modal-content">
                <div class="row justify-content-center">
                    <h1>Registro de Ticket</h1>
                </div>
                <form action="../controllers/updateTicket_controller.php" method="post" class="col-12">
                    <div class="form-group">
                        <label>Serial</label>
                        <input type="text" name="serial" class="form-control" value="<?php echo $result['serial'];?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de Evento</label>
                        <input type="text" name="eventName" class="form-control" value="<?php echo $result['eventName']?>"required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Evento</label>
                        <input type="date" name="eventDate" class="form-control" value="<?php echo $result['eventDate']?>"required>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="eventLocation" value="alto"> Altos
                        <input type="radio" name="eventLocation" value="medio"> Medios
                        <input type="radio" name="eventLocation" value="vip"> Vip
                        <input type="radio" name="eventLocation" value="platinum"> Platinum
                    </div>
                    <div class="form-group">
                        <div class="col-sm-15">
                            <div class="row justify-content-center">
                                <button type="submit" name="updateButton" class="btn btn-primary">Actualizar</button>
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