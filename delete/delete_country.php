<?php
require('../conn.php');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    $query = "DELETE FROM country WHERE id = :id";
    $statement = $connect->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    if ($statement->execute()) {
        $response = array('status_code' => 200, 'message' => 'Country deleted successfully');
    } else {
        $response = array('status_code' => 500, 'message' => 'Failed to delete country');
    }
} else {
    $response = array('status_code' => 400, 'message' => 'Invalid ID');
}

echo json_encode($response);
?>
