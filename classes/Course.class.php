<?php
// Kod skriver av Sally Nielsen | DT173G
class Course
{

  private $db;
 
    function __construct()
    {

        /** Koppling till db */
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Anslutning misslyckades: " . $this->db->connect_error);
        }
    }

    public function addCourse($code, $name, $progression, $syllabus)
    {
      
        /** Lägger in kurs */
        $sql = "INSERT INTO course(code, name, progression, syllabus)VALUES('$code', '$name', '$progression', '$syllabus')";
        $this->db->query($sql);
        return true;
      
    }
    public function getCourses()
    {
        /*** Hämtar kurser */
        $sql =  "SELECT * FROM course";
        $results = $this->db->query($sql);
        $courses =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $courses;
    }
    public function updateCourse($code, $name, $prog, $syllabus, $index)
    {

        /** Uppdaterar kurs */
        $sql = "UPDATE course SET code = '$code', name = '$name', progression = '$prog', syllabus = '$syllabus' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
    public function remove($index)
    {
        /** Raderar kurs */
        $sql = "DELETE FROM course WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
}
