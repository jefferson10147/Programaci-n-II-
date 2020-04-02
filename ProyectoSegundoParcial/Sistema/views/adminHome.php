<?php
    include_once '../controllers/user_session.php';
    $userSession = new UserSession ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>  
    <?php
        include_once '../models/users_model.php';
        include_once '../models/tickets_model.php';

        $usersModel = new UsersModel();
        $ticketsModel = new TicketsModel();
        $tickets = $ticketsModel->readToDB();
    ?>
    
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
        <h1>Bienvenido admin:<?php echo $userSession->getCurrentUser();?></h1>
        <a class="btn btn-outline-danger" href="../controllers/logout_controller.php">Cerrar Sesión</a>
    </nav>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Nombre del Evento</th>
                        <th>Ubicación</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                
                <tr>
                    <?php
                        foreach ($tickets as $ticket):
                            $registry = array ('userName'=>$ticket['userId']);
                            $user = $usersModel->readOneRegistryToDB($registry);
                    ?>
                    <td><?php echo $user['name'];?></td>
                    <td><?php echo $user['lastName'];?></td>
                    <td><?php echo $user['ci'];?></td>
                    <td><?php echo $ticket['eventName'];?></td>
                    <td><?php echo $ticket['eventLocation'];?></td>
                    <td>
                        <a href="detail.php?id=<?php echo $ticket['id']?>" class="btn btn-success">Detalles</a>
                        <a href="update.php?id=<?php echo $ticket['id']?>" class="btn btn-info">Actualizar</a>
                        <a href="../controllers/deleteTicket_controller.php?id=<?php echo$ticket['id']?>" class="btn btn-danger">Borrar</a>
                    <td>
                       
                    </td>
                </tr>
                    <?php 
                        endforeach;
                    ?>
            </table>
            
        </div>
        <div class=container>
            <div class="row justify-content-center">
                <a href="registerEvent.php" class="btn btn-info">Registrar Nuevo Evento</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>