<?php
    require_once '../models/users_model.php';
    if(isset($_POST['save']))
    {
        if(strcmp($_POST['password'],$_POST['passwordR'])==0)
        {
            $userModel = new  UsersModel();
            $name = $_POST['name'];
            $registry = array('userName'=>$userName);
            $lastName = $_POST['lastName'];
            $ci = $_POST['ci'];
            $address = $_POST['address'];
            $maleOrFemale = $_POST['maleOrFemale'];
            $phone = $_POST['phone'];
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $registry = array('userName'=>$userName);
            $result = $userModel->ifExitsUserName($registry);
            if(isset($result['userName']))
            {
                session_start();
                $_SESSION['message'] = 'El nombre de usuario ya existe, intente con otro.';
                $_SESSION['msgType'] = 'danger';
                include_once '../views/register.php';    
            }else{
                $registry = array('name'=>$name, 'lastName'=>$lastName,
                                  'ci'=>$ci,'address'=>$address,
                                   'maleOrFemale'=>$maleOrFemale, 'phone'=>$phone,
                                   'userName'=>$userName, 'password'=>$password);
                $userModel->createdToDB($registry);
                include_once '../views/login.php';
            }            
        }else{
            session_start();
            $_SESSION['message'] = 'Las contraseñas no coinciden.';
            $_SESSION['msgType'] = 'danger';
            include_once '../views/register.php';
        }
    }
?>