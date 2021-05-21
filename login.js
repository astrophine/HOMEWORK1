function validazione(event)
{
    if(form.username.value.length==0 || form.password.value.length==0)
    {
        alert("Compila tutti i campi");
        event.preventDefault();
    }

}

const form=document.querySelector("form");
form.addEventListener("submit",validazione);