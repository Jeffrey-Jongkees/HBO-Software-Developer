// window.onload = function() {
//     alert("Welkom bij de Boerderijautomaat! Klik op het product dat u wilt kopen en volg de instructies.");
// }


// Functie om de temperatuur te regelen in de boerderijautomaat
function controleerTemperatuur() {
    let temperatuur = parseFloat(document.getElementById("temperatuur").value);
    let drempel = 7; // Drempelwaarde - max aantal graden celcius
    let meldingElement = document.getElementById("temperatuur-melding");

    meldingElement.style.display = 'block';
    meldingElement.style.padding = '10px';
    meldingElement.style.color = 'white'; 

    if (temperatuur > drempel) {
        meldingElement.textContent = "De temperatuur is te hoog!";
        meldingElement.style.backgroundColor = 'red'; 
    } 
    else if (temperatuur < 4) {
        meldingElement.textContent = "De temperatuur is te laag!";
        meldingElement.style.backgroundColor = 'blue'; 
    }
    else {
        meldingElement.textContent = "Optimale koel temperatuur";
        meldingElement.style.backgroundColor = 'green';
    }
}

// Functie om de temperatuur melding weg te klikken
function verbergMelding() {
    let meldingElement = document.getElementById("temperatuur-melding");
    meldingElement.style.display = 'none';
}

// Functie om de klant er zeker van te laten zijn dat dit het gewenste product is om aan te schaffen
function bevestigProduct(product) {
    const bevestiging = confirm(`Weet u zeker dat u ${product} wilt kopen?`);

    if (bevestiging) {
        // Als gebruiker op OK klikt, ga naar de betaalpagina
        window.location.href = `betaal-pagina`;
        return true;
    } else {
        // Als gebruiker op Annuleren klikt, blijf op dezelfde pagina
        return false;
    }
}