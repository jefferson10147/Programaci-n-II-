<?php
    include_once 'models/users_model.php';  //../'models/users_model.php';
    class User
    {
        private $userNameLogin;
        private $nameLogin;
        private $kindOfUser;
        private $userModel;

        public function __construct ()
        {
            $this->userModel = new UsersModel();
        }
        
        public function ifUserLoginExits($userNameToSearch, $passwordToSearch)
        {   
            $registry = ['userName'=>$userNameToSearch,'password'=>$passwordToSearch];
            $result = $this->userModel->ifExits($registry);
            if(isset($result['userName']) && isset($result['password']))
               return true;  
            else
               return false;
        }

        public function setUserLogin($userName)
        {
            $registry = ['userName'=>$userName];
            $result = $this->userModel->readOneRegistryToDB($registry);
            $this->userNameLogin = $result['userName'];
            $this->nameLogin = $result['name'];
            $this->kindOfUser = $result['role'];
        }

        public function getUserLogin ()
        {
            return $this->nameLogin;
        }

        public function getUserNameLogin ()
        {
            return $this->userNameLogin;
        }

        public function getKindOfUser()
        {
            return $this->kindOfUser;
        }
    }
?>