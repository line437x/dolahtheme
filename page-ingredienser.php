<?php

get_header(); ?>

<style>
	/* RYK ALLE STYLES OVER I CUSTOM.CSS */
main {
  display: grid;
  grid-template-columns: 1fr minmax(0, 1000px) 1fr;
}
main section {
  grid-column: 2/3;
}

img {
  display: block;
  width: 100%;
  height: auto;
  padding: 0;
}


#button {
      background-color: black;
      color: white;
      border: solid 1px black;
	  padding: 1rem;
	  text-decoration-line: none;
    }

/* style på grid-produktoversigt i mobile */
#intro{
	margin-bottom: 2rem;
}

#ingrediensoversigt{
	/* grid-column: 1/2; */
	display: grid;
	/* grid-template-columns: 1fr; */
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	}

.ingrediens{
	/* height: 23rem; */
	border: solid 1px black;
	padding: 1rem;
}
</style>

<main>
	<section>
<div id="intro">
	<h1>Ingredienser</h1>
	<p id="indledende_tekst">Her finder du information og egenskaber for alle de ingredienser der indgår i Do Lah sæbebarer. Ønsker du at få oplyst om hvor de yderligere bliver brugt kan dette ses inde på de enkelt produkter. Her er allergener også oplyst.</p>
</div>

<section id="ingrediensoversigt"></section>
<template id="enkelt_ingrediens">
	<figure class="ingrediens">
		<div class="ingrediens_information">
            <h4 class="ingrediens_navn"></h4>
            <p class="ingrediens_beskrivelse"></p>
        </div>
		<img class="ingrediensbillede" src="" alt="">
	</figure>
</template>
<div id="knapper">
	<a id="button" href= "https://lineberner.com/kea/2_semester/dolah/shop" >Gå til shoppen</a>
</div>
</section>
</main>


<script>
// Her starter JS. console.log for at tjekke om der er forbindelse
// console.log("hip hurra");

// Oprettelse af variabler
let ingredienser;

const url = "https://lineberner.com/kea/2_semester/dolah/wp-json/wp/v2/ingrediens/?per_page=100";

// Oprettelse af function 'getJson' og definer hvordanm rest API'en hentes ind, og start function 'visProdukter'
async function getJson(){
	const response = await fetch(url);
	ingredienser = await response.json();

	// Kald funktioner
	visIngredienser();
}


// Oprettelse af function 'start' (som starter så snart siden er loaded)
document.addEventListener("DOMContentLoaded", start);

// Sæt function 'start' igang og vis json/rest API indhold
function start(){
	// Kald funktion
	getJson()
}

// Oprettelse af function 'visProdukter' og definer hvilket indhold der skal vises i template. forEach = for hvert produkt vises navn, pris og billede
function visIngredienser(){
	console.log(ingredienser);
	const skabelon = document.querySelector("template");
	const liste = document.querySelector("#ingrediensoversigt");

	ingredienser.forEach(ingrediens =>{
		const klon = skabelon.cloneNode(true).content;
		klon.querySelector(".ingrediens_navn").textContent = ingrediens.navn;
		klon.querySelector(".ingrediens_beskrivelse").textContent = ingrediens.beskrivelse;
		klon.querySelector(".ingrediensbillede").src = ingrediens.billede.guid;
		liste.appendChild(klon);
		
	})
}


</script>

<?php
get_footer();
