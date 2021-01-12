<script>
    let sresults ='';
    let squery = '';
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    let mindate = Date.now() - 5184000000;

    async function getSearchResult() {
        const url = "./pod-get-search-pods.php?squery=" + squery;
        let res = await fetch(url);
        res = await res.json();
        sresults = res.feeds;
        console.log(squery);
// trying to only show podcasts last updated within 60 days then sorted newest first
    //  sresults =  sresults.filter(newpods => newpods.lastUpdateTime > mindate/1000);
        sresults = sresults.filter(function (e) {return e.lastUpdateTime > mindate/1000;});
        sresults.sort((a, b) => parseFloat(b.lastUpdateTime) - parseFloat(a.lastUpdateTime));
    //    console.log(sresults)
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
    {#each sresults as sresult}
        <tr>
            <td class="podlist">{sresult.title}</td>
            <td>{new Date(sresult.lastUpdateTime*1000).toLocaleDateString('en-US',options)}</td>
                <!-- {console.log(dateObject)} -->
            <td><img src={sresult.artwork} width="125px" alt="podcast artwork"></td> 
           <td>{sresult.description}</td>
        </tr>
    {/each}
</table>
