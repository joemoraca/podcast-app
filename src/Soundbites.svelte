<script>
  //  import {pods} from './data-pods'
    import {onMount} from 'svelte'
    export let pods = ''
    import Podlist from './Podlist.svelte'

    onMount( async() => {
        const url = './pod-get-soundbites.php'
        let res = await fetch(url)
        res= await res.json()
        pods = res
       // console.log(pods)
    })
 
</script>

<!-- svelte-ignore missing-declaration -->
<!-- HTML Area -->
<div id="pods">
    <table width=100%>
        <tr>
            <th>Feedtitle</th>
            <th>FeedID</th>
            <th>EpisodeTitle</th>
            <th>Player</th>
        </tr>
    {#each pods as pod}
    <Podlist pod={pod} />
    {/each}
</table>

</div>


<style>
</style>