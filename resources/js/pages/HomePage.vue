<template>
  <div class="lg:flex lg:mt-16">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">
            <h3 class="mx-2 text-xl text-gray-700">
              Bonjour <b> {{ user.firstname }} </b> !
            </h3>
            <p class="mx-2 mt-2 text-gray-500">
              Prêt pour développer votre activité ?
            </p>
            <div class="mt-4 flex">
              <div class="flex mx-2">
                <router-link
                  to="/projets"
                  class="
                    flex
                    items-center
                    focus:outline-none
                    border
                    rounded-full
                    py-2
                    px-6
                    leading-none
                    border-gray-500
                    dark:border-gray-600
                    select-none
                    hover:bg-indigo-700
                    hover:text-white
                    dark-hover:text-gray-200
                  "
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    />
                  </svg>
                  Rechercher
                </router-link>
              </div>
              <div class="flex mx-2">
                <router-link
                  to="/nouveau"
                  class="
                    flex
                    items-center
                    focus:outline-none
                    border
                    rounded-full
                    py-2
                    px-6
                    leading-none
                    border-gray-500
                    dark:border-gray-600
                    select-none
                    hover:bg-indigo-700
                    hover:text-white
                    dark-hover:text-gray-200
                  "
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  Ajouter un projet
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex">
      <div class="flex-shrink sm-3/4 xl-w-2/4 -mb-50 -pb-50">
        <lottie-player
          src="https://assets2.lottiefiles.com/packages/lf20_NmBGIS.json"
          background="transparent"
          speed="1"
          style="width: 90%"
          loop
          autoplay
        ></lottie-player>
        <!--<lottie-player src="https://assets3.lottiefiles.com/private_files/lf30_wwq2op12.json"  background="transparent"  speed="1"  style="width: 60%;"  loop  autoplay></lottie-player>-->
      </div>
      <div class="flex-grow"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user: {},
    };
  },
  methods: {
    fetchApi() {
      const config = {
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      axios.get("api/user", config).then(({ data }) => (this.user = data));
      console.log("mounted");
    },
  },
  created() {
    this.fetchApi();
  },
};
</script>
