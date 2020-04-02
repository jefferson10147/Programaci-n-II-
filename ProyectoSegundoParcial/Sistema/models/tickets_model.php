<?php

    require_once "classDB.php";
    class TicketsModel extends DB
    {
        private $id = 'id';
        private $userId = 'userId';
        private $serial = 'serial';
        private $eventName = 'eventName';
        private $eventDate = 'eventDate';
        private $eventLocation = 'eventLocation';
        private $table = 'tickets';

        public function createdToDB ($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "INSERT INTO $this->table SET $this->userId=:userId, $this->serial=:serial,
                          $this->eventName=:eventName, $this->eventDate=:eventDate,
                          $this->eventLocation=:eventLocation";
                
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
                $query = "UPDATE $this->table SET $this->serial=:serial,
                $this->eventName=:eventName, $this->eventDate=:eventDate,
                $this->eventLocation=:eventLocation 
                WHERE $this->id=:id";
                $update = $connection->prepare($query)->execute($registry);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function deleteToDB($registryToDelete)
        {
            $connection = parent::connectedToDB();
            try{
                $query = "DELETE FROM $this->table WHERE $this->id=:id";
                $delete = $connection->prepare($query)->execute($registryToDelete);
            }catch(Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function readOneRegistryToDB($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->userId=:userId";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }

        public function readOneRegistryToDBId($registry)
        {
            $connection = parent:: connectedToDB();
            try{
                $query = "SELECT * FROM $this->table WHERE $this->id=:id";  
                $result = $connection->prepare($query);
                $result->execute($registry);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }
    }