<script>
	import Soundbites from './Soundbites.svelte'
	import Modal from './Modal.svelte'
	let modal;
</script>

<main>
<h1>Welcome to Soundbites</h1>
	<Soundbites />
	<!-- <button on:click={() => modal.show()}>Show modal</button> -->
	<Modal bind:this={modal}>
		<h2>Modal Title</h2>
		<p>Modal content.</p>
		<button on:click={() => modal.hide()}>Close</button>
	</Modal>
</main>

<style>
	main {
		text-align: center;
		padding: 1em;
		max-width: 240px;
		margin: 0 auto;
	}

	h1 {
		color: #ff3e00;
		text-transform: uppercase;
		font-size: 4em;
		font-weight: 100;
	}

	@media (min-width: 640px) {
		main {
			max-width: none;
		}
	}
</style>