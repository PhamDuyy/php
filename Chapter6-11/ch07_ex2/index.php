<?php
//set default value of variables for initial page load
if (!isset($investment)) {
    $investment = '10000';
}
if (!isset($interest_rate)) {
    $interest_rate = '5';
}
if (!isset($years)) {
    $years = '5';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
    <main>
        <h1>Future Value Calculator</h1>
        <?php if (!empty($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } // end if 
        ?>
        <form action="display_results.php" method="post">
            <div id="data">
                <label>Investment Amount:</label>
                <select name="investment">
                    <?php for ($value = 10000; $value <= 50000; $value += 5000) : ?>
                        <option value="<?php echo $value; ?>" <?php if ($investment == $value) echo 'selected'; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <br>

                <label>Yearly Interest Rate:</label>
                <select name="interest_rate">
                    <?php for ($rate = 4; $rate <= 12; $rate += 0.5) : ?>
                        <option value="<?php echo $rate; ?>" <?php if ($interest_rate == $rate) echo 'selected'; ?>>
                            <?php echo $rate; ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <br>

                <label>Number of Years:</label>
                <input type="text" name="years" value="<?php echo $years; ?>" /><br>
            </div>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Calculate" /><br>
            </div>

        </form>
    </main>
</body>

</html>