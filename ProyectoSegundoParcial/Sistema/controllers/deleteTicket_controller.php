<?php   
    include_once '../models/tickets_model.php';
    include_once '../models/events_model.php';
    $ticketsModel = new TicketsModel ();
    $eventsModel = new EventsModel();
    $registry = array ('id'=>$_GET['id']);
    $result = $ticketsModel->readOneRegistryToDBId($registry);
    $eventName = $result ['eventName'];
    $locationToUpdate = $result['eventLocation'];
    $ticketsModel->deleteToDB($registry);
    $registry2 = array ('eventName'=>$eventName);
    $result2 = $eventsModel->readOneRegistryToDB($registry2);
    if($locationToUpdate == 'alto')
    {
        $aux = $result2['amountOfHigh'];
        $aux++;
        $update = array ('eventName'=>$eventName,'amountOfHigh'=>$aux);
        $eventsModel->updateToDBHigh($update);
    }elseif ($locationToUpdate == 'medio')
    {
        $aux = $result2['amountOfHalf'];
        $aux++;
        $update = array ('eventName'=>$eventName,'amountOfHalf'=>$aux);
        $eventsModel->updateToDBHalf($update);
    }elseif ($locationToUpdate == 'vip')
    {
        $aux = $result2['amountOfVip'];
        $aux++;
        $update = array ('eventName'=>$eventName,'amountOfVip'=>$aux);
        $eventsModel->updateToDBVip($update);
    }elseif ($locationToUpdate == 'platinum')
    {
        $aux = $result2['amountOfPlatinum'];
        $aux++;
        $update = array ('eventName'=>$eventName,'amountOfPlatinum'=>$aux);
        $eventsModel->updateToDBPlatinum($update);
    }
    session_start();
    $_SESSION['message'] = 'El registro ha sido borrado.';
    $_SESSION['msgType'] = 'danger';  //success
    header('location:../views/adminHome.php');