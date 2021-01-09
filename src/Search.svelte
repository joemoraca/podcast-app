<script>


    async function getSearchResult() {
            const url =
                    "./pod-get-search-pods.php?q=" +
                    squery;
            let res = await fetch(url);
            res = await res.json();
            sresults = res;
            console.log(sresults);
    }
</script>