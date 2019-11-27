<?php

function get_posts(){

    global $db;

    $req = $db->query("SELECT * FROM chapters ORDER BY creation_date DESC");

    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }

    return $results;


}