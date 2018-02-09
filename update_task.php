<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script
if(isset($_POST['Id']) && ($_POST['Id'] === "-1")) {
    $task = new Task();
    $task->TaskName = $_POST['InputTaskName'];
    $task->TaskDescription = $_POST['InputTaskDescription'];
    $task->save();
}
if(isset($_POST['Id']) && !(isset($_POST['InputTaskName']) || isset($_POST['InputTaskDescription']))) {
    $task = new Task($_POST['Id']);
    $task->TaskId = $_POST['Id'];
    $task->Delete();
}
if((isset($_POST['InputTaskName']) || isset($_POST['InputTaskDescription'])) && (isset($_POST['Id']) && ($_POST['Id'] != "-1"))) {
    $task = new Task($_POST['Id']);
    $task->TaskId = $_POST['Id'];
    $task->TaskName = $_POST['InputTaskName'];
    $task->TaskDescription = $_POST['InputTaskDescription'];
    $task->save();
}
?>