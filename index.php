<?php
include("config/config.php")

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moment 5.1 - DT073G - Sally Nielsen</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
    </header>
    <main>

        <div id="kurser">
            <table>
                <thead>
                    <tr>
                        <th>Kurskod</th>
                        <th>Namn</th>
                        <th>Progression</th>
                        <th>Kursplan</th>
                    </tr>
                </thead>
                <?php
                $course = new Course();
                $index;
                foreach ($course->getCourses() as $val) {
                    echo "<tr><td>" . $val['code'] . "</td>";
                    echo "<td>" . $val['name'] . "</td>";
                    echo "<td>" . $val['progression'] . "</td>";
                    echo "<td><a href='" . $val['syllabus'] . "' target='_blank'>Se kurslista</a></td></tr>";
                }

                ?>


            </table>
        </div>

    </main>
    <footer> <p>Skapad av Sally Nielsen</p></footer>

</body>

</html>