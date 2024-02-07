<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab 2 (2/6/2024) | Andrew</title>
</head>

<body>
<?php
  class GradeBook 
  {
    public $students; // array of names
    public $grades; // array of grades
    public $count; // number of students
    public $average; // average grade

    function load($section)
    {
      // read files and put data into variables
      // section tells me which file to read into the arrays
      $this->students = file('$section.names.txt', FILE_IGNORE_NEW_LINES);
      $this->grades = file('$section.grades.txt', FILE_IGNORE_NEW_LINES);

      $sum = 0;
      foreach($this->grades as $grade)
      {
        $this->count++;
        $sum += $grade;
      }
      $this->average = $sum / $this->count;
    } 

    function display_grades() 
    {
      $num_a = 0;
      $num_b = 0;
      $num_c = 0;
      $num_d = 0;
      $num_f = 0;

      foreach($this->grades as $grade)
      {
        if ($grade >= 90)
          $num_a++;
        elseif ($grade >= 80 and $grade < 90)
          $num_b++;
        elseif ($grade >= 70 and $grade < 80)
          $num_c++;
        elseif ($grade >= 60 and $grade < 70)
          $num_d++;
        else
          $num_f++;
      }
      print "
        Number of A's: $num_a <br>
        Number of B's: $num_b <br>
        Number of C's: $num_c <br>
        Number of D's: $num_d <br>
        Number of F's: $num_f <br>
      ";
    }
  }

  $bis1523 = new GradeBook();

  $bis1523->load('bis1523');
  print "Loaded bis1523 data with $bis1523->count students and an average of $bis1523->average.";
  $bis1523->display_grades();

  $bis2523 = new GradeBook();
  $bis2523->load('bis2523');
  print "Loaded bis2523 data with $bis2523->count students and an average of $bis2523->average.";






?>
</body>

</html>