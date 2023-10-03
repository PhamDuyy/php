<?php
//get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', 
        FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = array();
    
//    add some hard-coded starting values to make testing easier
//    $task_list[] = 'Write chapter';
//    $task_list[] = 'Edit chapter';
//    $task_list[] = 'Proofread chapter';
}

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');

//initialize error messages array
$errors = array();

//process
switch ($action) {
    case 'Add Task':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            $task_list[] = $new_task;
        }
        break;
     case 'Delete Task':
            $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
            if ($task_index === NULL || $task_index === FALSE) {
                $errors[] = 'The task cannot be deleted.';
            } else {
                unset($task_list[$task_index]);
                $task_list = array_values($task_list);
            }
            break;    
    case 'Modify Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be modified.';
        } else {
            $task_to_modify = $task_list[$task_index];
        }
        break;
    case 'Save Changes':
        $modified_task_index = filter_input(INPUT_POST, 'modifiedtaskid', FILTER_VALIDATE_INT);
        $modified_task = filter_input(INPUT_POST, 'modifiedtask');

        if ($modified_task_index === NULL || $modified_task_index === FALSE) {
            $errors[] = 'The task cannot be modified.';
        } elseif (empty($modified_task)) {
            $errors[] = 'The modified task cannot be empty.';
        } else {
            $task_list[$modified_task_index] = $modified_task;
            $task_to_modify = null;
        }
        break;
    case 'Cancel Changes':
        $task_to_modify = null;
        break;
    case 'Promote Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE || $task_index === 0) {
            $errors[] = 'The task cannot be promoted.';
        } else {
            $promoted_task = array_splice($task_list, $task_index, 1);
            array_splice($task_list, $task_index - 1, 0, $promoted_task);
        }
        break;
    case 'Sort Tasks':
        sort($task_list);
        break;
}

include('task_list.php');
?>