<?php
    const DB = 'mysql';
    const DB_SERVER = 'localhost';
    const DB_CHARSET = 'utf8';
    
    abstract class DB
    {
        private static $dbUser = 'root';
        private static $dbPassword = 'admin123';
        private static $dbServer = DB_SERVER;
        private static $dbName = 'project';
        private static $dbCharset = DB_CHARSET;
        private $connection;
        public function connectedToDB ()
        {
            try{
                $parameters = 'mysql:host=localhost;dbname=project';
                $pdo = new PDO($parameters,self::$dbUser,self::$dbPassword);
                $pdo->exec('SET CHARACTER SET '.self::$dbCharset);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
                return $pdo;
            }catch(PDOException $e){
                exit ("ERROR: ".$e->getMessage());
            }
        }
        private function disconnectedToDB()
        {
            $this->connection = null;
        }
        abstract protected function createdToDB($registry);
        abstract protected function readToDB();
        abstract protected function updateToDB($registry);
        abstract protected function deleteToDB($registryToDelete);
        abstract protected function readOneRegistryToDB($registry);
    }