<?php $title = 'Billet pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="jumbotron" id="accueil">
        <h1 class="chapitre">Billet pour l'Alaska</h1>
        <h2 class="bienvenue">Bienvenue sur mon blog</h2>
        <div class="row align-items-start">
            <img class="col-4" src="public/img/Alaska.jpg" alt="livre">
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid">
        <h1 class="chapitre">Chapitres</h1>
        <?php while ($data = $chapters->fetch()): ?>
        <h2 class="title"><strong><?= htmlspecialchars($data['title']) ?></strong></h2><p class="date"><em>le <?= $data['creation_date_fr'] ?></em></p>
        <p><?= mb_substr($data['content'], 0, 450, 'UTF-8') ?>....... <a href="index.php?action=chapter&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
        <?php endwhile; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require'template.php'; ?>
