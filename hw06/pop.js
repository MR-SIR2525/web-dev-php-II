// run after the window loads
window.addEventListener("load", link_events);

"use strict";

function link_events() {
    //make button clickable to use forms object. <form> needs a name
    document.querySelector("#form1 > table > tbody > tr:nth-child(4) > td:nth-child(2) > input").onclick = calculate;
}

function calculate() 
{
    form1 = document.forms.form1;
    
    population = parseInt(form1.population.value) || "";
    years = parseInt(form1.years.value) || "";
    currentYear = new Date().getFullYear();
    rate = parseFloat(form1.rate.value) || "";


    //data validation
    error_messages = [];
    data_okay = true;

    if (isNaN(years) || years < 0 || years == "") {
        data_okay = false;
        error_messages.push("- Years to forecast must be a positive number.");
    }
    if (isNaN(population) || population < 0 || population == "") {
        data_okay = false;
        error_messages.push("- Starting population must 0 or greater.");
    }
    if (isNaN(rate) || rate == "") {
        data_okay = false;
        error_messages.push("- Growth rate must be a number.");
    }


    //output results or error messages
    results = document.getElementById("results");

    if (data_okay)
    {
        //table components
        tableHeader = "<tr class='bold'><th>Year</th><th>Population</th><th>Change</th></tr>";
        tableContents = [];

        for (i = 0; i < years; i++)
        {
            growth = population * rate / 100;
            population += growth;

            tableContents.push(
                "<tr><td>" + (currentYear + i) + "</td><td>" + population.toFixed(0) + "</td><td>" + growth.toFixed(0) + "</td></tr>\n"
            );
        }

        results.innerHTML = 
            "<table id=\"results-table\" class=\"bold-borders-table table-padding-025 table-striped-green w3-medium width-100 a-center\">" +
            tableHeader +
            tableContents.join("") +
            "</table>";

    }
    else
    {
        feedback = document.createElement("p")
        feedback.className = "warning-text";
        feedback.innerHTML = error_messages.join("<br />");
        
        results.innerHTML = feedback.outerHTML;
    }
}