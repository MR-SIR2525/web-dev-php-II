"use strict";
// Event listener for the search button
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("submit-form1").addEventListener("click", handleInput);
});

function handleInput() {
    
    let continents = document.getElementsByName("continent");
    let foundChecked = false;
    let results = document.getElementById("results");
    let output = [];
    let i = 0;

    // Determine which radio button is selected
    for (; i < continents.length; i++) 
    {
        if (continents[i].checked) 
        {
            foundChecked = true;
            output += loadAndFilterXML(continents[i].value); //get the data from XML file
            break;
        }
    }

    if (!foundChecked)  //didn't find any matches the file
    {
        let feedback = document.createElement("p");
        feedback.className = "warning-text w3-medium";
        feedback.innerHTML = "No results found for " + continents[i].value + ".";

        results.innerHTML = feedback.outerHTML;
    }
    else if (output === false)  //there was an error
    {
        let feedback = document.createElement("p");
        feedback.className = "warning-text w3-medium";
        feedback.innerHTML = "Error getting results from the file.";

        results.innerHTML = feedback.outerHTML;
    }
    else if (foundChecked) //there was a match
    {
        //print the results to a table
        let table = document.createElement("table");
        table.className = "bold-borders-table";
        table.innerHTML =   //begin table + header row
            "<thead><tr><th>Name</th><th>Population</th><th>Area</th></tr></thead><tbody>";
        
        for (let i = 0; i < output.length; i++) 
        {
            table.innerHTML += 
                "<tr><td>" + output[i].name + "</td><td>" + output[i].population + "</td><td>" + output[i].area + "</td></tr>";
        }

        table.innerHTML += "</tbody>";  //end table
        results.innerHTML = table.outerHTML;    //finally, print out to results section
    }

}


// Load and filter the XML content. Returns array of matching countries or false if error
function loadAndFilterXML(selectedContinent) {
    // Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open("GET", "un.xml", true);

    xhr.onload = function () {
        if (xhr.status === 200) 
        {
            let responseXML = xhr.responseXML;                            // Parse XML response
            let countries = responseXML.getElementsByTagName("country");  // Get all countries
            let output = [];                                              // To hold output

            for (let i = 0; i < countries.length; i++) 
            {
                // countries[i]'s continent
                let continent = countries[i].getElementsByTagName("continent")[0].textContent;

                if (continent === selectedContinent) 
                {
                    // Get the country name, population, and area
                    let name = countries[i].getElementsByTagName("name")[0].textContent;
                    let population = countries[i].getElementsByTagName("pop")[0].textContent;
                    let area = countries[i].getElementsByTagName("area")[0].textContent;

                    output.push({ name: name, population: population, area: area });
                }
            }
            // Invoke the callback function with the output array
            callback(output);

        }
        else {
            // If an error occurred, invoke the callback with false
            callback(false);
        }
    };

    // Send the request, onload above will catch the response
    xhr.send();
}

