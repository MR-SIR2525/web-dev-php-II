// run after the window loads
window.addEventListener("load", link_events);

"use strict";

function link_events() {
    //make button clickable to use forms object. <form> needs a name
    document.forms.form1.submit.onclick = calculate;

    //get element by id is also an option
}

// the bread and butter of the script
function calculate() 
{
    let temp = parseFloat(document.forms.form1.temp.value);    
    let convert_to = document.forms.form1.scale.value;


    data_is_okay = true;    //data validation flag
    alert_messages = [];    //array for alert messages

    if (isNaN(temp)) {
        data_is_okay = false;
        alert_messages.push("Please enter a temperature to convert (numeric value).");
    }
    if (!convert_to) {
        data_is_okay = false;
        alert_messages.push("Please select a temperature scale to convert to.");
    }
    else if (convert_to != "convert_to_celsius" && convert_to != "convert_to_fahrenheit") {
        data_is_okay = false;
        alert_messages.push("Please select a valid temperature scale to convert to.");
    }

    // gatekeeper
    if (!data_is_okay) 
    {
        display_errors(alert_messages);
    }
    else 
    {
        let originalScale = "unset";
        let resultTemp = 0.00;
        let resultScale = "unset";
        let resultsArea = document.getElementById("results");

        switch (convert_to)
        {
            case "convert_to_celsius":
                originalScale = "Fahrenheit";
                resultTemp = (temp - 32) * 5 / 9;
                resultScale = "C";
                break;

            case "convert_to_fahrenheit":
                originalScale = "Celsius";
                resultTemp = temp * 9 / 5 + 32;
                resultScale = "F";
                break;
            default:
                resultTemp = -273.15;
                resultScale = "error";
                alert_messages.push("Temp type must be Celsius or Fahrenheit.");
                break;
        }

        let p = document.createElement("p");
        p.className = "w3-large";
        p.innerHTML = "Temperature is " + resultTemp.toFixed(2) + " " + resultScale;
        
        resultsArea.appendChild(p);
    }

}

/* @param {string[]} alert_messages
 * @brief displays error messages in the 'results' element in a p tag    
*/
function display_errors(alert_messages) 
{
    let results = document.getElementById("results");
    let p = document.createElement("p");

    p.className = "warning-text w3-medium";
    p.innerHTML = alert_messages.join("<br />");
    
    results.appendChild(p);
}