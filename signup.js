function validazione(event)
{
    if(form.nome.value.length ==0 || form.cognome.value.length ==0 || form.username.value.length ==0 ||
    form.password.value.length ==0 || form.conferma.value.length ==0 || form.email.value.length ==0 || 
    form.immagine.value.length ==0 || form.artista_visitatore.value.length==0)
    {
        alert("Compila tutti i campi!");
        event.preventDefault();
    }
    if(form.password.value!==form.conferma.value)
    {
        alert("La password non combacia!");
        event.preventDefault();
    }
    
}

function checkPassword()
{ //validazione al blur
    /*
    if(form.password.value.length >= 8)
    {
        let simbolo_presente = false;
        const simboli = ["*", "#", "!"];
        for(let i = 0; i < simboli.length; i++)
        {
            if (form.password.indexOf(simboli[i]) != -1) 
            {
                simbolo_presente = true;
                break;
            }
        }

        let lettera_presente = false;
        const lettera = ["A", "B", "C"];
        for(let i = 0; i < lettera.length; i++)
        {
            if (form.password.indexOf(simboli[i]) != -1) 
            {
                simbolo_presente = true;
                break;
            }
        }

        if (!simbolo_presente || !lettera_maiuscola)
            alert("La password deve contenere almeno un simbolo e una lettera maiuscola.");

            
    } else 
    {
        alert("La password troppo corta!");
    }
    */

    const regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    if (!regex.test(form.password.value))
        alert("La password deve essere almeno 8 caratteri. Devono esserci almeno una maiuscola, una minuscola, un numero e un simbolo (!@#$%^&*)");
}

function onJson(json)
{
    if(json===1)
    {
        alert("Username già esistente");
    }
}

function onResponse(response)
{
    return response.json();
}

function checkUsername()
{
    fetch("./checkusername.php?username=" + form.username.value).then(onResponse).then(onJson);
}
const form=document.querySelector("form");
form.addEventListener("submit",validazione);

form.username.addEventListener("blur", checkUsername);

form.password.addEventListener("blur", checkPassword);