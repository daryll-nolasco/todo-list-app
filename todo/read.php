<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/todo.php';
 
// instantiate database and todo object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$todo = new Todo($db);
 
// query todo list
$stmt = $todo->read();
$num = $stmt->rowCount();
 
if ($num>0) {
 
    $list = array();
    $list["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $list_item = array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
            "status" => $status,
            "create_date" => $create_date,
            "task_date" => $task_date
        );
        array_push($list["records"], $list_item);
    }

    echo json_encode($list);
} else {
    echo json_encode(
        array("message" => "List is empty.")
    );
}
?>