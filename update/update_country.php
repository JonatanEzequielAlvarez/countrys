<?php
require('../conn.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$active = isset($_POST['active']) ? intval($_POST['active']) : 0;

if ($id > 0 && !empty($name)) {
    $query = "UPDATE country SET name = :name, active = :active WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':active', $active, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    if ($statement->execute()) {
        $response = array('status_code' => 200, 'message' => 'Country updated successfully');
    } else {
        $response = array('status_code' => 500, 'message' => 'Failed to update country');
    }
} else {
    $response = array('status_code' => 400, 'message' => 'Invalid input');
}

echo json_encode($response);
?>
