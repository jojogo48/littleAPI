<?php
    class Post{
        private $conn;
        private $table='posts';

        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;


        public function __construct($db){
            $this->conn=$db;
        }

        public function read(){
            $query='SELECT c.name as category_name , 
                 p.id,
                 p.category_id,
                 p.title,
                 p.body,
                 p.author,
                 p.created_at
            FROM 
                '.$this->table.' p
            LEFT JOIN 
                categories c ON p.category_id=c.id
            ORDER BY 
                p.created_at DESC';

            $stmt=$this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }
        public function read_single(){
            $query='SELECT c.name as category_name , 
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
       FROM 
           '.$this->table.' p
       LEFT JOIN 
           categories c ON p.category_id=c.id
        WHERE 
           p.id=:id
        LIMIT 0,1       
            ';

        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        $row=$stmt->fetch();


        $this->title=$row['title'];
        $this->body=$row['body'];
        $this->category_id=$row['category_id'];
        $this->category_name=$row['category_name'];
        }
        public function create(){
        $query='INSERT INTO '.$this->table.'(title,body,author,category_id)
            Value(
                :title,
                :body,
                :author,
                :category_id
            )
            ';
        //prepare statement
        $stmt=$this->conn->prepare($query);

        //bind parameter and clean data
        $stmt->bindParam(':title',htmlspecialchars(strip_tags($this->title)));
        $stmt->bindParam(':body',htmlspecialchars(strip_tags($this->body)));
        $stmt->bindParam(':author',htmlspecialchars(strip_tags($this->author)));
        $stmt->bindParam(':category_id',htmlspecialchars(strip_tags($this->category_id)));

        //print error if go wrong
        if($stmt->execute()){
            var_dump($stamt);
            return true;
        }

        echo 'error: '.$stmt->error;
        return false ;
        }
    

        public function update(){
        $query='UPDATE '.$this->table.'
            SET 
                title=:title,
                body=:body,
                author=:author,
                category_id=:category_id
            WHERE
                id=:id
            ';
        $stmt=$this->conn->prepare($query);

        $this->title =htmlspecialchars(strip_tags($this->title));
        $this->body  =htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);
        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }

        printf('Error %s .\n',$stmt->error);

        return false;
    }

    public function delete(){
        $query='DELETE FROM '.$this->table.' WHERE id=:id';

        $stmt=$this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }
        printf('Error %s .\n',$stmt->error);

        return false;
    }
}
