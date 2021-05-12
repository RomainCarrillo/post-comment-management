<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');


function listPosts() {

    $postManager = new RomainCarrillo\Blog\Model\PostManager;
    $posts = $postManager->getPosts();
    
    require('view/frontend/listPostsView.php');
}


function post() {
    
    $postManager = new RomainCarrillo\Blog\Model\PostManager;
    $commentManager = new RomainCarrillo\Blog\Model\CommentManager;

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    
    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment) {

    $commentManager = new RomainCarrillo\Blog\Model\CommentManager;

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire.');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }

    require('view/frontend/postView.php');    
}
