function valuta(event)
{
    const valore=event.target.dataset.valore;
    const opera=event.currentTarget.parentNode.dataset.id_opera;
    
    const formData = new FormData();
        formData.append('stellaid', valore); //vorrei passare pure id dell'opera 
        formData.append('opera', opera); //non so se si fa così
        // Mando l'ID alla pagina PHP tramite fetch
        fetch("./inserimentovalutazione.php", {method: 'post', body: formData}).then(onResponse).then(onJsonAbbonamentoEffettuato);
        // TODO: fare richiesta al database perabbonarsi ad una sala (cioé inserire riga in tabella abbonamento)
    event.currentTarget.setAttribute("class", "valutato"+valore);
}
function onJsonAbbonamentoEffettuato(json)
{
    if(json==true)
    {
        alert("Valutato con successo!");
    }else
    {
        alert("Errore valutazione post :-( ");
    }
}

function onJson(json)
{
    const viewer = document.querySelector('#container');
    for(let i=0;i<json.length;i++)
    {
        
        const singolo = document.createElement('div');
        singolo.classList.add("singolo");
        singolo.dataset.id_opera=json[i].id;
  
        const titolo = document.createElement('h1');
        titolo.textContent=json[i].titolo;
  
        const img = document.createElement('img');
        img.setAttribute("id","imagine_home");
        img.src = json[i].immagine;
          
        const descrizione= document.createElement('p');
        descrizione.textContent=json[i].descrizione;
        
        //creazione stelline

        const star_widget=document.createElement('div');
        if (json[i].valutazione)
            star_widget.setAttribute("class", "valutato"+json[i].valutazione);
            star_widget.classList.add("star_widget");
        
        const stella1=document.createElement("img");
        stella1.src="img/stella.png";
        stella1.dataset.valore="1";
        
        const stella2=document.createElement("img");
        stella2.src="img/stella.png";
        stella2.dataset.valore="2";

        const stella3=document.createElement("img");
        stella3.src="img/stella.png";
        stella3.dataset.valore="3";

        const stella4=document.createElement("img");
        stella4.src="img/stella.png";
        stella4.dataset.valore="4";

        const stella5=document.createElement("img");
        stella5.src="img/stella.png";
        stella5.dataset.valore="5";


        star_widget.appendChild(stella1);
        star_widget.appendChild(stella2);
        star_widget.appendChild(stella3);
        star_widget.appendChild(stella4);
        star_widget.appendChild(stella5);

        star_widget.addEventListener("click",valuta);

      singolo.appendChild(titolo);
      singolo.appendChild(star_widget);
      singolo.appendChild(img);
      singolo.appendChild(descrizione);
      viewer.appendChild(singolo);
  
    }
}

function onResponse(response) 
{
    console.log('Risposta ricevuta');
    return response.json();
}

function showElements() {
    if (document.body.dataset.sala)
        rest_url = "./scaricaopere.php?sala=" + document.body.dataset.sala; 
    else
        rest_url = "./scaricaopere.php";  
    fetch(rest_url).then(onResponse).then(onJson);
}
document.body.onload = showElements;