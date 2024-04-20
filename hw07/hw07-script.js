"use strict";
// Event listener for the search button
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("submit-form1").addEventListener("click", clickHandler);
});

function clickHandler() {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", function() { showFile(xhr); }, false);
    xhr.open("GET", "un.xml");
    xhr.send();
}

function getContinent() {
    //get selected continent from form1 radio button choice
    let form1 = document.forms["form1"];
    let selectedContinent = form1["continent"].value;
    return selectedContinent;
}

function showFile(xhr) 
{
    let results = document.getElementById("results");   //print to this element

    try {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) 
        {
            let countries = xhr.responseXML.getElementsByTagName("country");
            let selectedContinent = getContinent();

            let table = document.createElement("table");
            table.className = "bold-borders-table black-thead table-padding-3px a-right";
            table.innerHTML = "<tr><th>Country</th><th>Population</th><th>Area</th></tr>";

            for (let i = 0; i < countries.length; i++) 
            {
                let countryElement = countries[i];
                let continent = countryElement.getElementsByTagName("continent")[0].textContent;
                if (continent === selectedContinent) 
                {
                    let row = table.insertRow();
                    row.innerHTML = "<td>" + countryElement.getElementsByTagName("name")[0].textContent + "</td>"
                     + "<td>" + countryElement.getElementsByTagName("pop")[0].textContent + "</td>"
                     + "<td>" + countryElement.getElementsByTagName("area")[0].textContent + "</td>";
                }
            }

            results.innerHTML = table.outerHTML;
        }
    } catch (error) {
        results.innerHTML = error.message;
    }
}