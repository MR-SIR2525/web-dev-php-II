window.addEventListener("load", link_events);

function link_events() {
    document.forms["form1"]["submit"].onclick = calculate;
}

function calculate() 
{
    var temp_in = parseFloat(document.forms["form1"]["temp_in"].value);
    var scale = document.forms["form1"]["scale"].value;
    var result = 0;

    if (!isNaN(temp_in)) {
        if (scale == "F") {
            result = temp_in * 9 / 5 + 32;
        } 
        else if (scale == "C") 
        {
            result = (temp_in - 32) * 5 / 9;
        } 
        else 
        {
            alert("Please select a scale.");
        }

        document.getElementById("outarea").innerHTML =
            "<h2>Temperature is: " + result.toFixed(1) + "</h2>";
    } else {
        alert("Please enter a numeric value for temperature");
    }
    return false;
}
