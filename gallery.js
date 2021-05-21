let imgAbbonato;

function seeDescription(event) {
    const button = event.currentTarget;
    const description = event.currentTarget.parentNode.querySelector("p");

    if (button.textContent === "More Details") {
        button.textContent = "No Details";
        description.classList.remove("hidden");
    } else {
        button.textContent = "More Details"
        description.classList.add("hidden");
    }
}

function onJsonAbbonamentoEffettuato(json) {
    if (json == true) {
        alert("Abbonamento effettuato con successo!");
        //devo cambiare immagine ma non so come creare la variabile globale ora si
        imgAbbonato.src = "img/meno.png";
        imgAbbonato.dataset.isabbonato = 1;
    } else {
        alert("Errore: Abbonamento non effettuato :-( ");
    }
}

function onJsonAbbonamentoRimosso(json) {
    if (json == true) {
        alert("Abbonamento annullato con successo!");
        //idem con patate
        imgAbbonato.src = "img/plus.png";
        imgAbbonato.dataset.isabbonato = 0;

    } else {
        alert("Errore: Abbonamento non annullato :-( ");
    }
}

function addFav(event) {
    imgAbbonato = event.currentTarget;
    const formData = new FormData();
    // Prendo l'ID del post
    formData.append('postid', imgAbbonato.parentNode.dataset.sala);
    if (imgAbbonato.dataset.isabbonato == 1) {
        console.log("ciao");
        // Mando l'ID alla pagina PHP tramite fetch
        fetch("./fineabbonamento.php", { method: 'post', body: formData }).then(onResponse).then(onJsonAbbonamentoRimosso);
    } else {
        fetch("./inizioabbonamento.php", { method: 'post', body: formData }).then(onResponse).then(onJsonAbbonamentoEffettuato);
        // TODO: fare richiesta al database perabbonarsi ad una sala (cioé inserire riga in tabella abbonamento)
    }
}

function ricerca(event) {

    const input = document.querySelector("#search");

    rest_url = "./scaricasale.php?q="+input.value;
    fetch(rest_url).then(onResponse).then(onJson);
    event.preventDefault();
   
}


function onJson(json) {

    const viewer = document.querySelector('#sale');
    viewer.innerHTML = "";
    for (let i = 0; i < json.length; i++) {

        const singolo = document.createElement('div');
        singolo.dataset.sala = json[i].id;
        singolo.classList.add('singolo');

        const titolo = document.createElement('a'); //voglio fare in modo che cliccando questo si vedano tutte le opere all'interno e dare la possibilità anche di valutarle
        titolo.textContent = json[i].nome;
        titolo.href = "./home.php?sala=" + json[i].id;
 
        const img = document.createElement('img');
        img.src = json[i].immagine;

        const descrizione = document.createElement('p');
        descrizione.textContent = json[i].descrizione;
        descrizione.classList.add("hidden");

        const dettagli = document.createElement("button");
        dettagli.textContent = "More Details";
        dettagli.addEventListener("click", seeDescription);

        const preferiti = document.createElement("img");
        if (json[i].isabbonato == true) {
            preferiti.dataset.isabbonato = 1;
            preferiti.src = "img/meno.png";
        } else {
            preferiti.dataset.isabbonato = 0;
            preferiti.src = "img/plus.png";
        }
        preferiti.classList.add("icon");
        preferiti.addEventListener('click', addFav);



        singolo.appendChild(titolo);
        singolo.appendChild(preferiti);
        singolo.appendChild(img);
        singolo.appendChild(descrizione);
        singolo.appendChild(dettagli);
        viewer.appendChild(singolo);

    }
}
function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
}

function showElements() {
    rest_url = "./scaricasale.php";
    fetch(rest_url).then(onResponse).then(onJson);
}
document.body.onload = showElements;

document.getElementById("search").addEventListener("keyup", ricerca);
