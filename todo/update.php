<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/todo.php';
 
$database = new Database();
$db = $database->getConnection();
 
$todo = new Todo($db);
 
// get id of task to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of task to be edited
$todo->id = $data->id;
 
// set todo property values
$todo->title = $data->title;
$todo->description = $data->description;
$todo->status = $data->status;
$todo->task_date = $data->task_date;
 
// update the task
if ($todo->update()) {
    echo '{';
        echo '"message": "Task was updated."';
    echo '}';
} else {
    echo '{';
        echo '"message": "Unable to update task."';
    echo '}';
}
?>