document.body.onload=caricaOpere;

function caricaOpere()
{
    rest_url="./scaricaopere.php";
    fetch(rest_url).then(onResponse).then(onJson);
}


function onJson(json)
{
    console.log(json);
    const viewer = document.querySelector('#opere_utente');
    for(let i=0;i<json.length;i++)
    {
        const singolo = document.createElement('div');
        singolo.classList.add('singolo');
  
        const titolo = document.createElement('h1');
        titolo.textContent=json[i].titolo;
  
        const img = document.createElement('img');
        img.src = json[i].immagine;
          
        const descrizione= document.createElement('p');
        descrizione.textContent=json[i].descrizione;
  
      
  
  
      singolo.appendChild(titolo);
      singolo.appendChild(img);
      singolo.appendChild(descrizione);
      viewer.appendChild(singolo);
  
    }
  
}

function postaOpera(event)
{
    console.log("entri?");
    const form_modale=event.currentTarget;
    let formdata = new FormData(form_modale);
    formdata.append("categoria",document.getElementById("categoria").selectedIndex + 1);
    const form_data = {method: "post", body: formdata};

    fetch("./postpostopera.php", form_data).then(onResponse).then(onJsonPost);
    event.preventDefault();

}


function onResponse(response) 
{
    console.log('Risposta ricevuta');
    return response.json();
}

function onJsonPost(json)
{
    div_modale.classList.add("hidden");
    div_modale.innerHTML="";
    document.body.classList.remove("no_scroll");
    if(json==true)
    {
        alert("Post Pubblicato con successo!");
         caricaOpere();

    }else
    {
        alert("Errore pubblicazione post :-( ");
    }
}



function ritornaIndietro()
{
    div_modale.classList.add("hidden");
    div_modale.innerHTML="";
    document.body.classList.remove("no_scroll");
}

function modale_inserimento(event)
{
    console.log("ciao");
   
    const form_modale=document.createElement("form");

    const ins_titolo=document.createElement("h1");
    ins_titolo.textContent="Add title:";

    const titolo=document.createElement("input");
    titolo.type="text";
    titolo.name="titolo";

    const ins_immagine=document.createElement("h1");
    ins_immagine.textContent="Add image:";


    const immagine=document.createElement("input");
    immagine.type="file";
    immagine.name="immagine";

    const ins_descrizione=document.createElement("h1");
    ins_descrizione.textContent="Add description:";

    const descrizione=document.createElement("input");
    descrizione.type="text";
    descrizione.name="descrizione";

    const posta=document.createElement("input");
    posta.type="submit"; 
    posta.value="Post it!";

    const ins_categoria=document.createElement("h1");
    ins_categoria.textContent="Add category:";

    const categoria = document.createElement("select");
    categoria.setAttribute("id", "categoria");
    for(let i = 0; i < CATEGORIE.length; i++)
    {
      let opzione = document.createElement("option");
      opzione.text = CATEGORIE[i];
      categoria.add(opzione);
    }
      

    const chiudi_modale=document.createElement("button");
    chiudi_modale.textContent="Annulla";


    div_modale.style.top=window.pageYOffset+'px';
    document.body.classList.add("no_scroll");

    form_modale.appendChild(ins_titolo);
    form_modale.appendChild(titolo);

    form_modale.appendChild(ins_immagine);
    form_modale.appendChild(immagine);

    form_modale.appendChild(ins_categoria);
    form_modale.appendChild(categoria);

    form_modale.appendChild(ins_descrizione);
    form_modale.appendChild(descrizione);

    form_modale.appendChild(posta);
    form_modale.appendChild(chiudi_modale);
    div_modale.appendChild(form_modale);
    div_modale.classList.remove("hidden");
    

    chiudi_modale.addEventListener("click",ritornaIndietro);
    form_modale.addEventListener("submit",postaOpera);
}

const div_modale=document.querySelector("#modale");
div_modale.innerHTML="";

const button=document.querySelector("#add_work");
button.addEventListener("click",modale_inserimento);
