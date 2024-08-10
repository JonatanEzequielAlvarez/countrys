<?php
require('conn.php');
$query = "SELECT * FROM country";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if ($result) {
    $data['data']['status_code'] = 200;
    
    foreach ($result as $row) {
        $data['data']['countries'][] = array(
            'id'   => $row["id"],
            'name'   => $row["name"],
            'flag'   => "./".$row["flag"],
            'active' => $row["active"]
        );
    }
    
    echo json_encode($data);
} else {
    $data = array(
        'status' => 401
    );
    echo json_encode($data);
}
?>
