
<?php
  
    $uploadDirectory = "images/fotos/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['myFile']['name'];
    $fileSize = $_FILES['myFile']['size'];
    $fileTmpName  = $_FILES['myFile']['tmp_name'];
    $fileType = $_FILES['myFile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

  

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "Esta extensión de archivo no está permitida. Cargue un archivo JPEG o PNG";
        }

        if ($fileSize > 2000000) {
            $errors[] = "Este archivo es más de 2MB. Lo siento, tiene que ser menor o igual a 2 MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "La imagen " . basename($fileName) . " ha sido cargada correctamente";
            } else {
                echo "Un error ocurrió en alguna parte. Inténtalo de nuevo o contacta al administrador";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "Estos son los errores" . "\n";
            }
        }
   


?>