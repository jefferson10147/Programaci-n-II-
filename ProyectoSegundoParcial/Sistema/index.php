<?php
    include_once 'controllers/user_controller.php';
    include_once 'controllers/user_session.php';

    $user = new User ();
    $userSession = new UserSession ();

    if(isset($_SESSION['userName']))
    {
        $userName = $userSession->getCurrentUser();
        $user->setUserLogin($userName);
        if($user->getKindOfUser() == 'user')
            include_once 'views/home.php';
        else
            header ('location:views/adminHome.php');
        
    } else if(isset($_POST['userName']) && isset($_POST['password']))
    {
        if($user->ifUserLoginExits($_POST['userName'],$_POST['password']))
        {
            $user->setUserLogin($_POST['userName']);
            $userSession->setCurrentUser($_POST['userName']);
            if($user->getKindOfUser() == 'user')
                include_once 'views/home.php';
            else 
                header ('location:views/adminHome.php');  
        }else{
            $errorLogin = "Nombre de usuario y/o password incorrecto";
            session_start();
            $_SESSION['message'] = 'Nombre de usuario y/o constraseña incorrectos.';
            $_SESSION['msgType'] = 'danger';  //success
            include_once 'views/login.php';
        }
    }else{
        include_once 'views/login.php';
    }
