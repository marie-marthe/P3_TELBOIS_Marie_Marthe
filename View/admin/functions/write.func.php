<?php

function post($title,$content,$creation_date){
    global $db;

    $p = [
        'title'     =>  $title,
        'content'   =>  $content,
        'writer'    =>  $_SESSION['admin'],
        'posted'    =>  $creation_date

    ];

    $sql = "
      INSERT INTO chapters(title,content,creation_date)
      VALUES(:title,:content,:creation_date)
    ";

    $req = $db->prepare($sql);
    $req->execute($p);

}
