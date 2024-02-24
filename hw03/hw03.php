<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css">
  <link rel="stylesheet" href="bootstrap-m-p.css">

  <title>Homework 3 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 2/24/2024

    Hw03
   --------------------------------->
  <style>
    #main-form table tr td:first-child {
      text-align: left;
    }
    #results-table tbody tr td:nth-child(2) {
      /* target specifically the 2nd column */
      text-align: center;
      padding: 0 !important;
    }
  </style>
</head>

<body>
  <SECTION class="w3-card a-container">

    <!-- header -->
    <section class="header a-center">
      <h2 class="w3-large mt-0 mb-1">Homework 3</h2>
      <!-- <h1 class="w3-xxlarge mt-0" style="margin-bottom: 1rem">title</h1> -->
    </section>


    <section id="results">
    <?php

      $db_novels = new mysqli("localhost", "student", "password", "novels") or die("Error: Unable to connect to database.");
      $query = "SELECT * FROM novels";

      // Perform query
      if ($result = $db_novels->query($query)) 
      {
        if ($result->num_rows > 0) 
        {
          while ($row = $result->fetch_assoc()) 
          {
            // Iterate through each column in the row
            foreach ($row as $column => $value) 
            {
              print $column . ": " . $value . " | ";
            }
            print "<br>"; // New line for the next row
          }
        } 
        else 
        {
          print "No records found.";
        }

        $result->free_result(); // release memory
      }

      $db_novels -> close();
      
      exit();

      // print beginning of table
      print "
      <table id=\"results-table\" class=\"bold-borders-table v-center-children\">
        <thead>
          <tr>
            <th>Book</th>
            <th>Cover</th>
          </tr>
        </thead>
        <tbody>";
      
      foreach ($novels as $i=> $novel)
      {
        print "
          <tr>
            <td>$novel</td>
            <td><img src=\"$covers[$i]\" height=\"100\"></td>
          </tr>";
      }
      

      //print the end of table
      print "
        </tbody>
      </table>";
    ?>
    </section>
  </SECTION>
</body>

</html>