<?php
    if(isset($_POST['saveEvent']))
    {
        $eventName = $_POST['eventName'];
        $eventDate = $_POST['eventDate'];
        $amountOfHigh = $_POST['amountOfHigh'];
        $amountOfHalf = $_POST['amountOfHalf'];
        $amountOfVip = $_POST['amountOfVip'];
        $amountOfPlatinum = $_POST['amountOfPlatinum'];
        $registry = array('eventName'=>$eventName, 'eventDate'=>$eventDate,
                          'amountOfHigh'=>$amountOfHigh,'amountOfHalf'=>$amountOfHalf,
                          'amountOfVip'=>$amountOfVip,'amountOfPlatinum'=>$amountOfPlatinum);
        include_once '../models/events_model.php';
        $eventsModel = new EventsModel();
        $eventsModel->createdToDB($registry);
        header('location:../views/adminHome.php');
    }