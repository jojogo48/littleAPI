<?php

    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $db=(new Database())->connect();

    $post=new Post($db);

    $post_id=isset($_GET['id'])?$_GET['id']:die();
    $post->id=$post_id;
    $post->read_single();
    $post_arr=[
        'id'=>$post->id,
        'title'=>$post->title,
        'body'=>$post->body,
        'author'=>$pot->author,
        'category_id'=>$post->category_id,
        'category_name'=>$post->category_name
    ];

    echo json_encode($post_arr);

