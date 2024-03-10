<!-- script to figure out the columns in a table -->
<?php
    // figure out the columns
    if ($courses = $db->query("select * from courses")) 
    {
    // Fetch associative array for each row
    while ($row = $courses->fetch_assoc()) 
    {
        // Iterate through each column in the row
        foreach ($row as $column => $value) {
            echo $column . ": " . $value . " | ";
        }
        echo "<br>"; // New line for the next row
    }
    // Free result set
    $courses->free_result() or print "Error freeing result: " . $db->error;
    }
    else 
    {
    print "Error: " . $db->error;
    }


?>