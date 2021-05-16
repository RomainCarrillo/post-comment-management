<?php

namespace RomainCarrillo\Blog\Model;

require_once ('model/Manager.php');

class CommentManager extends Manager {

    public function getComments($postId) {
        $db = $this->dbConnect();
    
        $req = $db->prepare('SELECT author, comment, post_id, id, DATE_FORMAT(comment_date, "%d/%m/%Y") AS comment_date_fr, DATE_FORMAT(comment_date, "%Hh%imin%ss") AS hour_fr  FROM comments WHERE post_id= ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        
        return $req;
    }
    
    public function getComment($commentId) {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT author, comment, post_id, id, DATE_FORMAT(comment_date, "%d/%m/%Y") AS comment_date_fr, DATE_FORMAT(comment_date, "%Hh%imin%ss") AS hour_fr  FROM comments WHERE id= ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
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

    public function modifyComment($comment, $commentId) {
        $db = $this->dbConnect();

        $req = $db->prepare('UPDATE comments SET comment=:comment WHERE id = :commentId');
        $modifiedComment = $req->execute(array(
            'comment'=>htmlspecialchars($comment),
            'commentId'=>$commentId    
        ));

        return $modifiedComment;
    }

}

?>