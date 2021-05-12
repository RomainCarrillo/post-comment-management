<?php

namespace RomainCarrillo\Blog\Model;

require_once ('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId) {
        $db = $this->dbConnect();
    
        $req_commentaires = $db->prepare('SELECT author, comment, DATE_FORMAT(comment_date, "%d/%m/%Y") AS comment_date_fr, DATE_FORMAT(comment_date, "%Hh%imin%ss") AS hour_fr  FROM comments WHERE post_id= ? ORDER BY comment_date DESC');
        $req_commentaires->execute(array($postId));
    
        return $req_commentaires;
    }
    
    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
    
        $comments = $db->prepare('INSERT INTO comments (post_id, author, comment) VALUES (:post, :author, :comment)');
        $affectedLines = $comments->execute(array( 
            'post' => htmlspecialchars($postId),
            'author' => htmlspecialchars($author),
            'comment' => htmlspecialchars($comment)
        ));
    
        return $affectedLines;
    
    }

}

?>