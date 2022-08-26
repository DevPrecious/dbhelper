<?php

use app\src\DBHelper;

include 'db.php';

require_once __DIR__.'/vendor/autoload.php';

$db = new DBHelper($cred);

$posts =  $db::all('posts');


foreach($posts as $post) {
    echo $post['content'];
}

$datatosave = [
    'user_id' => 2,
    'content' => 'Testing again' 
];

$send = $db::insert('posts', $datatosave);

if($send == 'Success') {
    echo 'Data insered';
}else{
    echo 'Failed to insert data';
}

// print_r($send);