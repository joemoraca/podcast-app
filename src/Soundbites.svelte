<script>
    import {onMount} from 'svelte'
    export let pods = ''
    import Podlist from './Podlist.svelte'
    let filename;

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
      //  console.log(pods)
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
            <!-- <audio or video controls> -->
                 <span class="hideme">{filename = pod.enclosureUrl.split('?', 1)+''}</span>
             {#if filename.split('.').pop() == 'mp4' }
            <!-- svelte-ignore a11y-media-has-caption -->
            <video controls>
                    <source
                            src="{pod.enclosureUrl.split('?', 1) + '#t='}{pod.startTime},{pod.startTime + pod.duration}"
                            type="video/mp4" />
                    Your browser does not support the video element.
            </video>
            {:else}
            <!-- svelte-ignore a11y-media-has-caption -->
            <audio controls>
                    <source
                            src="{pod.enclosureUrl.split('?', 1) + '#t='}{pod.startTime},{pod.startTime + pod.duration}"
                            type="audio/mp3" />
                    Your browser does not support the audio element.
            </audio>
          {/if}
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
    .episodetitle{
                font-weight: 700;
                font-size: 1.5rem;
                text-align: left;
                padding-left: 10px;
                padding-top: 8px;
        }
</style>