<?php

function inTable($table){
    global $db;
    $query = $db->query("SELECT COUNT(id) FROM chapters $table");
    return $nombre = $query->fetch();
}

function getColor($table,$colors){
    if(isset($colors[$table])){
        return $colors[$table];
    }else{
        return "orange";
    }
}

function get_comments(){
    global $db;

    $req = $db->query("
        SELECT  comments.id,
                comments.author,
                comments.comment_date,
                comments.chapter_id,
                comments.comment,
                chapters.title
        FROM comments
        JOIN chapters
        ON comments.chapter_id = chapters.id
        WHERE comments.signal_comment = '0'
        ORDER BY comments.comment_date ASC
    ");

    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
    return $results;
}

function get_user(){
    global $db;

    $req = $db->query("
        SELECT * FROM admins WHERE email='{$_SESSION['admin']}';
    ");

    $result = $req->fetchObject();
    return $result;
}