window.addEventListener("load", linkEvents);

"use strict";

function linkEvents() {
    document.forms.form1.submit.onclick = drawTable; 
}

function drawTable() 
{
    let rows = document.forms.form1.rows.value;
    let out_string = "<table class='simpletable a-right'>" 
    +   "<tr>"
    +       "<th>Sequence</th>"
    +       "<th>S-1</th>"
    +       "<th>S-2</th>"
    +   "</tr>";

    let fib = 0;
    let s1 = 1;
    let s2 = 0;

    for (let i = 0; i < rows; i++) 
    {
        fib = s1 + s2;
        out_string +=
            "<tr>"
         +      "<td>" + fib + "</td>"
         +      "<td>" + s1 + "</td>"
         +      "<td>" + s2 + "</td>"
         +  "</tr>";

        //update values
        s2 = s1;
        s1 = fib;
    }
    out_string += "</table>";   //close table

    document.getElementById("results").innerHTML = out_string;

}