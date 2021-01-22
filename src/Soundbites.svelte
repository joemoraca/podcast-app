<script>
    import {onMount} from 'svelte'
    export let pods = ''
    import Podlist from './Podlist.svelte'

    onMount( async() => {
        const url = './pod-get-soundbites.php'
        let res = await fetch(url)
        res= await res.json()
        pods = res
        pods = pods.map(({ feedId: id, episodeTitle: episodeTitle,enclosureUrl: enclosureUrl ,startTime: startTime, duration: duration, feedTitle: title }) => ({
  id,
  title,
  episodeTitle,
  enclosureUrl,
  startTime,
  duration,
}));
        console.log(pods)
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
    <tr>
    <td> <Podlist pod={pod} /></td>
    <td class="episodetitle">{pod.episodeTitle}<br />
        <!-- svelte-ignore a11y-media-has-caption -->
        <audio controls>
                <source
                        src="{pod.enclosureUrl.split('?', 1) + '#t='}{pod.startTime},{pod.startTime + pod.duration}"
                        type="audio/mpeg" />
                Your browser does not support the audio element.
        </audio>
</td>
</tr>
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