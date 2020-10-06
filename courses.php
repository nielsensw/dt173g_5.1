<?php
include("config/config.php");

header("Content-Type: application/json; charset=UTF-8;");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

// För att kunna använda PUT, POST, GET, DELETE
$method = $_SERVER["REQUEST_METHOD"];
//Instans av klassen
$course = new Course();
// Datan som begärs eller skickas (arc)
$data = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case "GET":
       
        //kollar om resultatet (datan) är mer än 0/tom
        //hämtar data
        $response = $course->getCourses();
        if (sizeof($response) > 0) {
            http_response_code(200);
            $response = array("message" => "Kurs tillagd");
        } else {
            http_response_code(404);
            $response = array("message" => "Inga kurser hittas");
        }
        break;
    case "PUT":
        //Lägger in värdena som givits i tex arc, till variabler som används som argument i metoder skapad i klassen
        $code = $data['code'];
        $name = $data['name'];
        $prog = $data['progression'];
        $syllabus = $data['syllabus'];
        $index = $data['id'];
        if ($course->updateCourse($code, $name, $prog, $syllabus, $index)) {
            http_response_code(200);
            $response = array("message" => "Course Updated");
        } else {
            http_response_code(500);
            $response = array("message" => "nope");
        }
        break;
    case "POST":
         //Lägger in värdena som givits i tex arc, till variabler som används som argument i metoder skapad i klassen
        $code = $data['code'];
        $name = $data['name'];
        $prog = $data['progression'];
        $syllabus = $data['syllabus'];
        if ($course->addCourse($code, $name, $prog, $syllabus)) {
            http_response_code(201);
            $response = array("message" => "Course Created");
        } else {
            http_response_code(500);
            $response = array("message" => "nope");
        }
        break;
    case "DELETE":
        // Raderar kurs (rad) i db beroende av angivet id
        $index = $data['id'];
        if ($course->remove($index)) {
            http_response_code(200);
            $response = array("message" => "Course Deleted");
        } else {
            http_response_code(500);
            $response = array("message" => "Course was not deleted :/");
        }
        break;
}
// Skriver ut meddelande/felmeddelande
echo json_encode($response);


