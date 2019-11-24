<?php $title = 'Administration'; ?>

<?php  ob_start(); ?>


<div class="container">
    <div class="jumbotron jumbotron-fluid mot_de_passe">
        <h1 class="pass"><strong>Espace Administration</strong></h1>
        <form name="password" id="password" action="index.php?action=connexion" method="post">
            <label for="login">Login : </label>
            <input type="text" name="login" required><br><br>
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" required /><br><br>
            <input type="submit" name="connexion" value="Connexion">
        </form>
    </div>
</div>

<?php  $content = ob_get_clean(); ?>
<?php require 'template.php'; ?>


