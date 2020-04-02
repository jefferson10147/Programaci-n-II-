<?php  
    require_once "classDB.php";
    class UsersModel extends DB
    {
        private $name = 'name';
        private $lastName = 'lastName';
        private $ci = 'ci';
        private $address = 'address';
        private $maleOrFemale = 'maleOrFemale';
        private $phone = 'phone';
        private $userName = 'userName';
        private $password = 'password';
        private $table = 'users';

        public function createdToDB ($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "INSERT INTO $this->table SET $this->name=:name,
                        $this->lastName=:lastName, $this->ci=:ci, $this->address=:address,
                        $this->maleOrFemale=:maleOrFemale, $this->phone=:phone,
                        $this->userName=:userName, $this->password=:password";
                
                $insert = $connection->prepare($query)->execute($registry);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function readToDB()
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table";  
                return $connection->query($query)->fetchAll();
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function updateToDB($registry)
        {
            $connection = parent::connectedToDB();
            try{
               
                $query = "UPDATE $this->table SET $this->name=:name,
                $this->lastName=:lastName, $this->ci=:ci,
                $this->address=:address, $this->maleOrFemale=:maleOrFemale, $this->phone=:phone 
                WHERE $this->userName=:userName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function deleteToDB($registryToDelete)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "DELETE FROM $this->table WHERE $this->userName=:userName";
                $delete = $connection->prepare($query)->execute($registryToDelete);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function readOneRegistryToDB($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->userName=:userName";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        } 

        public function ifExits($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->userName=:userName 
                AND $this->password=:password";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function ifExitsUserName($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->userName=:userName";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }
    }
?>