<?php
    include_once '../models/tickets_model.php';
    include_once '../models/users_model.php';
    $usersModel = new UsersModel ();
    $ticketsModel = new TicketsModel ();
    if(isset($_SESSION['idToDetail']))
    {
        $registry = array ('id'=>$_SESSION['idToDetail']);
        $result = $ticketsModel->readOneRegistryToDBId($registry);
    }else
    {
        $registry = array ('id'=>$_GET['id']);
        $result = $ticketsModel->readOneRegistryToDBId($registry);
    }
    session_start();
    $_SESSION['idToDetail'] = $registry['id'];
    $registry2 = array('userName'=>$result['userId']);
    $resultUser = $usersModel->readOneRegistryToDB($registry2);
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
    <nav class="navbar navbar-light bg-faded">
        <h1></h1>
        <a class="btn btn-outline-danger" href="../controllers/logout_controller.php">Cerrar Sesión</a>
    </nav>
    <div class="modal-dialog">
        <div class="col-sm-12 main-section">
            <div class="modal-content">
                <div class="row justify-content-center">
                    <h1>Detalles de Ticket</h1>
                </div>
                <label>Nombre: <?php echo $resultUser['name'].' '.$resultUser['lastName'];?></label>
                <label>C.I: <?php echo $resultUser['ci'];?></label>
                <label>Teléfono: <?php echo $resultUser['phone'];?></label>
                <label>Dirección: <?php echo $resultUser['address'];?></label>

                <label>Serial:<?php echo $result['serial'];?></label>
                <label>Nombre de Evento: <?php echo $result['eventName'];?></label>
                <label>Fecha de Evento:<?php echo $result['eventDate'];?></label>
                <label>Lugar: <?php echo $result['eventLocation'];?></label>
                <div class="col-sm-12">
                    <div class="row justify-content-center">
                        <a href="adminHome.php" class="btn btn-success">Hecho</a>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>