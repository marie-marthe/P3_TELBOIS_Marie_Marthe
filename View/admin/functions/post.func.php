<?php

function get_post(){

    global $db;

    $req = $db->query("
        SELECT  chapters.id,
                chapters.title,
                chapters.content,
                chapters.creation_date,
                chapters.posted,
                admins.name
        FROM chapters
        JOIN admins
        ON chapters.content = admins.email
        WHERE chapters.id = '{$_GET['id']}'
    ");

    $result = $req->fetchObject();
    return $result;
}

function edit($title,$content,$posted,$id){

    global $db;

    $e = [
        'title'     => $title,
        'content'   => $content,
        'posted'    => $posted,
        'id'        => $id
    ];

    $sql = "UPDATE chapters SET title= :title, content= :content, creation_date=NOW(), posted=:posted WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($e);

}