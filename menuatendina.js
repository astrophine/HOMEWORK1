
function apriMenu(event)
{
    if(document.querySelector("#links").style.display == "none")
    {
           document.querySelector("#links").style.display = "block";
    }else
    {
        document.querySelector("#links").style.display = "none";
    }
 
} 
document.getElementById("menu_tendina").addEventListener("click", apriMenu);
