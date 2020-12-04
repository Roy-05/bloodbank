 
document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector( 
            "body").style.visibility = "hidden"; 
        document.querySelector( 
            "#loader").style.visibility = "visible"; 
    } else { 
        document.querySelector( 
            "#loader").style.display = "none"; 
        document.querySelector( 
            "body").style.visibility = "visible"; 
    } 
}; 

/**
 * A function to display a simple bootstrap alert on user interaction
 * @param {String} id The id of the element where the message will be inserted
 * @param {String} message The error message to be displayed
 * @param {String} alert_type The type of alert to show [success/ error]
 */
function display_alert(id, message, alert_type){
    let elem = document.getElementById(id);
    let alert = document.createElement('div');

    alert.classList.add("alert", `alert-${alert_type}`);

    let text = document.createTextNode(message);


    alert.appendChild(text);
    elem.appendChild(alert);
}