<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Methods:DELETE');
    header('Access-Control-Allow-Header:Access-Control-Allow-Header,
                                        Content-Type,
                                        Access-Control-Allow-Methods,
                                        Authorization,
                                        X-Requested-With
                                        ');
    
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $db=(new Database())->connect();
    $post=new Post($db);


    $data=json_decode(file_get_contents('php://input'));

    $post->id=$data->id;

    if($post->delete()){
        echo json_encode(['message'=>'post delete']);
    }else{
        echo json_encode(['message'=>'post not delete']);
    }


