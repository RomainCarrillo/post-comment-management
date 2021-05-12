<?php

function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=blog;chartset=utf8', 'root', 'root');
        return $db;
}

function getPosts() {
    $db = dbConnect();

    $req = $db->query('SELECT title, author, content, id, DATE_FORMAT(creation_date, "%d/%m/%Y") AS date_fr, DATE_FORMAT(creation_date, "%Hh%imin%ss") AS hour_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

function getPost($postId) {
    $db = dbConnect();

    $req_post = $db->prepare('SELECT title, author, content, id, DATE_FORMAT(creation_date, "%d/%m/%Y") AS creation_date_fr FROM posts WHERE id = ?');
    $req_post -> execute(array($postId));
    $post = $req_post -> fetch();
    return $post;
}

function getComments($postId) {
    $db = dbConnect();

    $req_commentaires = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, "%d/%m/%Y") AS comment_date_fr, DATE_FORMAT(comment_date, "%Hh%imin%ss") AS hour_fr  FROM comments WHERE post_id= ? ORDER BY comment_date DESC');
    $req_commentaires->execute(array($postId));

    return $req_commentaires;
}

function postComment($postId, $author, $comment) {
    $db = dbConnect();

    $comments = $db->prepare('INSERT INTO comments (post_id, author, comment) VALUES (:post, :author, :comment)');
    $affectedLines = $comments->execute(array( 
        'post' => htmlspecialchars($postId),
        'author' => htmlspecialchars($author),
        'comment' => htmlspecialchars($comment)
    ));

    return $affectedLines;

}


?>
