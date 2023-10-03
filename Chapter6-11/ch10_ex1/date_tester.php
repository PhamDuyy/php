<?php
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = 'start_app';
}

switch ($action) {
    case 'start_app':
        // set default invoice date 1 month prior to current date
        $interval = new DateInterval('P1M');
        $default_date = new DateTime();
        $default_date->sub($interval);
        $invoice_date_s = $default_date->format('n/j/Y');

        // set default due date 2 months after current date
        $interval = new DateInterval('P2M');
        $default_date = new DateTime();
        $default_date->add($interval);
        $due_date_s = $default_date->format('n/j/Y');

        $message = 'Enter two dates and click on the Submit button.';
        break;

    case 'process_data':
        $invoice_date_s = $_POST['invoice_date'];
        $due_date_s = $_POST['due_date'];

        try {
            $invoice_date_obj = new DateTime($invoice_date_s);
            $due_date_obj = new DateTime($due_date_s);

            // Check if due date is later than invoice date
            if ($due_date_obj < $invoice_date_obj) {
                throw new Exception("Due date must be later than invoice date.");
            }

            // Calculate date differences and format messages
            $interval = $invoice_date_obj->diff($due_date_obj);
            $current_date_obj = new DateTime();
            $current_time_obj = new DateTime();

            $invoice_date_f = $invoice_date_obj->format('F j, Y');
            $due_date_f = $due_date_obj->format('F j, Y');
            $current_date_f = $current_date_obj->format('F j, Y');
            $current_time_f = $current_time_obj->format('g:i:s A');

            // Calculate due date message
            $due_date_message = 'This invoice is ';
            if ($current_date_obj > $due_date_obj) {
                $due_date_message .= $interval->y . ' years, ' . $interval->m . ' months, and ' . $interval->d . ' days overdue.';
            } else {
                $due_date_message .= $interval->y . ' years, ' . $interval->m . ' months, and ' . $interval->d . ' days remaining.';
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        break;
}
include 'index.php';
?>
