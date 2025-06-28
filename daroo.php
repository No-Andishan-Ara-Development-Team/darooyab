<?php
header("Content-Type: application/json; charset=UTF-8");

// بارگذاری اطلاعات داروها از فایل
$medicines = [];
$filePath = 'daroo.txt';

if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($name, $description) = explode('|', $line);
        $medicines[trim($name)] = trim($description);
    }
} else {
    echo json_encode(["error" => "فایل اطلاعات داروها وجود ندارد."]);
    exit();
}

// دریافت نام دارو از درخواست
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    if (array_key_exists($name, $medicines)) {
        echo json_encode([$name => $medicines[$name]]);
    } else {
        echo json_encode(["error" => "دارو یافت نشد."]);
    }
} else {
    echo json_encode(["error" => "لطفاً نام دارو را وارد کنید."]);
}
?>
