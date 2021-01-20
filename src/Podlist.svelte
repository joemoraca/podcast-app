<script>
        export let pod = {};
        export let podcastinfo = {};
        export let episodes = "";
        import Modal from "./Modal.svelte";
        let modal;

        async function getPodcastInfo() {
                const url =
                        "./pod-get-feedid.php?id=" +
                        pod.feedId;
                let res = await fetch(url);
                res = await res.json();
                podcastinfo = res;
              //  console.log(podcastinfo)
        }
        async function getEpisodes() {
                const url =
                        "./pod-get-episodes-feedid.php?id=" +
                        pod.feedId;
                let res = await fetch(url);
                res = await res.json();
                episodes = res;
           //     console.log(episodes);
        }
        function modalpodcast() {
                modal.show();
                getPodcastInfo();
                getEpisodes();
        }
</script>

<style>
        .modaldiv {
                font-size: 1.2rem;
                text-align: left;
                display: grid;
                grid-template-columns: auto 310px;
                grid-template-rows: auto auto;
                grid-column-gap: 10px;
                grid-template-areas: "modalleft modalright" "modalepisodes modalepisodes";
        }
        .modalleft {
                grid-area: modalleft;
        }
        .modalright {
                grid-area: modalright;
                text-align: center;
        }
        .modalepisodes {
                grid-area: modalepisodes;
        }
        .podtitle{
                font-weight: 700;
                font-size: 1.25rem;      
                margin-left: 10px;
                margin-right: 10px;
        }
        .podtitlelink{
                font-weight: 700;
                font-size: 1.25rem;  
        }
        .episodetitle{
                font-weight: 700;
                font-size: 1.5rem;
                text-align: left;
                padding-left: 10px;
                padding-top: 8px;
        }

</style>

<tr>
        <td>
                <Modal bind:this={modal}>
                        <div class="modaldiv">
                                <div class="modalleft">
                                        {#if podcastinfo.link}
                                        <span class="podtitle">Podcast Name:</span><a class="podtitlelink" href="{podcastinfo.link}" target="_blank">{pod.feedTitle}</a><br />
                                        {:else}
                                        <span class="podtitle">Podcast Name:</span><span class="podtitlelink">{pod.feedTitle}</span><br />
                                        {/if}
                                        <span class="podtitle">Author: </span>{podcastinfo.author}<br />
                                        <span class="podtitle">Desc:</span>{podcastinfo.description}<br />
                                        <span class="podtitle">RSS Feed: </span><a class="podtitlelink" href="{podcastinfo.url}" target="_blank">Subscribe</a>
                                </div>
                                <div class="modalright">
                                        <img    src={podcastinfo.artwork}
                                                alt="podcast artwork"
                                                width="300px" /><br />
                                </div>
                                <div class="modalepisodes">
                                        <span class="podtitle">Episodes:</span><br />
                                        <table>
                                        {#each episodes as episode}
                                          <tr>   <td>    <span class="podtitle">{episode.title}</span>
                                                <span class="podtitle">Published Date: </span>{episode.datePublishedPretty}<br />
                                                {@html episode.description.replace(/(<([^>]+)>)/gi, "")}<br />
                                                </td>
                                                <!-- svelte-ignore a11y-media-has-caption -->
                                                <td>
                                                <audio controls>
                                                        <source
                                                                src="{episode.enclosureUrl.split('?', 1)}"
                                                                type="audio/mpeg" />
                                                        Your browser does not support the audio element.
                                                </audio></td>
                                        </tr>
                                        {/each}
                                        </table>
                                </div>
                        </div>
                </Modal>
                <button title="Click to see Podcast Info" on:click={() => modalpodcast()}>{pod.feedTitle} </button>
        </td>
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
