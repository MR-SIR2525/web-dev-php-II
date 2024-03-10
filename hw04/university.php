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

        if ($courses = $db->query("select * from courses")) 
        {
          // Fetch associative array for each row
          while ($row = $courses->fetch_assoc()) 
          {
            print "
            <tr>
              <td>
                <input type=\"radio\" name=\"course\" value=\"".$row["course_id"]."\">
                " . $row["dept"] . " " . $row["code"] . "
                </input>
              </td>
            </tr>";            
          }
          // Free result set
          // $courses->free_result() or print "Error freeing result: " . $db->error;
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
        if (isset($_POST["course"]))
        {
          $course = $_POST["course"];
          $db = new mysqli("localhost", "student", "password", "university") or die("Error: Unable to connect to database... $db->connect_error");

          // print beginning of table
          print "
          <table id=\"results-table\" class=\"no-borders-table\">
            <thead>
              <tr>
                <th>Name</th>
                <th>Grade</th>
              </tr>
            </thead>
            <tbody>";
          
          if ($students = $db->query("select * from student where student_id in (select student_id from courses_taken where course_id = $course)"))
          {
            // Fetch associative array for each row
            while ($row = $students->fetch_assoc())
            {
              print "<tr>
                <td>" . $row["name"] . "</td>
                <td>" . $row["grade"] . "</td>
              </tr>";
            }
          }

          //print the end of table
          print "
            </tbody>
          </table>";
        }
      ?>
      </section>

    </SECTION>
  </div>

</body>

</html>