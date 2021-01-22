<script>
	import Soundbites from './Soundbites.svelte'
//	import Modal from './Modal.svelte'
	import Search from './Search.svelte'
	let modal;


</script>

<main>
<h1>Welcome to Podcast Soundbites</h1>
<h2>Built with <a href="http://podcastindex.org/" target="_blank">Podcast Index</a> </h2>
<div class="apptabs">
<button class="tablink" onclick="openPage('Soundbites', this, 'lightgray')" id="defaultOpen">Soundbites</button>
<button class="tablink" onclick="openPage('Search', this, 'lightgray')" >Search</button>
<button class="tablink" onclick="openPage('Contact', this, 'lightgray')">Contact</button>
<button class="tablink" onclick="openPage('About', this, 'lightgray')">About</button>

<div id="Soundbites" class="tabcontent">
	<Soundbites />
  </div>
  <div id="Search" class="tabcontent">
	<Search />
  </div>
  <div id="Contact" class="tabcontent">
	<h3>Contact</h3>
	<p>Get in touch Nomad Joe joe@webdevgeeks.com</p>
  </div>
  
  <div id="About" class="tabcontent">
	<h3>About</h3>
	<p>I live in an RV and travel the USA doing geeky stuff some of the time.</p>
</div>
</main>

<style>
	main {
		text-align: center;
		padding: 1rem;
		/* max-width: 240px; */
		margin: 0 auto;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
		margin-bottom: 5px;
		margin-top:-10px;
		padding-top: 0;
	}
	.tablink {
  background-color: rgb(175, 39, 39);
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 23%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: black;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

/* #Soundbites {background-color: lightgray;} */
/* #Search {background-color: lightgray;} */
/* #Contact {background-color: lightgray;} */
/* #About {background-color: lightgray;} */

@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}
</style>