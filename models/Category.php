<?php 
   class Category{
       //DB stuff
        private $conn;
        private $table='categories';

        public $id;
        public $name;
        public $created_at;

        public function __construct($db){
            $this->conn=$db;
        }

        public function read(){
            $query='SELECT id,name,created_at FROM '.$this->table.
            ' ORDER BY 
                created_at DESC';

            $stmt=$this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }
   } 