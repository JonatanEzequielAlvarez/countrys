<?php
require('../conn.php');

$name = isset($_POST['name']) ? $_POST['name'] : '';
$active = isset($_POST['active']) ? intval($_POST['active']) : 0;
$flag = '';

if (!empty($name) && isset($_FILES['flag']) && $_FILES['flag']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = './uploads/';
    $uploadFile = $uploadDir . basename($_FILES['flag']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Validar si es una imagen
    $check = getimagesize($_FILES['flag']['tmp_name']);
    if ($check !== false) {
        // Validar el tipo de archivo (jpg, png, jpeg, gif)
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Mover el archivo subido al directorio de destino
            if (move_uploaded_file($_FILES['flag']['tmp_name'], $uploadFile)) {
                $flag = $uploadFile;

                // Insertar en la base de datos
                $query = "INSERT INTO country (name, active, flag) VALUES (:name, :active, :flag)";
                $statement = $connect->prepare($query);
                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                $statement->bindParam(':active', $active, PDO::PARAM_INT);
                $statement->bindParam(':flag', $flag, PDO::PARAM_STR);

                if ($statement->execute()) {
                    $response = array('status_code' => 200, 'message' => 'Country added successfully', 'id' => $connect->lastInsertId());
                } else {
                    $response = array('status_code' => 500, 'message' => 'Failed to add country');
                }
            } else {
                $response = array('status_code' => 500, 'message' => 'Failed to upload flag');
            }
        } else {
            $response = array('status_code' => 400, 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed');
        }
    } else {
        $response = array('status_code' => 400, 'message' => 'File is not an image');
    }
} else {
    $response = array('status_code' => 400, 'message' => 'Invalid input or file upload error');
}

echo json_encode($response);
?>
