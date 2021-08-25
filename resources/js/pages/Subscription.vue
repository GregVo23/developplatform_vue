

<template>


</template>


<script>

import axios from 'axios'

export default {

    data(){
        return {
            user: {},
        }
    },
    methods:{
        loadData(){

            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }

            axios.get("/api/abonnement", config)
            .then(({data}) => (
                this.user = data[0]
            ))
            .catch(error => console.log('error', error))
        },
    },
    
    created(){
        this.loadData();
    }
    
}

</script>


<style>
    .text-gradient {
        background-clip: text;
        -webkit-text-fill-color: transparent;

    }
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>
