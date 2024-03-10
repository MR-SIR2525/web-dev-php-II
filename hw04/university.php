<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css">
  <link rel="stylesheet" href="bootstrap-m-p.css">

  <title>Homework 4 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 3/5/2024

    Hw04
   --------------------------------->
  <style>
    #results-table tbody tr td:nth-child(2) {
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="a-container">
    <SECTION class="header-left-right-container w3-card">

      <!-- header -->
      <section class="header a-center">
        <h2 class="w3-large mt-0 mb-1">Homework 4</h2>
        <!-- <h1 class="w3-xxlarge mt-0" style="margin-bottom: 1rem">title</h1> -->
      </section>

      <!-- left -->
      <section class="left a-center">      
      <?php
        $db = new mysqli("localhost", "student", "password", "university") or die("Error: Unable to connect to database... $db->connect_error");
        //Tables:
        // courses
        // courses_taken
        // department
        // student

        // print beginning of form and table
        print "
        <form action=\"university.php\" method=\"post\">
          <table id=\"form-table\" class=\"no-borders-table a-left\">
            <tbody>";

        if ($courses = $db->prepare("select * from courses")) 
        {
          //apparently prevents sql injection
          $courses->execute();
          $courses = $courses->get_result();

          // Fetch associative array for each row
          while ($row = $courses->fetch_assoc()) 
          {
            print "
            <tr>
              <td>
                <input type=\"radio\" name=\"course_id\" value=\"".$row["course_id"]."\" id=\"".$row["course_id"]."\" required />
                <label for=\"".$row["course_id"]."\"> ".$row["dept"]." ".$row["code"]."</label>
              </td>
            </tr>";            
          }
          // Free result set
          // $courses->free_result() or print "Error freeing result: " . $db->error;
          print "<tr>
            <td><input type=\"submit\" value=\"Submit\"></td>
          </tr>";
        }
        else 
          print "Error: " . $db->error;

        // print the end of table and form
        print "
            </tbody>
          </table>
        </form>";
        $db->close();
      ?>
      </section>


      <!-- right -->
      <section id="results" class="right">
      <?php
        if (isset($_POST["course_id"]))
        {
          $course_id = $_POST["course_id"];
          // print "Course id chosen: " . $course_id;
          $db = new mysqli("localhost", "student", "password", "university") or die("Error: Unable to connect to database... $db->connect_error");

          // print beginning of table
          print "
          <table id=\"results-table\" class=\"no-borders-table\">
            <thead>
              <tr>
                <th style='text-align: left'>Name</th>
                <th>Grade</th>
              </tr>
            </thead>
            <tbody>";
          
          $query = "
            SELECT s.fname, s.lname, ct.grade
            FROM student as s
            JOIN courses_taken as ct ON s.student_id = ct.taken_student
            WHERE ct.taken_course = ?
          ";

          if ($students = $db->prepare($query))
          {
            $students->bind_param("s", $course_id); //apparently these 3 prevent sql injection
            $students->execute();
            $students = $students->get_result();
          
            if ($students->num_rows > 0)
            {
              while ($row = $students->fetch_assoc())
              {
                print "<tr>
                  <td>" . $row["fname"] . " " . $row["lname"] . "</td>
                  <td>" . $row["grade"] . "</td>
                </tr>";
              }
            }
            $students->close();
          }
          //print the end of table
          print "
            </tbody>
          </table>";
        }
        else
          print "Select a course to see students in it.";
      ?>
      </section>

    </SECTION>
  </div>

</body>

</html>