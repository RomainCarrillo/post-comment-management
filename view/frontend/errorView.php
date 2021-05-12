<?php $title = 'Attention erreur !';

ob_start(); ?>

<h1>Attention erreur! </h1>
<div>
    <p>Erreur : <?= $errorMessage; ?></p>
</div>
<?php

$content = ob_get_clean();
require ('template.php');
?>