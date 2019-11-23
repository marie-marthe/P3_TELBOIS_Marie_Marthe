<?php
$db = new PDO('mysql:host=localhost;dbname=P3_TELBOISMM;charset=utf8', 'root', 'root');


if(isset($_POST['confirm_register'])) {
    if(isset($_POST['login']) AND isset($_POST['password']) AND isset($_POST['password_confirm'])) {
       if(!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])){

           $login = trim(htmlspecialchars($_POST['login']));
           $password = trim(htmlspecialchars($_POST['password']));
           $password_confirm = trim(htmlspecialchars($_POST['password_confirm']));

           if(strlen($login) >= 3 AND strlen($login) <= 10) {
               if(strlen($password) >= 4 AND strlen($password) <= 100) {
                   if($password == $password_confirm){
                       $password_crypted = sha1($password);
                       $req = $db->prepare("INSERT INTO administrateur (login,password)VALUES (?,?)");
                       $req->execute(array($login, $password));

                       $error= " Votre à été crée avec succès";

                   } else {
                       $error = " Vos mots de passes ne correspondent pas";
                   }

               } else {
                   $error = " Votre mot de passe doit comprter entre 8 et 100 caractères ";
               }
           } else {
               $error = " Votre login doit comporter entre 3 et 10 caractères ";
           }
       } else {
           $error = " Veuillez remplir tous les champs ! ";
       }

    }
}

?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" >
        <title> S'incrire </title>
    </head>

<body>

<header>

</header>
<h1> S'incrire </h1>
<form method="POST" action="">
    <table>
        <tr>
            <td>
                <label> Votre Login : </label>
            </td>
            <td>
                <input type="text" name="login">
            </td>
        </tr>

        <tr>
            <td>
                <label> Choissez un mot de passe : </label>
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>

        <tr>
            <td>
                <label> Confirmez votre mot de passe : </label>
            </td>
            <td>
                <input type="password" name="password_confirm">
            </td>
        </tr>

        <tr><td></td></tr>

        <tr>
            <td> </td>
            <td>
                <button type="submit" name="confirm_register"> S'inscrire </button>
            </td>
        </tr>
    </table>
</form>

<?php if (isset($error)) {echo $error;} ?>

      <nav>
          <a href="login.php">Déja un compte ? Connectez-vous ! </a>
      </nav>
<footer> </footer>
</body>
</html>
