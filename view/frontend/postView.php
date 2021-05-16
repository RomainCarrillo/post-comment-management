<?php $title = $post['title'];

ob_start(); ?>
        <h1>Le blog de Romain !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <div class="comment">
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong>, le <?= $comment['comment_date_fr'] ?> (<a href="index.php?action=comment&postid=<?= $comment['post_id'] ?>&commentid=<?= $comment['id'] ?>">Modifier le commentaire</a>)</p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            </div>
        <?php
        }
        ?>
        <div class="add-comment">
            <p>Envie de donner votre avis ?</p>
            <form action="index.php?action=addComment&id=<?= $post['id'] ?>" method="POST">
            <div>
                <label for="author">Votre pseudo : </label><br>
                <input type="text" name="author" id="author"/>
            </div>
            <div>
                <label for="comment">Votre message : </label><br>
                <input class="long-text-area" type="text" name="comment" id="comment" />
            </div>
            <div>
                <input type="submit" name="valider" />
            </div>
            </form>
        </div>
        <?php
   
$content = ob_get_clean();
require ('template.php');
?>