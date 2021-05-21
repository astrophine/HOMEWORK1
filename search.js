/*function postaFoto(event)
{
    const form_modale=event.currentTarget;
    let formdata = new FormData(form_modale);
    formdata.append("categoria",document.getElementById("categoria").selectedIndex + 1);
    const form_data = {method: "post", body: formdata};

    fetch("./postpost.php", form_data).then(onResponse).then(onJsonPost);
    event.preventDefault();

}

function ritornaIndietro()
{
    div_modale.classList.add("hidden");
    div_modale.innerHTML="";
    document.body.classList.remove("no_scroll");
}

function onJsonPost(json)
{
    div_modale.classList.add("hidden");
    div_modale.innerHTML="";
    document.body.classList.remove("no_scroll");
    if(json==true)
    {
        alert("Post Pubblicato con successo!");
    }else
    {
        alert("Errore pubblicazione post :-( ");
    }
}

function associaTesto(event)
{

    const contenitore=event.currentTarget.parentNode;
    const src_immagine=contenitore.querySelector("img").src;
    const titolo=contenitore.querySelector("h1");
    const autore= contenitore.querySelector("p");
    const form_modale=document.createElement("form");

    const immagine_post_mostra=document.createElement("img");
    immagine_post_mostra.src=src_immagine;

    const titolo_post_mostra=document.createElement("h1");
    titolo_post_mostra.textContent=titolo.textContent;

    const autore_post_mostra=document.createElement("p");
    autore_post_mostra.textContent=autore.textContent;

    const titolo_post_server=document.createElement("input");
    titolo_post_server.type="hidden";
    titolo_post_server.name="titolo";
    titolo_post_server.value=titolo.textContent;

    const immagine_post_server=document.createElement("input");
    immagine_post_server.type="hidden";
    immagine_post_server.name="immagine";
    immagine_post_server.value=src_immagine;

    const autore_post_server=document.createElement("input");
    autore_post_server.type="hidden";
    autore_post_server.name="autore";
    autore_post_server.value=autore.textContent;

    const descrizione=document.createElement("input");
    descrizione.type="text";
    descrizione.name="descrizione";

    const posta_foto=document.createElement("input");
    posta_foto.type="submit"; 
    posta_foto.value="Post it!";

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
    form_modale.appendChild(titolo_post_mostra);
    form_modale.appendChild(immagine_post_mostra);
    form_modale.appendChild(autore_post_mostra);
    form_modale.appendChild(categoria);

    form_modale.appendChild(titolo_post_server);
    form_modale.appendChild(immagine_post_server);
    form_modale.appendChild(autore_post_server);
    form_modale.appendChild(descrizione);
    form_modale.appendChild(posta_foto);
    form_modale.appendChild(chiudi_modale);
    div_modale.appendChild(form_modale);
    div_modale.classList.remove("hidden");
    

    chiudi_modale.addEventListener("click",ritornaIndietro);
    form_modale.addEventListener("submit",postaFoto);
}*/ //qui davo la possibilità di pubblicare le opere cercate


function onJson(json)
{
  console.log(json);
  const viewer = document.querySelector('#opere');
  for(let i=0;i<json.length;i++)
  {
      const singolo = document.createElement('div');
		singolo.classList.add('singolo');

    const titolo = document.createElement('h1');
    titolo.textContent=json[i].titolo;

		const img = document.createElement('img');
		img.src = json[i].immagine;
		
    const autore= document.createElement('p');
    autore.textContent=json[i].autore;

    const aggiungi=document.createElement('button');
    //aggiungi.textContent="Aggiungi";
    //aggiungi.addEventListener("click",associaTesto);


    singolo.appendChild(titolo);
    singolo.appendChild(img);
    singolo.appendChild(autore);
    //singolo.appendChild(aggiungi);
    viewer.appendChild(singolo);

  }


}


function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
  }


function search(event)
{
    const input_search= document.querySelector("#form_imagine .search");
    let formdata = new FormData();
    formdata.append("ricerca", input_search.value); 
    const postdata = {method: "post", body: formdata};
    fetch("./doricercacontenuti.php", postdata).then(onResponse).then(onJson);
    event.preventDefault();
}

const div_modale=document.querySelector("#modale");
div_modale.innerHTML="";

const form= document.querySelector("#form_imagine");
form.addEventListener("submit",search);

//SPOTIFY


function onJsonMusic(json) {
  console.log(json);
  
  const album = document.querySelector('#album');
  album.innerHTML = '';

  const results = json.tracks.items;
  let num_results = results.length;
  
  if(num_results > 5)
    num_results = 5;

  for(let i=0; i<num_results; i++)
  {
     const track = document.createElement('div');
    track.classList.add('traccia');

    const id_music = results[i].id;
    const url_music="https://open.spotify.com/embed/track/"+id_music;
    const frame= document.createElement('iframe');
    frame.src=url_music;
    frame.width=300;
    frame.height=300;

    track.appendChild(frame);
    album.appendChild(track);
    
  }
}

function search_music(event)
{
 
  event.preventDefault();
 
  const album_input = document.querySelector('#form_music .search');
  const track_value = encodeURIComponent(album_input.value);
  console.log('Eseguo ricerca: ' + track_value);
  
  fetch("spotify.php?q=" + track_value).then(onResponse).then(onJsonMusic);
}



// Aggiungi event listener al form
const form_music = document.querySelector('#form_music');
form_music.addEventListener('submit', search_music);


//RICERCA UTENTI

function onJsonUsers(json)
{
  console.log(json);
  const viewer_users = document.querySelector('#users');
  for(let i=0;i<json.length;i++)
  {
      const singolo_utente = document.createElement('div');
		  singolo_utente.classList.add('singolo');

    const artista = document.createElement('h1');
    artista.textContent=json[i].artista;

		const img_utente = document.createElement('img');
		img_utente.src = json[i].immagine;
		
    singolo_utente.appendChild(artista);
    singolo_utente.appendChild(img_utente);
    viewer_users.appendChild(singolo_utente);

  }


}

function search_users(event)
{
    const form_utente=event.currentTarget;
    const  form_data_utente= {method: "post", body: new FormData(form_utente)};
    fetch("./doricercautenti.php", form_data_utente).then(onResponse).then(onJsonUsers);
    event.preventDefault();
}

const form_users=document.querySelector("#form_users");
form_users.addEventListener('submit', search_users);