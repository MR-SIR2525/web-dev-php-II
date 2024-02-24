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
        // successful query...
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
      
        //actual column names in db:  title, image

        if ($result->num_rows > 0) 
        {
          while ($row = $result->fetch_assoc()) 
          {
            print "
              <tr>
                <td>$row[title]</td>
                <td><img src=\"$row[image]\" height=\"100\"></td>
              </tr>
            ";
          }
        } else {
          print "<tr><td colspan=\"2\">No records found in the database.</td></tr>";
        }

        $result->free_result(); // release memory after printing table
      }
      else
        print "Error: $db_novels->error";


      $db_novels -> close();
    ?>
    </section>
  </SECTION>
</body>

</html>