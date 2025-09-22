<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Add</title>
    <link rel="stylesheet" href="<?=$css?>stylee.css">
</head>
<body>
    <main class="add">
        <header>
            <h2>Adicionar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>
        <figure class="photo-preview">
            <img id="preview" src="<?=$images?>/photo-lg-0.svg" alt="">
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nombre" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name'])?>">
            
            <div class="select">
                <select name="specie_id">
                    <option value="">Seleccione Especie...</option>
                    <?php $species = listSpecies($conx) ?>
                    <?php foreach($species as $specie): ?>
                    <option value="<?=$specie['id']?>" <?php if(isset($_POST['specie_id']) && $_POST['specie_id'] == $specie['id']) echo 'selected'; ?>><?=$specie['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <div class="select">
                <select name="breed_id">
                    <option value="">Seleccione Raza...</option>
                    <?php $breeds = listBreeds($conx) ?>
                    <?php foreach($breeds as $breed): ?>
                    <option value="<?=$breed['id']?>" <?php if(isset($_POST['breed_id']) && $_POST['breed_id'] == $breed['id']) echo 'selected'; ?>><?=$breed['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <div class="select">
                <select name="sex_id">
                    <option value="">Seleccione Género...</option>
                    <?php $sexes = listSexes($conx) ?>
                    <?php foreach($sexes as $sex): ?>
                    <option value="<?=$sex['id']?>" <?php if(isset($_POST['sex_id']) && $_POST['sex_id'] == $sex['id']) echo "selected"?>><?=$sex['name']?></option>
                    <?php endforeach ?>
                </select>
            </div>            
            
            <button type="button" class="upload">Subir Foto</button>
            <input type="file" name="photo" id="photo" accept="image/*" style="display:none;">
            <button type="submit" class="save">Guardar</button>
        </form>
        
        <?php
            if($_POST) {
                $errors = 0;

                $required_fields = ['name', 'specie_id', 'breed_id', 'sex_id'];
                foreach ($required_fields as $field) {
                    if(empty($_POST[$field])) {
                        $errors++;
                    }
                }

                if(!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                    $errors++;
                }

                if($errors == 0) {
                    $name = $_POST['name'];
                    $specie_id = $_POST['specie_id'];
                    $breed_id = $_POST['breed_id'];
                    $sex_id = $_POST['sex_id'];
                    
                    $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    $photo = time() . '_' . uniqid() . '.' . $file_extension;
                    
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/'.$photo)) {
                        if(addPet($name, $specie_id, $breed_id, $sex_id, $photo, $conx)) {
                            $_SESSION['message'] = "La mascota: $name, fue adicionada correctamente!";
                            echo "<script> window.location.replace('dashboard.php') </script>";
                            exit();
                        } else {
                            $_SESSION['error'] = "Error al adicionar mascota en la base de datos!";
                        }
                    } else {
                        $_SESSION['error'] = "Error al subir la foto!";
                    }
                } else {
                    $_SESSION['error'] = "Por favor, complete todos los campos y suba una foto!";
                }
            }

            if(isset($_SESSION['error'])) {
                include 'errors.php';
                unset($_SESSION['error']);
            }
        ?>
    </main>
    
    <script>
        const preview = document.querySelector('#preview');
        const upload = document.querySelector('.upload');
        const photo = document.querySelector('#photo');

        upload.addEventListener('click', function(e) {
            photo.click();
        });

        photo.addEventListener('change', function(e){
            if (this.files && this.files[0]) {
                preview.src = URL.createObjectURL(this.files[0]);
            }
        });
    </script>
</body>
</html>