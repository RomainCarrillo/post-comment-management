<?php $title = "Bienvenue sur mon blog";

ob_start(); ?>
<h1>Blog de Romain !</h1>
    <h2>Les derniers billets</h2>
    <?php 
        while($post = $posts->fetch()){
            echo 
                '<div class="news">
                <h3>' . htmlspecialchars($post['title']) . ' Le ' . $post['date_fr'] . ' à ' . $post['hour_fr'] . '</h3>
                <p>' . nl2br(htmlspecialchars($post['content'])) . '</p>
                <span>Par ' . htmlspecialchars($post['author']) . '</span> <a href=index.php?action=post&id=' . $post['id'] . '>Voir les commentaires</a>
            </div>'; 
        }
        $posts->closeCursor();
   
$content = ob_get_clean();
require ('template.php');
?>