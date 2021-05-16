<?php $title = "Modifier le commentaire";

ob_start(); ?>

    <h1>Modification du commentaire</h1>

    <div class="comment">
        <strong> De <?= $comment['author'] ?> le <?= $comment['comment_date_fr'] ?> à <?= $comment['hour_fr']?></strong>
        <form action="index.php?action=modifyComment&postid=<?=$comment['post_id']?>&commentid=<?=$comment['id']?>" method="POST">
        <div>
            <label for="comment">Modifier le commentaire :</label><br>
            <input type="text" name="comment" id="comment"  value="<?= $comment['comment'] ?>"/>
        </div>
        <div>
            <input type="submit" name="Modifier" />
        </div>
        </form>
    </div>
    <?php

$content = ob_get_clean();
require('template.php');
?>