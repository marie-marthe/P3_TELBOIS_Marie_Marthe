<?php
if(admin()!=1){
    header("Location:index.php?page=dashboard");
}

?>
<h2>Listes des articles</h2>
<hr/>

<?php

$posts = get_posts();
foreach($posts as $post){
    ?>
    <div class="row">
        <div class="col s12">
            <h4><?= $post->title ?><?php echo ($post->posted == "0") ? "<i class='material-icons'>lock</i>" : "" ?></h4>

            <div class="row">
                <div class="col s12 m6 l8">
                    <?= substr(nl2br($post->content),0,200) ?>...
                </div>
                <div class="col s12 m6 l4">
                    <a class="btn light-blue waves-effect waves-light" href="../index.php?page=post&id=<?= $post->id ?> " >Lire l'article complet</a>
                    <a class="btn light-blue waves-effect waves-light" href="../index.php?page=post&id=<?= $post->id ?> " >Modifier l'article </a>
                    <a class="btn light-blue waves-effect waves-light" href="../index.php?page=post&id=<?= $post->id ?> " >Supprimer l'article complet</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}