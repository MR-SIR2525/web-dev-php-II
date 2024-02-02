<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css">
  <link rel="stylesheet" href="bootstrap-m-p.css">

  <title>Homework 1 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 1/31/2024

    Hw01
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
  <div class="a-container">
    <!-- col-container = grid -->
    <SECTION class="header-left-right-container w3-card">

      <!-- header -->
      <section class="header a-center">
        <h2 class="w3-large mt-0 mb-1">Homework 1</h2>
        <!-- <h1 class="w3-xxlarge mt-0" style="margin-bottom: 1rem">title</h1> -->
      </section>

      <!-- left -->
      <section class="left a-center">      
        <span>&nbsp;</span>
      </section>

      <!-- right -->
      <section id="results" class="right">
      <?php
        //filename variables
        $novelsFile = "novels.txt";
        $coversFile = "covers.txt";

        // check if they exist
        if (!file_exists($novelsFile)) {
          print "<span class='warning-text'>Unable to open $novelsFile file.</span>";
          exit;
        }
        if (!file_exists($coversFile)) {
          print "<span class='warning-text'>Unable to open $coversFile file.</span>";
          exit;
        }

        // read files into arrays
        $novels = file($novelsFile, FILE_IGNORE_NEW_LINES);
        $covers = file($coversFile, FILE_IGNORE_NEW_LINES);

        // print beginning of table
        print "
        <table id=\"results-table\" class=\"bold-borders-table v-center-children\">
          <thead>
            <tr>
              <th>Novel</th>
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
  </div>
</body>

</html>