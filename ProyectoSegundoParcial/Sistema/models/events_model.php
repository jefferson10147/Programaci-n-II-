<?php  
    require_once "classDB.php";
    class EventsModel extends DB
    {
        private $eventName = 'eventName';
        private $eventDate = 'eventDate';
        private $amountOfHigh = 'amountOfHigh';
        private $amountOfHalf = 'amountOfHalf';
        private $amountOfVip = 'amountOfVip';
        private $amountOfPlatinum = 'amountOfPlatinum'; 
        private $table = 'events';

        public function createdToDB ($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "INSERT INTO $this->table SET $this->eventName=:eventName, $this->eventDate=:eventDate,
                $this->amountOfHigh=:amountOfHigh ,$this->amountOfHalf=:amountOfHalf,$this->amountOfVip=:amountOfVip,
                $this->amountOfPlatinum=:amountOfPlatinum";
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
                $query = "UPDATE $this->table SET $this->eventDate=:eventDate, 
                $this->amountOfHigh=:amountOfHigh ,$this->amountOfHalf=:amountOfHalf, 
                $this->amountOfVip=:amountOfVip, $this->amountOfPlatinum=:amountOfPlatinum 
                WHERE $this->eventName=:eventName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function updateToDBHigh($registry)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "UPDATE $this->table SET $this->amountOfHigh=:amountOfHigh 
                WHERE $this->eventName=:eventName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function updateToDBHalf($registry)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "UPDATE $this->table SET $this->amountOfHalf=:amountOfHalf 
                WHERE $this->eventName=:eventName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function updateToDBVip($registry)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "UPDATE $this->table SET $this->amountOfVip=:amountOfVip 
                WHERE $this->eventName=:eventName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function updateToDBPlatinum($registry)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "UPDATE $this->table SET $this->amountOfPlatinum=:amountOfPlatinum 
                WHERE $this->eventName=:eventName";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function deleteToDB($registryToDelete)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "DELETE FROM $this->table WHERE $this->eventName=:eventName";
                $delete = $connection->prepare($query)->execute($registryToDelete);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function readOneRegistryToDB($registry)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->eventName=:eventName";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }
    }