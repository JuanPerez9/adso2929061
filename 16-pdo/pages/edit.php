<?php
    include '../config/app.php';
    include '../config/database.php';
    include '../config/security.php';

    // Obtener el ID de la mascota a editar
    $id = $_GET['id'] ?? null;
    
    // Cargar los datos actuales de la mascota
    $currentPet = null;
    $currentPhoto = '';
    if ($id) {
        $sql = "SELECT * FROM pets WHERE id = :id";
        $stmt = $conx->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $currentPet = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($currentPet) {
            $currentPhoto = $currentPet['photo'];
        }
    }

    // Procesar el formulario de actualización
    if($_POST) {
        $errors = 0;
        $name = $_POST['name'] ?? '';
        $specie_id = $_POST['specie_id'] ?? '';
        $breed_id = $_POST['breed_id'] ?? '';
        $sex_id = $_POST['sex_id'] ?? '';
        $newPhoto = $currentPhoto; // Por defecto mantener la foto actual

        // Validar campos obligatorios
        if(empty($name) || empty($specie_id) || empty($breed_id) || empty($sex_id)) {
            $errors++;
            $_SESSION['error'] = "Por favor, complete todos los campos obligatorios!";
        }

        if($errors == 0) {
            try {
                // Si se subió una nueva foto
                if(isset($_FILES['photo']['tmp_name']) && file_exists($_FILES['photo']['tmp_name'])) {
                    // Generar nuevo nombre para la foto
                    $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                    $newPhoto = time() . '_' . uniqid() . '.' . $file_extension;
                    
                    // Mover la nueva foto
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], '../uploads/'.$newPhoto)) {
                        // Eliminar la foto vieja si existe y es diferente a la nueva
                        if(!empty($currentPhoto) && $currentPhoto !== $newPhoto && file_exists('../uploads/'.$currentPhoto)) {
                            unlink('../uploads/'.$currentPhoto);
                        }
                    } else {
                        $_SESSION['error'] = "Error al subir la nueva foto!";
                        echo "<script> window.location.replace('edit.php?id=$id') </script>";
                        exit();
                    }
                }
                
                // Actualizar en la base de datos
                $sql = "UPDATE pets SET name = :name, specie_id = :specie_id, breed_id = :breed_id, 
                        sex_id = :sex_id, photo = :photo WHERE id = :id";
                $stmt = $conx->prepare($sql);
                
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':specie_id', $specie_id);
                $stmt->bindParam(':breed_id', $breed_id);
                $stmt->bindParam(':sex_id', $sex_id);
                $stmt->bindParam(':photo', $newPhoto);
                $stmt->bindParam(':id', $id);

                if($stmt->execute()) {
                    $_SESSION['message'] = "La mascota: $name, fue actualizada correctamente!";
                    echo "<script> window.location.replace('dashboard.php') </script>";
                    exit();
                } else {
                    $_SESSION['error'] = "Error al actualizar la mascota!";
                }

            } catch (PDOException $e) {
                $_SESSION['error'] = "Error: " . $e->getMessage();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu mejor amigo en casa - Edit</title>
    <link rel="stylesheet" href="<?=$css?>stylee.css">
</head>
<body>
    <main class="edit">
        <header>
            <h2>Modificar Mascota</h2>
            <a href="dashboard.php" class="back"></a>
            <a href="../close.php" class="close"></a>
        </header>
        <figure class="photo-preview">
            <img id="preview" src="../uploads/<?=$currentPhoto?>" alt="Preview de la mascota">
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$id?>">
            
            <input type="text" name="name" placeholder="Nombre" 
                   value="<?=htmlspecialchars($currentPet['name'] ?? '')?>">
            
            <div class="select">
                <select name="specie_id">
                    <option value="">Seleccione Especie</option>
                    <?php $species = listSpecies($conx) ?>
                    <?php foreach($species as $specie): ?>
                    <option value="<?=$specie['id']?>" 
                        <?=($currentPet['specie_id'] ?? '') == $specie['id'] ? 'selected' : ''?>>
                        <?=$specie['name']?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <div class="select">
                <select name="breed_id">
                    <option value="">Seleccione Raza...</option>
                    <?php $breeds = listBreeds($conx) ?>
                    <?php foreach($breeds as $breed): ?>
                    <option value="<?=$breed['id']?>" 
                        <?=($currentPet['breed_id'] ?? '') == $breed['id'] ? 'selected' : ''?>>
                        <?=$breed['name']?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <button type="button" class="upload">Subir Foto</button>
            <input type="file" name="photo" id="photo" accept="image/*" style="display:none;">
            
            <div class="select">
                <select name="sex_id">
                    <option value="">Seleccione Género...</option>
                    <?php $sexes = listSexes($conx) ?>
                    <?php foreach($sexes as $sex): ?>
                    <option value="<?=$sex['id']?>" 
                        <?=($currentPet['sex_id'] ?? '') == $sex['id'] ? 'selected' : ''?>>
                        <?=$sex['name']?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
            
            <button type="submit" class="update">Modificar</button>
        </form>

        <?php
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