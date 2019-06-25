<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //connect database
    $db=(new Database())->connect();

    //get all post items
    $post=new Post($db);
    $result=$post->read();

    $num=$result->rowCount();

  
   
    if($num>0){
        $post_arr=array();
        $post_arr['data']=array();

        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item=[
                'id'=>$id,
                'title'=>$title,
                'body'=>$body,
                'author'=>$author,
                'category_id'=>$category_id,
                'category_name'=>$category_name
            ];

            array_push($post_arr['data'],$post_item);
        }
        echo json_encode($post_arr);
    }else{
        echo json_encode(['message'=>'no posts found']);
    }

   




