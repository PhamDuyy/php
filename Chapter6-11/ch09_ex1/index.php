<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        if (!empty($name) && !empty($email) && !empty($phone)) {
            $message = "Name: $name
            Email: $email
            Phone: $phone";
        } else {
            $message = 'Please fill in all fields.';
        }

        break;
}
include 'string_tester.php';
?>