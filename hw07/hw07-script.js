"use strict";
// Event listener for the search button
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("submit-form1").addEventListener("click", clickHandler);
});

function clickHandler() {
    let results = document.getElementById("results");   //print to this element any errors

    // get the continent from form1
    let form1 = document.forms["form1"];
    let selectedContinent = form1["continent"].value;

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
        let xhr = new XMLHttpRequest();
        xhr.addEventListener("readystatechange", function() { showFile(xhr, selectedContinent); }, false);
        xhr.open("GET", "un.xml");
        xhr.send();
    }


}

function showFile(xhr, selectedContinent) 
{
    let results = document.getElementById("results");   //print to this element

    try {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) 
        {
            let countries = xhr.responseXML.getElementsByTagName("country");

            let table = document.createElement("table");
            table.className = "bold-borders-table black-thead table-padding-3px table-th-center table-td-right table-1st-td-left";
            table.innerHTML = "<tr><th>Country</th><th>Population</th><th>Area</th></tr>";

            let found_a_match = false;

            for (let i = 0; i < countries.length; i++) 
            {
                let countryElement = countries[i];
                let continent = countryElement.getElementsByTagName("continent")[0].textContent;
                if (continent === selectedContinent) 
                {
                    found_a_match = true;
                    let row = table.insertRow();
                    row.innerHTML = "<td>" + countryElement.getElementsByTagName("name")[0].textContent + "</td>"
                     + "<td>" + countryElement.getElementsByTagName("pop")[0].textContent + "</td>"
                     + "<td>" + countryElement.getElementsByTagName("area")[0].textContent + "</td>";
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
        }
    } catch (error) {
        results.innerHTML = error.message;
    }
}