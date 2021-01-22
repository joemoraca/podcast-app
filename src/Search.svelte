<script>
    export let pods = ''
    import Podlist from './Podlist.svelte'
    // let sresults ='';
    let squery = '';
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    let mindate = Date.now() - 5184000000;

    async function getSearchResult() {
        let url = "./pod-get-search-pods.php?squery=" + squery;
        url = url.split(' ').join('+');
       console.log(url);
        let res = await fetch(url);
        res = await res.json();
        pods = res.feeds;

// trying to only show podcasts last updated within 60 days then sorted newest first
pods = pods.filter(function (e) {return e.lastUpdateTime > mindate/1000;});
pods.sort((a, b) => parseFloat(b.lastUpdateTime) - parseFloat(a.lastUpdateTime));
  console.log(pods)
    }
</script>

    <fieldset>
        <label for="">Search Podcast Index Podcasts</label>
        <input bind:value={squery} type="text" placeholder="seach by one term">
        <button on:click={() => getSearchResult()}>Search</button>
    </fieldset>
<table width="100%">
    <tr>
        <th id="pod-th-center">Podcast Title</th>
        <th>Last Updated</th>
        <th>Image</th>
        <th>Description</th>
    </tr>
    {#each pods as pod}
         <tr> <!--{ pod.feedId = pod.id} -->
            <td> <Podlist pod={pod} /></td>
            <td>{new Date(pod.lastUpdateTime*1000).toLocaleDateString('en-US',options)}</td>
                <!-- {console.log(dateObject)} -->
            <td><img src={pod.artwork} width="125px" alt="podcast artwork"></td> 
           <td>{pod.description}</td>
        </tr>
    {/each}
</table>
