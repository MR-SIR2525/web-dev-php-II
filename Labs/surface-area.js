// run when the window loads
window.addEventListener("load", link_events());

"use strict";

function link_events() {
    //make button clickable to use forms object. <form> needs a name
    document.forms.form1.submit.onclick = calculate;

    //get element by id is also an option
}

function calculate() 
{
    
    let shape = document.forms.form1.shape.value;
    let radius = parseFloat(document.forms.form1.radius.value);
    let height = parseFloat(document.forms.form1.height.value);
    

    //data validation
    data_is_okay = true;
    //array for alert messages
    alert_messages = [];

    if (isNaN(radius) || radius < 0 || !radius) {
        data_is_okay = false;
        alert_messages.push("Radius must be a positive number.");
    }

    if (isNaN(height) || height < 0 || !height) {
        data_is_okay = false;
        alert_messages.push("Height must be a positive number.");
    }

    if (!shape) {
        data_is_okay = false;
        alert_messages.push("Please select a shape.");
    }

    //add a child to id="results" to hold the alert messages
    if (!data_is_okay) {
        display_errors(alert_messages);
    }
    else 
    {
        switch (shape) {
            case "cylinder":
                area = 2 * Math.PI * radius * (radius + height);
                break;
            case "cone":
                area = Math.PI * radius * (radius + Math.sqrt(Math.pow(radius, 2) + Math.pow(height, 2)));
                break;
            case "capsule":
                area = Math.PI * radius * (radius + height);
                break;
        
            default:
                area = 0;
                display_errors("Unknown shape: " + shape);
                break;
        }

        document.getElementById("results").appendChild(document.createElement("p")).innerHTML = 
            "The surface area of the shape is " + area.toFixed(2);
    }

}

//pass the messages in an array
function display_errors(messages) {
    //display the error messages
    let results = document.getElementById("results");
    results.appendChild(document.createElement("p"));
    results.childNodes[0].innerHTML = alert_messages.join("<br />");
}