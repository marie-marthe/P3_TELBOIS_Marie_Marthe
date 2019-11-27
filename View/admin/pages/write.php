<?php
if(admin()!=1){
    header("Location:index.php?page=dashboard");
}

?>

<h2>Poster un article</h2>

<?php

    if(isset($_POST['post'])){
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));

        $errors = [];

        if(empty($title) || empty($content)){
            $errors['empty'] = "Veuillez remplir tous les champs";
        }

        if(!empty($_FILES['image']['name'])){
            $file = $_FILES['image']['name'];
            $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
            $extension = strrchr($file,'.');

            if(!in_array($extension,$extensions)){
                $errors['image'] = "Cette image n'est pas valable";
            }
        }

        if(!empty($errors)){
            ?>
                <div class="card red">
                    <div class="card-content white-text">
                        <?php
                            foreach($errors as $error){
                                echo $error."<br/>";
                            }
                        ?>
                    </div>
                </div>
            <?php
        }else{
            post($title,$content,$creation_date);
            if(!empty($_FILES['image']['name'])){
                post_img($_FILES['image']['tmp_name'], $extension);
            }else{
                $id = $db->lastInsertId();
                header("Location:index.php?page=post&id=".$id);
            }
        }
    }


?>


<form method="post" enctype="multipart/form-data">
    <label for="title"><strong>Titre</strong></label> : <input type="text" name="title" id="title"><br><br>
    <label for="content"><strong>Nouveau chapitre :</strong></label>
    <textarea id="content" name="content" rows="25" cols="150"></textarea>
    <br><br>
        <div class="col s6 right-align">
            <br/><br/>
            <button style="margin-left:150px" class="btn" type="submit" name="post">Publier</button>
        </div>

</form>
    <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
        tinyMCE.init({
            mode : "textareas"
        });
    </script>


