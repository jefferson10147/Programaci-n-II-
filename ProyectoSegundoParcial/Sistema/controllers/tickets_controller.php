<?php
    include_once '../models/events_model.php';
    if(isset($_POST['save']))
    {
        $serial =  $_POST['serial'];
        $eventName = $_POST['eventName'];
        $eventDate =  $_POST['eventDate'];
        $eventLocation = $_POST['eventLocation'];
        $registry =  array ('eventName' => $eventName);
        $eventsModel =  new EventsModel();
        $result = $eventsModel->readOneRegistryToDB ($registry);
        if(isset($result['eventName']))
        {
            if (strcmp($result['eventDate'],$eventDate)==0)
            {
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
                    $errorHome = "Ya no quedan asientos en la localización elegida.";
                    include_once '../views/home.php';
                }
                include_once 'user_session.php';
                $userId = (new UserSession())->getCurrentUser();
               $ticketToRegistry = array ('userId'=>$userId,'serial'=>$serial,
                                        'eventName'=>$eventName,'eventDate'=>$eventDate,
                                        'eventLocation'=>$eventLocation);
                include_once '../models/tickets_model.php';
                $ticketsModel = new TicketsModel();
                $ticketsModel->createdToDB($ticketToRegistry);
                session_start();
                $_SESSION['message'] = 'Ticket registrado con éxito.';
                $_SESSION['msgType'] = 'success';
                header('location:../views/home.php'); 
            }else{
                session_start();
                $_SESSION['message'] = 'Fecha del evento invalida, por favor intente de nuevo.';
                $_SESSION['msgType'] = 'danger';
                include_once '../views/home.php';
            }
        }else{
            session_start();
            $_SESSION['message'] = 'Nombre del evento invalido, por favor intente de nuevo.';
            $_SESSION['msgType'] = 'danger';
            include_once '../views/home.php';
        }
    }

    