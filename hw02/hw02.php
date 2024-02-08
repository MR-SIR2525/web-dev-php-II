<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="a-style.css">
  <link rel="stylesheet" href="bootstrap-m-p.css">

  <title>Homework 2 | Andrew Blythe</title>
  <!---------------------------------
    Name: Andrew Blythe
    Netid: cab1361
    Date: 2/9/2024

    Hw02
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
        <h2 class="w3-large mt-0 mb-1">Homework 2</h2>
        <!-- <h1 class="w3-xxlarge mt-0" style="margin-bottom: 1rem">title</h1> -->
      </section>

      <!-- left -->
      <section class="left a-center">      
        <span>&nbsp;</span>
      </section>

      <!-- right -->
      <section id="results" class="right">
      <?php
        $xmlFilename = "purchasing.xml";

        $xml=simplexml_load_file($xmlFilename) or die("Error: Cannot create xml object using $xmlFilename");

        // print beginning of table
        print "
        <table id=\"results-table\" class=\"bold-borders-table v-center-children\">
          <thead>
            <tr>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Line Total</th>
            </tr>
          </thead>

          <tbody>";
        
        $totalQuantity = 0; // initialize total quantity
        $totalSpent = 0.00; // initialize total spent

        // print each purchase record
        foreach($xml->children() as $record) 
        {
          if ($record->quantity > 0) 
          {
            $totalQuantity += $record->quantity;
            $totalSpent += $record->price * $qty;

            print "
              <tr>
                <td>$record->name</td>
                <td>$record->price</td>
                <td>$record->$quantity</td>
                <td>$record->price * $qty</td>
              </tr>
            ";
          }
         
        }

        // print totals row
        print "
          <tr>
            <td colspan=\"2\" style=\"text-align: right\">Totals</td>
            <td>$totalQuantity</td>
            <td>$totalSpent</td>
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