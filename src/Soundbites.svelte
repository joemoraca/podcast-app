<script>
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
            <th id="pod-th-center">Podcast Title</th>
            <th>Episode Title / Soundbite</th>
        </tr>
    {#each pods as pod}
    <Podlist pod={pod} />
    {/each}
</table>

</div>


<style>
    th{
        font-size: 2rem;
        font-weight: 900;
        text-align: left;
    }
    #pod-th-center{
        text-align:center;
    }

</style>