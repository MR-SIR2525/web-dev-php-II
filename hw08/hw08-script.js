"use strict";
// Event listener for the search button
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("submit-form1").addEventListener("click", clickHandler);
});

function clickHandler() {
    let results = document.getElementById("results");   //print to this element any errors

    // get the continent from form1
    let form1 = document.forms["form1"];
    var selectedContinent = form1["continent"].value;

    // try to filter input. If they send something dumb, it says "no results for..."
    if (!selectedContinent || selectedContinent == null || selectedContinent == "") 
    {
        let p = document.createElement("p");
        p.className = "warning-text w3-medium";
        p.innerHTML = "Please select a continent.";
        results.appendChild(p);
    }
    else
    {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) 
                {
                    let countries = JSON.parse(xhr.responseText).countries;
                    showCountries(countries, selectedContinent);
                } 
                else {
                    results.textContent = "Error: " + xhr.status;
                }
            }
        }, false);
        xhr.open("GET", "un.json");
        xhr.send();
    }
}

function showCountries(countries, selectedContinent) 
{
    let results = document.getElementById("results");   //print to this element

    try 
    {
        let table = document.createElement("table");
        table.className = "bold-borders-table black-thead table-padding-4px table-th-center table-td-right table-1st-td-left";
        table.innerHTML = "<tr><th>Country</th><th>Population</th><th>Area</th></tr>";

        let found_a_match = false;

        for (let country of countries)
        {
            if (country.continent === selectedContinent) 
            {
                found_a_match = true;
                let row = table.insertRow();
                row.innerHTML = "<td>" + country.name + "</td>" +
                    "<td>" + country.pop + "</td>" +
                    "<td>" + country.area + "</td>";
            }
        }
        if (!found_a_match) {
            let p = document.createElement("p");
            p.className = "warning-text w3-medium";
            p.innerHTML = "No matches found for continent of " + selectedContinent;
            results.innerHTML = p.outerHTML;
        }
        else {
            results.innerHTML = table.outerHTML;
        }

    } catch (error) {
        let p = document.createElement("p");
        p.className = "warning-text w3-medium";
        p.innerHTML = "Unable to retrieve data: " + error.message;
        results.innerHTML = "";
        results.appendChild(p);
    }
}