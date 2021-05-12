<?php 

namespace RomainCarrillo\Blog\Model;

require_once ('model/Manager.php');

class PostManager extends Manager {
    
    public function getPosts() {
        $db = $this->dbConnect();
    
        $req = $db->query('SELECT title, author, content, id, DATE_FORMAT(creation_date, "%d/%m/%Y") AS date_fr, DATE_FORMAT(creation_date, "%Hh%imin%ss") AS hour_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
    
        return $req;
    }
    
    public function getPost($postId) {
        $db = $this->dbConnect();
    
        $req_post = $db->prepare('SELECT title, author, content, id, DATE_FORMAT(creation_date, "%d/%m/%Y") AS creation_date_fr FROM posts WHERE id = ?');
        $req_post -> execute(array($postId));
        $post = $req_post -> fetch();
        return $post;
    }

}


?>