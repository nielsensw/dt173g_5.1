<?php
include("config/config.php");

header("Content-Type: application/json;");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

// För att kunna använda PUT, POST, GET, DELETE
$method = $_SERVER["REQUEST_METHOD"];
//Instans av klassen
$course = new Course();
// Datan som begärs eller skickas (arc)
$data = json_decode(file_get_contents('php://input'), true);

// KOllar efter id i url
if(isset($_GET['id'])){
    $index = $_GET['id'];
}

switch ($method) {
    case "GET":
        $response = $course->getCourses();
        //kollar om resultatet (datan) är mer än 0/tom
        if (sizeof($response) > 0) {
            http_response_code(200);
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
    //    $code = $data['code'];
      //  $name = $data['name'];
    //    $prog = $data['progression'];
      //  $syllabus = $data['syllabus'];
      $code = $data['code'];
      $name = $data['name'];
      $progression = $data['progression'];
      $syllabus = $data['syllabus'];
        
        
        if ($course->addCourse($code, $name, $progression, $syllabus)) {
            http_response_code(201);
            $response = array("message" => "Course Created");
              
             
        } else {
            http_response_code(500);
            $response = array("message" => "nope");
        }
        break;
    case "DELETE":
   
        // Raderar kurs (rad) i db beroende av angivet id
        if(!isset($index)){
              http_response_code(501);
            $response = array("message" => "No id found :/");
        } else{
            
              if ($course->remove($index)) {
            http_response_code(200);
            $response = array("message" => "Course Deleted");
        } else {
            http_response_code(500);
            $response = array("message" => "Course was not deleted :/");
         }
        }
      
      
        break;
}
// Skriver ut meddelande/felmeddelande
echo json_encode($response);

