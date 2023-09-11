<!DOCTYPE html>
<html>

<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <?php
        // Use the filter_input function
        $product_description = filter_input(INPUT_POST, 'product_description');
        $list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent');
        $discount_percent_formatted = $discount_percent . "%";
        $discount_percent = strip_tags($discount_percent);
        $discount_percent = (float)$discount_percent;

        // Calculate the discount amount and discount price
        $discount = $list_price * $discount_percent * .01;
        $discount_price = $list_price - $discount;

        // Format the numeric variables with the currency and percentage formats
        $list_price_formatted = "$" . number_format($list_price, 2);
        $discount_formatted = "$" . number_format($discount, 2);
        $discount_price_formatted = "$" . number_format($discount_price, 2);

        $product_description = strip_tags($product_description, '<b>');
        $discount_percent_formatted = strip_tags($discount_percent_formatted, '<i>');
        ?>

        <label>Product Description:</label>
        <span><?php echo $product_description; ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_formatted; ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo $discount_percent_formatted; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_formatted; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_formatted; ?></span><br>
    </main>
</body>

</html>
