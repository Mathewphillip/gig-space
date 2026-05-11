<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('../config/db_config.php');


if (isset($_GET['q']) && strlen($_GET['q']) >= 2) {
    $query = mysqli_real_escape_string($conn, $_GET['q']);
    $sql = "SELECT id, name FROM skills WHERE name LIKE '%$query%' LIMIT 10";
    $result = mysqli_query($conn, $sql);
    
    $skills = [];
    while ($skill = mysqli_fetch_assoc($result)) {
        $skills[] = $skill;
    }
    
    echo json_encode($skills);
} else {
    echo json_encode([]);
}
?>
