<!DOCTYPE html>
<?php
$mang_so = array();
$mang_duy_nhat = array();
$so_lan = array();
$nhap_mang_value = "";

if (isset($_POST['nhap_mang'])) {
    $nhap_mang_value = $_POST['nhap_mang'];
    $mang_so = explode(",", $nhap_mang_value);
    $mang_duy_nhat = array_unique($mang_so);
    $so_lan = array_count_values($mang_so);
}

$chuoi = "";
foreach ($so_lan as $key => $value) {
    $chuoi = $chuoi . $key . ":" . $value . " ";
}

function mang_duy_nhat($mang_so) {
    if (!empty($mang_so)) {
        return implode(", ", $mang_so);
    }
    return "";
}
?>

<html>

<head>
    <title>ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</title>
    <meta charset="utf-8">
    <style>
        * {
            font-family: Tahoma;
        }

        table {
            width: 400px;
            margin: 100px auto;
        }

        table th {
            background: #66CCFF;
            padding: 10px;
            font-size: 18px;
        }

        input {
            width: 100%;
        }
    </style>
</head>

<body>
    <form action="mang-3.php" method="POST">
        <table border="0">
            <thead>
                <tr>
                    <th colspan="2">ĐẾM SỐ LẦN XUẤT HIỆN VÀ TẠO MẢNG DUY NHẤT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mảng:</td>
                    <td><input type="text" name="nhap_mang" value="<?php echo $nhap_mang_value; ?>"></td>
                </tr>
                <tr>
                    <td>Số lần xuất hiện:</td>
                    <td><input type="text" name="so_lan_xuat_hien" value="<?php echo $chuoi; ?>" disabled="disabled"></td>
                </tr>
                <tr>
                    <td>Mảng duy nhất:</td>
                    <td><input type="text" name="mang_duy_nhat" value="<?php echo mang_duy_nhat($mang_duy_nhat); ?>" disabled="disabled"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Thực hiện"></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>

</html>
