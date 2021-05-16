<?php
require ('controller/frontend.php');

try {
    if (isset($_GET['action']))  {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if ((isset($_GET['id'])) AND ($_GET['id'] > 0)) {
                post();
            } else {
                throw new Exception('Pas de billet sélectionné.');
            }
        } elseif ($_GET['action'] == 'comment') {
            if ((isset($_GET['postid'])) AND ($_GET['postid'] > 0) AND (isset($_GET['commentid']))) {
                getComment();
            } else {
                throw new Exception('Impossible d\'afficher ce commentaire');
            }  
        } elseif ($_GET['action'] == 'addComment') {
            if ((isset($_GET['id'])) AND ($_GET['id'] > 0)) {
                if (!empty($_POST['author']) AND !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
        } elseif ($_GET['action'] == 'modifyComment') {
            if ((isset($_GET['postid'])) AND ($_GET['postid'] > 0) AND (isset($_GET['commentid'])) AND ($_GET['commentid'] > 0)) {
                modifyComment($_POST['comment'], $_GET['commentid'], $_GET['postid']);
            }  else {
                throw new Exception('Pas de commentaire associé.');
            }  
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}

?>