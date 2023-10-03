<!DOCTYPE html>
<html>
<head>
    <title>Number Tester</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Number Tester</h1>
        <form action="." method="post">
            <input type="hidden" name="action" value="process_data">

            <label>Number 1:</label>
            <input type="text" name="number1" value="<?php echo htmlspecialchars($number1); ?>">
            <br>

            <label>Number 2:</label>
            <input type="text" name="number2" value="<?php echo htmlspecialchars($number2); ?>">
            <br>

            <label>Number 3:</label>
            <input type="text" name="number3" value="<?php echo htmlspecialchars($number3); ?>">
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Submit">
            <br>
        </form>

        <h2>Message:</h2>
        <p><?php echo nl2br(htmlspecialchars($message), FALSE); ?></p>

        <?php
        if ($action === 'process_data') {
            if (is_numeric($number1) && is_numeric($number2) && is_numeric($number3)) {
                $number1_ceil = ceil($number1);
                $number2_floor = floor($number2);
                $number3_rounded = round($number3, 3);
                $min = min($number1, $number2, $number3);
                $max = max($number1, $number2, $number3);
                $random = rand(1, 100);

                // Generate the formatted message with line breaks
                $formattedMessage = "Số 1: $number1\n" .
                                    "Số 2: $number2\n" .
                                    "Số 3: $number3\n" .
                                    "\n" .
                                    "số 1 l2: $number1_ceil\n" .
                                    "số 2 l2: $number2_floor\n" .
                                    "số 3 l3: $number3_rounded\n" .
                                    "\n" .
                                    "Min: $min\n" .
                                    "Max: $max\n" .
                                    "\n" .
                                    "Randum: $random";

                echo "<h2>Formatted Message:</h2>";
                echo "<pre>" . nl2br(htmlspecialchars($formattedMessage), FALSE) . "</pre>";
            }
        }
        ?>
    </main>
</body>
</html>
