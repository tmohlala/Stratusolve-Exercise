<?php
/**
 * Created by PhpStorm.
 * User: johangriesel
 * Date: 15122016
 * Time: 15:14
 * @package    ${NAMESPACE}
 * @subpackage ${NAME}
 * @author     johangriesel <info@stratusolve.com>
 */
$taskData = file_get_contents('Task_Data.txt');
$html = '<a id="-1" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">No Tasks Available</h4>
                    <p class="list-group-item-text">Click here to create one</p>
                </a>';
if (strlen($taskData) < 1) {
    die($html);
}
$taskArray = json_decode($taskData);
if (sizeof($taskArray) > 0) {
    $html = '';
    foreach ($taskArray as $index=>$task) {
        $html .= '<a id="'.$task->TaskId.'" href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
                    <h4 class="list-group-item-heading">'.$task->TaskName.'</h4>
                    <p class="list-group-item-text">'.$task->TaskDescription.'</p>
                </a>';
    }
}
die($html);
?>