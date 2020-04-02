<?php
    include_once '../models/events_model.php';
    
    if(isset($_POST['updateButton']))
    {
        session_start();
        $id = $_SESSION['idToUpdate'];
        $locationToUpdate = $_SESSION['locationToUpdate'];
        unset($_SESSION['locationToUpdate']);
        $serial = $_POST['serial'];
        $eventName = $_POST['eventName'];
        $eventDate = $_POST['eventDate'];
        $eventLocation = $_POST['eventLocation'];
        $registry =  array ('eventName' => $eventName);
        $eventsModel =  new EventsModel();
        $result = $eventsModel->readOneRegistryToDB ($registry);
        if(isset($result['eventName']))
        {
            if (strcmp($result['eventDate'],$eventDate)==0)
            {
                if($locationToUpdate == 'alto')
                {
                    $aux = $result['amountOfHigh'];
                    $aux++;
                    $update = array ('eventName'=>$eventName,'amountOfHigh'=>$aux);
                    $eventsModel->updateToDBHigh($update);
                }elseif ($locationToUpdate == 'medio')
                {
                    $aux = $result['amountOfHalf'];
                    $aux++;
                    $update = array ('eventName'=>$eventName,'amountOfHalf'=>$aux);
                    $eventsModel->updateToDBHalf($update);
                }elseif ($locationToUpdate == 'vip')
                {
                    $aux = $result['amountOfVip'];
                    $aux++;
                    $update = array ('eventName'=>$eventName,'amountOfVip'=>$aux);
                    $eventsModel->updateToDBVip($update);
                }elseif ($locationToUpdate == 'platinum')
                {
                    $aux = $result['amountOfPlatinum'];
                    $aux++;
                    $update = array ('eventName'=>$eventName,'amountOfPlatinum'=>$aux);
                    $eventsModel->updateToDBPlatinum($update);
                }

                if($result['amountOfHigh']>0 && $eventLocation == 'alto')
                {
                    $result['amountOfHigh'] --;
                    $update = array ('eventName'=>$eventName,
                                    'amountOfHigh'=>$result['amountOfHigh']);
                    $eventsModel->updateToDBHigh($update);
                }elseif($result['amountOfHalf']>0 && $eventLocation == 'medio')
                {
                    $result['amountOfHalf'] --;
                    $update = array ('eventName'=>$eventName,
                                    'amountOfHalf'=>$result['amountOfHalf']);
                    $eventsModel->updateToDBHalf($update);
                }elseif($result['amountOfVip']>0 && $eventLocation == 'vip')
                {
                    $result['amountOfVip'] --;
                    $update = array ('eventName'=>$eventName,
                                    'amountOfVip'=>$result['amountOfVip']);
                    $eventsModel->updateToDBVip($update);
                }elseif ($result['amountOfPlatinum']>0 && $eventLocation == 'platinum')
                {
                    $result['amountOfPlatinum']--;
                    $update = array ('eventName'=>$eventName,
                                    'amountOfPlatinum'=>$result['amountOfPlatinum']);
                    $eventsModel->updateToDBPlatinum($update);
                }else{
                    $errorUpdate = "Ya no quedan asientos en la localización elegida.";
                    include_once '../views/update.php';
                }
                include_once 'user_session.php';
                $userId = (new UserSession())->getCurrentUser();
               $ticketToRegistry = array ('id'=>$id,'serial'=>$serial,
                                        'eventName'=>$eventName,'eventDate'=>$eventDate,
                                        'eventLocation'=>$eventLocation);
                include_once '../models/tickets_model.php';
                $ticketsModel = new TicketsModel();
                $ticketsModel->updateToDB($ticketToRegistry);
                unset($_SESSION['idToUpdate']);
                $_SESSION['message'] = 'Se ha actualizado correctamente el registro.';
                $_SESSION['msgType'] = 'success';
                header('location:../views/adminHome.php'); 
            }else{
                $_SESSION['message'] = 'Error en la fecha del evento.';
                $_SESSION['msgType'] = 'danger'; 
                include_once '../views/update.php';
            }
        }else{
            $_SESSION['message'] = 'Error en el nombre del evento.';
            $_SESSION['msgType'] = 'danger';  
            include_once "../views/update.php";
        }
    }
    
    
