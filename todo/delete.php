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
 
// get task id
$data = json_decode(file_get_contents("php://input"));
 
// set task id to be deleted
$todo->id = $data->id;
 
// delete the task
if ($todo->delete()) {
    echo '{';
        echo '"message": "Task was deleted."';
    echo '}';
} else {
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>