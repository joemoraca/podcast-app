<script>
    let shown = false;
    export function show(){
        shown = true;
    }
    export function hide(){
        shown = false;
    }
</script>

<style>
    .modal-wrapper{
        background-color: rgba(0,0,0,0.6);
        position: fixed;
        width: 100%;
        height: 100%;
        top:0;
        left: 0;
    }
    .modal{
        background-color: white;
        max-width: 95vw;
        padding: 1rem;
        margin: 2% auto;
        max-height: 95%;
    }
    .close{
        float:right;
        cursor: pointer;
        font-size:2.5rem;
        font-weight: 900;
        padding-left:5px;
    }
    .close:hover {
        font-weight: 900;
    }
</style>
<svelte:window
    on:keydown={e => {
        if (e.keyCode == 27){
            hide();
        }
    }} />
{#if shown}
    <div class="modal-wrapper">
        <div class="modal">
            <span class="close" on:click={() => hide()}>&times;</span>
            <slot />
        </div>
    </div>
{/if}