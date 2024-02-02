<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css"> <!-- derived from hw01 -->
  <link rel="stylesheet" href="bootstrap-m-p.css"> <!-- derived from hw01 -->

  <title>LAB 1 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 1/25/2024

    LAB01
   --------------------------------->
  <style>
    #main-form table tr td:first-child {
      text-align: left;
    }

    #results-table tbody tr td:nth-child(2) {
      /* target specifically the grades column data */
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="a-container">
    <!-- col-container = grid -->
    <SECTION class="header-left-right-container w3-card">

      <!-- header -->
      <section class="header a-center">
        <h2 class="w3-large mt-0 mb-1">Lab 1</h2>
        <!-- <h1 class="w3-xxlarge mt-0" style="margin-bottom: 1rem">title</h1> -->
      </section>

      <!-- left -->
      <section class="left a-center">
        <form action="lab01.php" method="post">
          Enter in a range of populations to search for:
          <?
          print "
            <p> Minimum Population: <input type=\"text\" name=\"min\" size=\"10\" value=\"$_POST[min]\" /> </p>
            <p> Maximum Population: <input type=\"text\" name=\"max\" size=\"10\" value=\"$_POST[max]\" /> </p>
            ";
          ?>
          <input type="submit" value="Submit" />
        </form>
      </section>

      <!-- right -->
      <section id="results" class="right">
      <?php
        $min = $_POST["min"];
        $max = $_POST["max"];
        
        // if no min or max
        if (!$min and !$max) {
          print "<span class=''>Please enter in min and max.</span>";
        }

        else if (!is_numeric($min) and !is_numeric($max)) {
          print "<span class='warning-text'>Invalid input for min or max.</span>";
        }
        else 
        {
          //filename variables
          $fileCountries = "names.txt";
          $filePopulations = "pops.txt";

          // check if they exist
          if (!file_exists($fileCountries)) {
            print "<span class='warning-text'>Unable to open $fileCountries file.</span>";
            exit;
          }

          if (!file_exists($filePopulations)) {
            print "<span class='warning-text'>Unable to open $filePopulations file.</span>";
            exit;
          }

          // read files into arrays
          $countries = file($fileCountries, FILE_IGNORE_NEW_LINES);
          $populations = file($filePopulations, FILE_IGNORE_NEW_LINES);

          // parallel sort the arrays by population, descending
          array_multisort($populations, SORT_NUMERIC, SORT_DESC, $countries);
            // over-engineered? Maybe? Cool? yes.

          //begin print table
          print "
            <table id=\"results-table\" class=\"simpletable \">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Population</th>
                </tr>
              </thead>
              <tbody>";

          foreach ($populations as $i => $pop) {
            //user entered min, but not max
            if (is_numeric($min) and !is_numeric($max) and $pop > $min) 
            {
              print " 
                <tr>
                  <td>$countries[$i]</td>
                  <td>$pop</td>
                </tr>";
            }
            // user entered max, but not min
            else if (is_numeric($max) and !is_numeric($min) and $pop < $max)
            {
              print " 
                <tr>
                  <td>$countries[$i]</td>
                  <td>$pop</td>
                </tr>";
            }
            // user entered both min and max
            else if (is_numeric($max) and is_numeric($min) and $pop > $min and $pop < $max)
            {
              print " 
                <tr>
                  <td>$countries[$i]</td>
                  <td>$pop</td>
                </tr>";
            }
            
          }


          //print the end of table
          print "
              </tbody>
            </table>";
        } // end else way up above, at the not min and max 
      ?>
      </section>
    </SECTION>
  </div>
</body>

</html>