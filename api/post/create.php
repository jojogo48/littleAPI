<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:appliction/json');
    header('Access-Control-Allow-Methods:POST');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Methodes,
                                        Authorization,X-Requested-With');
    
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $db=(new Database())->connect();

    $post=new post($db);

    $data=json_decode(file_get_contents('php://input'));

    $post->title=$data->title;
    $post->body=$data->body;
    $post->author=$data->author;
    $post->category_id=$data->category_id;

    if($post->create()){
        echo json_encode(array('message'=>'Post create'));
    }else{
        echo json_encode(array('message'=>'Post not create'));
    }
