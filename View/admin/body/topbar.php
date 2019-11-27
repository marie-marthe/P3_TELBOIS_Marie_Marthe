
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    <link href="public/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="public/img/fond.ico">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
<header>
    <!-- Navigation
  ================================================== -->

    <nav class="light-green">
        <div class="container">
            <div class="nav-wrapper">
                <a href="index.php?page=home" >Administration</a>
                <?php
                if($page != 'login' && $page != 'new' && $page != 'password'){
                    ?>
                    <footer class="text-center">
                        <a class="<?php echo ($page=="dashboard")?"active" : ""; ?>"><a href="index.php?page=dashboard"><i class="material-icons">dashboard</i></a></a>
                        <a class="<?php echo ($page=="write")?"active" : ""; ?>"><a href="index.php?page=write"><i class="material-icons">edit</i></a></a>
                        <a class="<?php echo ($page=="list")?"active" : ""; ?>"><a href="index.php?page=list"><i class="material-icons">view_list</i></a></a>
                        <a class="<?php echo ($page=="settings")?"active" : ""; ?>"><a href="index.php?page=settings"><i class="material-icons">settings</i></a></a>
                        <a class="btn btn-default" href="index.php?page=logout"><i class="fa fa-user fa-2x"></i></a>


                    </footer>


                    <?php
                }
                ?>

        </div>
    </nav>

</header>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>



</html>

