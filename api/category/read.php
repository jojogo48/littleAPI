<?php
    //HEADERS
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';


    //Instantiate DB & connect
    $db=(new Database())->connect();

    //Instantiate Category  object
    $category=new Category($db);

    // Category read query

    $result=$category->read();
    $num=$result->rowCount();

    //check if any category
    if($num>0){
        //category array
        $category_arr=array();
        $category_arr['data']=array();

        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
 
            $category_item=[
            'id'=>$id,
            'name'=>$name,
            ];

            array_push($category_arr['data'],$category_item);
        }
        echo json_encode($category_arr);
    }else {
    echo  json_encode(['message'=>'No category found']);
    }

