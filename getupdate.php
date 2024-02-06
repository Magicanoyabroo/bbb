<?php
// تحميل البيانات من ملف data.json إذا كان موجودًا
$data_file = 'data.json';

$password = isset($_GET['password']) ? $_GET['password'] : null;

if ($password !== null && $password == '1598') {
    try {
        if (file_exists($data_file)) {
            $data_json = file_get_contents($data_file);
            $data = json_decode($data_json, true);
            echo json_encode($data);
        } else {
            echo json_encode(['message' => 'NO Data']);
        }
    } catch (Exception $e) {
        echo json_encode(['message' => 'Error fetching data']);
    }
} else {
    echo json_encode(['message' => 'Password is not correct']);
}
?>
