<!DOCTYPE html>
<html>
<head>
    <title>String Tester</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>String Tester</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="process_data">

            <label>Name:</label>
            <input type="text" name="name" 
                   value="<?php echo htmlspecialchars($name); ?>">
            <br>

            <label>E-Mail:</label>
            <input type="text" name="email" 
                   value="<?php echo htmlspecialchars($email); ?>">
            <br>

            <label>Phone Number:</label>
            <input type="text" name="phone" 
                   value="<?php echo htmlspecialchars($phone); ?>">
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Submit">
            <br>

        </form>

        <h2>Message:</h2>
        <p><?php echo nl2br(htmlspecialchars($message)); ?></p>

        <?php
        $processedMessage = '';

        if ($action === 'process_data') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

        
            if (!empty($name)) {
                $nameParts = explode(' ', $name);
                foreach ($nameParts as &$part) {
                    $part = ucfirst(strtolower($part));
                }
                $processedMessage .= "Xin chào " . implode(' ', $nameParts) . ",<br>";
            } else {
                $processedMessage .= "Xin chào người dùng không rõ tên,<br>";
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $processedMessage .= "Email: " . htmlspecialchars($email) . "<br>";
            } else {
                $processedMessage .= "Email không hợp lệ,<br>";
            }
            if (strlen($phone) >= 7) {
                $processedMessage .= "Điện thoại: " . htmlspecialchars($phone) . "<br>";
            } else {
                $processedMessage .= "Số điện thoại không hợp lệ,<br>";
            }

            if (!empty($processedMessage)) {
                echo "<h2>Processed Data:</h2>";
                echo "<p>" . nl2br($processedMessage) . "</p>";
            } else {
                echo "<h2>Error:</h2>";
                echo "<p>Không có dữ liệu hợp lệ để hiển thị.</p>";
            }
        }
        ?>
    </main>
</body>
</html>
