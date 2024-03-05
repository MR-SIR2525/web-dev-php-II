<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css">
  <link rel="stylesheet" href="bootstrap-m-p.css">
  <link rel="stylesheet" href="university.css">

  <title>Homework 4 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 3/5/2024

    Hw04
   --------------------------------->
  <style>
    #main-form table tr td:first-child {
      text-align: left;
    }
    #results-table tbody tr td:nth-child(2),
    #results-table tbody tr td:nth-child(3),
    #results-table tbody tr td:nth-child(4) {
      /* 2nd, 3rd, 4th columns right aligned */
      text-align: right;
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

        // print beginning of table
        //********2nd, 3rd, 4th columns right aligned (see <style> inside of <head> above)********
        print "
        <table id=\"form-table\" class=\"no-borders-table\">

          <tbody>";

        // Query to get all tables in the database
        $sql = "SHOW TABLES";
        $tables = $db->query($sql);
        foreach ($tables as $table) 
        {
          foreach ($table as $key => $value)
          {
            print "$value<br>";
          }
        }


        // figure out the columns
        if ($result = $db->query($query)) 
        {
          print "got result";
          if ($result->num_rows > 0) {
              // Fetch associative array for each row
              while ($row = $result->fetch_assoc()) {
                  // Iterate through each column in the row
                  foreach ($row as $column => $value) {
                      echo $column . ": " . $value . " | ";
                  }
                  echo "<br>"; // New line for the next row
              }
          } else {
              print "No records found.";
          }
          // Free result set
          // $result->free_result() or print "Error freeing result: " . $db->error;
        }
        else 
        {
          print "Error: " . $db->error;
        }

        $db->close();
        
      ?>

      </section>

      <!-- right -->
      <section id="results" class="right">
      <?php
        // print beginning of table
        //********2nd, 3rd, 4th columns right aligned (see <style> inside of <head> above)********
        print "
        <table id=\"results-table\" class=\"no-borders-table\">
          <thead>
            <tr>
              <th>idk yet</th>
            </tr>
          </thead>

          <tbody>";
        
        $totalQuantity = 0; // initialize total quantity
        $totalSpent = 0.00; // initialize total spent

        // print 
         


        // print totals row
        print "
          <tr style=\"font-weight: bold\">
            <td colspan=\"2\" style=\"text-align: right\">Totals</td>
            
          </tr>
        ";

        //print the end of table
        print "
          </tbody>
        </table>";
      ?>
      </section>

    </SECTION>
  </div>

</body>

</html>