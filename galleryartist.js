
function postaSala(event) {

    const id_selezionati=[];
    const checkboxes=document.querySelectorAll("#contenuti input[type=checkbox]");
    for (let i=0;i<checkboxes.length;i++) 
    {
        if (checkboxes[i].checked) 
        {
            id_selezionati.push(checkboxes[i].value);
        }
    }

    const form_modale = event.currentTarget;
    let formdata = new FormData(form_modale);
    formdata.append("id_opere",JSON.stringify(id_selezionati));
    const form_data = { method: "post", body: formdata };

    fetch("./creategallery.php", form_data).then(onResponse).then(onJsonCreate);

    event.preventDefault();

}

function onJsonCreate(json) {
    if (json == true) {
        alert("Post Pubblicato con successo!");
        document.querySelector("#contenuti form").reset();        
    } else {
        alert("Errore pubblicazione post :-( ");
    }
}


function showElements() {
    rest_url = "./scaricaopere.php";
    fetch(rest_url).then(onResponse).then(onJson);
    console.log("sono stata chiamata");
}

function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
}




function onJson(json) {

    const form = document.createElement("form");
    const contenuti = document.querySelector("#contenuti");

    const ins_titolo = document.createElement("h1");
    ins_titolo.textContent = "Add title:";

    const titolo = document.createElement("input");
    titolo.type = "text";
    titolo.name = "titolo";

    const ins_immagine = document.createElement("h1");
    ins_immagine.textContent = "Add image:";


    const immagine = document.createElement("input");
    immagine.type = "file";
    immagine.name = "immagine";

    const ins_descrizione = document.createElement("h1");
    ins_descrizione.textContent = "Add description:";

    const descrizione = document.createElement("input");
    descrizione.type = "text";
    descrizione.name = "descrizione";

    const posta = document.createElement("input");
    posta.type = "submit";
    posta.value = "Post it!";


    const scegli_opere = document.createElement("h1");
    scegli_opere.textContent = "Choose which works to exhibit:";

    form.appendChild(ins_titolo);
    form.appendChild(titolo);

    form.appendChild(ins_immagine);
    form.appendChild(immagine);

    form.appendChild(ins_descrizione);
    form.appendChild(descrizione);
    form.appendChild(scegli_opere);

    

    for (let i = 0; i < json.length; i++) {

        const singolo = document.createElement('div');
        singolo.classList.add('singolo');

        const titolo = document.createElement('h1');
        titolo.textContent = json[i].titolo;

        const img = document.createElement('img');
        img.src = json[i].immagine;

        const seleziona = document.createElement("input");
        seleziona.type = "checkbox";
        seleziona.value = json[i].id;

        const descrizione = document.createElement('p');
        descrizione.textContent = json[i].descrizione;



        singolo.appendChild(titolo);
        singolo.appendChild(seleziona);
        singolo.appendChild(img);
        singolo.appendChild(descrizione);
        form.appendChild(singolo);






    }



    form.appendChild(posta);
    contenuti.appendChild(form);
    form.addEventListener("submit", postaSala);




}

document.body.onload = showElements;


