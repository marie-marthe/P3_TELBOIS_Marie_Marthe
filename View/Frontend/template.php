

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="public/img/fond.ico">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">

    <header>
       <!-- Navigation
      ================================================== -->
        <nav class="navbar navbar-expand-lg navbar fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Jean Forteroche</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="index.php?action=listChapters" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chapitres</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php while($data = $chapters->fetch()): ?>
                                <a class="dropdown-item" href="index.php?action=chapter&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a>
                            <?php endwhile; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>



    <?= $content ?>    

    <footer class="text-center">

        <a class="btn btn-default" href="index.php?action=connexion"><i class="fa fa-user fa-2x"></i></a>
    </footer>

</body>

</html>
