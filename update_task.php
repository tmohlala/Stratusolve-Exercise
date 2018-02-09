<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script
if(!isset($_POST['Id'])) {
    $task = new Task();
    $task->TaskName = $_POST['InputTaskName'];
    $task->TaskDescription = $_POST['InputTaskDescription'];
    $task->save();
    echo $task->TaskName . " " . $task->TaskDescription;
}
else if(isset($_POST['Id']) && !(isset($_POST['InputTaskName']) || isset($_POST['InputTaskDescription']))) {
    $task = new Task($_POST['Id']);
    $task->TaskId = $_POST['Id'];
    $task->Delete();
}
?>