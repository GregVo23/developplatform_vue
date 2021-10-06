<template>
        <div v-if="charged == true" class="z-50 absolute inset-x-0 top-50 shadow-xl bg-white mx-auto rounded-lg rounded-t-none">



            <div v-if="show == true" class="rounded-md bg-green-50 p-4">
                <div class="flex justify-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/check-circle -->
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="animate-pulse text-sm font-medium text-green-800">
                    Succès
                    </h3>
                    <div class="text-sm text-green-700">
                    <p>
                        {{ notification }}
                    </p>
                    </div>
                </div>
                </div>
            </div>


            <div v-else class="rounded-md bg-red-50 p-4">
                <div class="flex justify-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="animate-pulse text-sm font-medium text-red-800">
                    Erreur !
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                    <ul role="list" class="list-disc pl-5 space-y-1">
                        <li>
                        {{ notification }}
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>


        </div>
</template>


<script>
    export default {
        props: ['type', 'message2'],
        name: "Notification",

        data() {
            return {
                show: null,
                /*notification: (this.message != null) ? this.message : localStorage.getItem("message"),*/
                notification: "",
                status: "",
                charged: false,
            }
        },
        mounted () {
            console.log(this);
            console.log("Notification: "+this.message2);
            console.log("Type: "+this.type);
            this.notification = this.message2;
            this.status = this.type;
            console.log("composant notif: "+this.notification+" status "+this.status);
            if (this.status !== "" && this.notification !== ""){
                this.show = (this.status == 'success') ? true : false;
                this.charged = true;
                console.log("ici");
            } else {
                this.charged = false;
                console.log(this.status);
                console.log(this.notification);
                console.log("ici222");
            }
            console.log(this.charged);
        },
        updated () {
            this.charged = true;
            console.log(this);
            console.log("Notification2: "+this.message2);
            console.log("Type2: "+this.type);
            this.notification = this.message2;
            this.status = this.type;
            console.log("composant notif2: "+this.notification+" status2 "+this.status);
            this.show = this.status == 'success' ? true : false;
        },/*
        mounted() {
            if(this.notification != null && this.notification != "" && this.notification != undefined){
                this.charged = true;
            }
            window.addEventListener('message-localstorage-changed', (event) => {
                this.notification = localStorage.getItem("message");
                //this.type = localStorage.getItem("type");
                this.status = localStorage.getItem("type");
                this.status = (this.status == "success") ? true : false;
                this.show = this.status;
                console.log("composant notif2: "+this.notification+" status2 "+this.status);
            });
        },
        updated () {
            console.log("Notification3: "+this.message);
            console.log("Type3: "+this.type);
            this.notification = (this.notification != null) ? this.message : localStorage.getItem("message");
            this.status = (this.type != null) ? this.type : localStorage.getItem("type");
            this.status = (this.status == "success") ? true : false;
            console.log("composant notif3: "+this.notification+" status3 "+this.status);
            this.show = this.status;
            this.charged = true;
        },*/
    }
</script>

<style>

</style>