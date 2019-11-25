<?php $title = 'Billet pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="jumbotron" id="accueil">
        <h1 class="chapitre">Billet pour l'Alaska</h1>
        <div class="row align-items-start">
            <img class="col-4" src="public/img/livre.jpg" alt="livre">
            <p class="col-8" id="bienvenue"><strong>Pour mon nouveau livre "Billet pour l'Alaska", je souhaiterai vous inviter à collaborer avec moi.
                    Laissez vos commentaires sur les chapitres que je mettrai en ligne.</strong> </p>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid">
        <h1 class="chapitre">Chapitres</h1>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require'template.php'; ?>
