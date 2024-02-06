<?php
// تحميل البيانات من ملف data.json إذا كان موجودًا
$data = [];
$data_file = 'data.json';

if (file_exists($data_file)) {
    $data_json = file_get_contents($data_file);
    $data = json_decode($data_json, true);
}

// احصل على الاسم وعنوان IP من الطلب
$name = $_GET['name'];
$ipaddress = $_GET['ipaddress'];

// احصل على الوقت والتاريخ الحالي
$current_time = date("h:i A");
$current_date = date("d-m-Y");

// قم بتحديث أو إضافة البيانات
if (is_array($data) && array_key_exists($name, $data)) {
    $data[$name]['ip'] = $ipaddress;
    $data[$name]['last_updated'] = [
        'time' => $current_time,
        'date' => $current_date
    ];
} else {
    $data[$name] = [
        'name' => $name,
        'ip' => $ipaddress,
        'last_updated' => [
            'time' => $current_time,
            'date' => $current_date
        ]
    ];
}

// حفظ البيانات في ملف JSON
file_put_contents($data_file, json_encode($data, JSON_PRETTY_PRINT));

// إرسال رسالة JSON كإجابة
echo json_encode(['message' => 'Data saved']);
?>
