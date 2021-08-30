

<template>
        <main class="mt-4 mb-4">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-full lg:px-8">
            <h1 class="sr-only">Page title</h1>

            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">

                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                <section aria-labelledby="section-1-title">
                    <h2 class="sr-only" id="section-1-title">Section title</h2>
                    <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="p-4">
                    <!-- Content -->



                        <div class="flex mt-2 flex-col">
                            <div class="flex justify-items-stretch">

                                <div class="flex-col w-1/3 mx-1">
                                    <select @change="onCategory($event)" id="Selectcategory" name="Selectcategory" class="w-full mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="" disabled selected hidden>Filtre par catégorie</option>

                                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>

                                    </select>
                                </div>

                                <div class="flex-col w-1/3 mx-1">
                                    <select @change="onSubCategory($event)" id="SelectSubCategory" name="SelectSubCategory" class="w-full mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="" disabled selected hidden>Filtre par sous-catégorie</option>

                                            <option v-for="subcategory in subcategories" :key="subcategory.id" :value=" subcategory.id ">{{ subcategory.name }}</option>
                                    </select>
                                </div>

                                <div class="flex-col w-1/3 mx-1">
                                    <input class="mt-1 relative border leading-none border-gray-500
                                    dark:border-gray-600 select-none block w-full bg-white bg-opacity-20 py-2 pl-10 pr-3 rounded-md mb-6 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-opacity-100 focus:border-transparent focus:placeholder-gray-700 focus:ring-0 sm:text-sm"
                                    placeholder="Filtre par mot clé"
                                    type="FilterSearch"
                                    name="FilterSearch"
                                    v-model="letters"
                                    ref=""
                                    @keyup="search()">
                                    <p>{{ letters }}</p>
                                </div>

                            </div>
                            <div class="flex justify-items-end">

                                <div class="flex ml-1">
                                    <select id="nbPage" name="nBpage" class="w-24 mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">

                                            <option value="1">1</option>

                                    </select>
                                    <label for="nbPage" class="mt-2 ml-2"></label>
                                </div>
                            </div>
                        </div>

                    <template v-for="project in projects" :key="project.id">


                        <div class="flex flex-col mt-2 flex-grow">
                            <div class="flex-grow mt-2">
                                <div
                                :class="project.user_id != user.user_id"
                                class="flex-grow w-full items-center justify-between bg-white
                                dark:bg-gray-800 px-8 py-6 border-l-2 border-indigo-700
                                dark:border-indigo-300">
                                <!-- card -->
                                <div class="flex justify-between">
                                    <a :href="'http://localhost:8000/project/cover/'+this.user+'/'+project.id+'/'+project.picture">
                                    <div class="flex-none">
                                        <img
                                        class="h-36 w-36 rounded object-cover"
                                        :src="'http://localhost:8000/project/cover/'+project.picture"
                                        :alt="project.name" />
                                    </div>
                                    </a>

                                    <div class="flex-grow ml-6">

                                    <span class="text-lg font-bold">


                                    </span>
                                    <span class="text-lg font-bold">{{ project.name }}
                                    </span>
                                    <p>{{ project.about.substring(0,100)+' ...' }}</p>

                                    <div class="mt-4 flex">
                                        <div class="flex">
                                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        <span
                                            class="ml-2 text-sm text-gray-600
                                            dark:text-gray-300 capitalize">
                                            {{ project.nbLike  }}
                                        </span>
                                        </div>


                                        <div class="flex ml-6">
                                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        <span
                                            class="ml-2 text-sm text-gray-600
                                            dark:text-gray-300">
                                            {{ project.price  }}
                                        </span>
                                        </div>

                                        <div class="flex ml-6">
                                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        <span
                                            class="ml-2 text-sm text-gray-600
                                            dark:text-gray-300">
                                            {{ project.country }}
                                        </span>
                                        </div>


                                        <div class="flex ml-6">
                                        <svg
                                            class="h-5 w-5 fill-current
                                            text-gray-400"
                                            viewBox="0 0 24 24"
                                            fill="text-gray-400">
                                            <path
                                            d="M13 2.05v2.02c3.95.49 7 3.85 7
                                            7.93 0 3.21-1.92 6-4.72 7.28L13
                                            17v5h5l-1.22-1.22C19.91 19.07 22
                                            15.76 22
                                            12c0-5.18-3.95-9.45-9-9.95M11
                                            2c-1.95.2-3.8.96-5.32 2.21L7.1
                                            5.63A8.195 8.195 0 0111 4V2M4.2
                                            5.68C2.96 7.2 2.2 9.05 2
                                            11h2c.19-1.42.75-2.77
                                            1.63-3.9L4.2 5.68M6
                                            8v2h3v1H8c-1.1 0-2 .9-2
                                            2v3h5v-2H8v-1h1c1.11 0 2-.89
                                            2-2v-1a2 2 0 00-2-2H6m6
                                            0v5h3v3h2v-3h1v-2h-1V8h-2v3h-1V8h-2M2
                                            13c.2 1.95.97 3.8 2.22
                                            5.32l1.42-1.42A8.21 8.21 0 014
                                            13H2m5.11 5.37l-1.43 1.42A10.04
                                            10.04 0 0011 22v-2a8.063 8.063 0
                                            01-3.89-1.63z"></path>
                                        </svg>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                                            {{ project.deadline }}
                                        </span>
                                        </div>
                                    </div>
                                    <div class="mt-1 text-sm">


                                    </div>


                                    <div class="mt-4 flex justify-end flex-grow">

                                            <button
                                                v-if="project.user_id != user.user_id"
                                                class="flex items-center ml-4
                                                focus:outline-none group border rounded-full
                                                py-2 px-6 leading-none border-indigo-700
                                                dark:border-indigo-700 select-none
                                                hover:bg-indigo-700 text-indigo-700 hover:text-white
                                                dark-hover:text-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span
                                                v-if="project.like"
                                                @click="removeFavorite(project)"
                                                class="text-gray-700 group-hover:text-white">
                                                    Supprimer des favoris
                                                </span>
                                                <span
                                                v-else
                                                @click="addFavorite(project)"
                                                class="text-gray-700 group-hover:text-white">
                                                    Ajouter aux favoris
                                                </span>
                                            </button>



        <router-link
          :to="'/projet/'+project.id"
          class="flex items-center ml-4
                focus:outline-none group border rounded-full
                py-2 px-6 leading-none border-yellow
                dark:border-yellow select-none
                hover:bg-yellow text-yellow hover:text-white
                dark-hover:text-gray-200 transition ease-in-out duration-200 transform hover:-translate-y-1 hover:translate-x-0.5"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span
            v-if="project.user_id != user.user_id"
            class="text-gray-700 group-hover:text-white">
                Voir le projet
            </span>
            <span
            v-else
            class="text-gray-700 group-hover:text-white">
                Voir mon projet
            </span>
        </router-link>


                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>




                    </template>






                </div>
                </div>
                </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4 wrap">
                <section id="sidebar" aria-labelledby="section-2-title">
                    <h2 class="sr-only" id="section-2-title">Section title</h2>
                    <div class="rounded-lg bg-white overflow-hidden shadow" id="sidebar">
                    <div class="p-6">
                        <!-- Column Content -->








<!-- This example requires Tailwind CSS v2.0+ -->


<nav class="space-y-1" aria-label="Sidebar">


  <h3>Les catégories</h3>

    <ul v-for="category in categories" :key="category.id">

    <a href="#"  class="bg-gray-100 text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md" aria-current="page">
        <!--
        Heroicon name: outline/home

        Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
        -->
        <!-- Heroicon name: outline/folder -->
        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <span class="truncate">
        {{ category.name }}
        </span>
    </a>

    </ul>

        <a
        href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
        <!-- Heroicon name: outline/users -->
        <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
        </svg>
        <span class="truncate">

            "Pas de sous-catégories"

        </span>
        </a>

</nav>








                    </div>
                    </div>
                </section>
                    <!-- Image publicity-->
                </div>

            </div>
            </div>
        </main>
</template>


<script>
import { ref } from "vue";
import { Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { SearchIcon } from '@heroicons/vue/solid'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import axios from 'axios'



export default {
  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverPanel,
    BellIcon,
    MenuIcon,
    SearchIcon,
    XIcon,
  },
  setup(props, context) {
      const letters = ref();

      return { letters };
  },
  data(){
      return {
          projects: {},
          categories: {},
          subcategories: {},
          user: {},
          like: false,
          filter: [],
          listOfAllCategories: [],
          listOfAllProjects: [],
          listOfAllSubCategories: [],
          categoryId: '',
      }
  },
  methods:{
      loadData(){
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
          axios.get("api/demandes", config).then(({data}) => (this.projects = data[0], this.listOfAllProjects = data[0], this.categories = data[1], this.subcategories = data[2], this.user = data[3])).catch(error => console.log('error', error));
      },
      addFavorite(project){
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
            axios.post("api/favoris/"+project.id, config).then(({data}) => (this.data = data)).catch(error => console.log('error', error));
          project.like = !project.like;
      },
      removeFavorite(project){
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
            axios.post("api/favoris/supprimer/"+project.id, config).then(({data}) => (this.data = data)).catch(error => console.log('error', error));
          if(confirm("Etes vous sur ?")){
            project.like = !project.like;
          };
      },
      search(){
        this.filter = [];

        if(this.letters.length !== undefined){
            if (this.letters.length === 0){
                this.projects = this.listOfAllProjects;
            } else {
                this.projects = this.listOfAllProjects;
                this.projects.forEach(element => {
                    if(element.name.toLowerCase().search(this.letters.toLowerCase()) > -1){
                        this.filter.push(element);
                        JSON.stringify(this.filter);
                    }else{
                        this.projects = this.listOfAllProjects;
                    }
                });
                this.projects = this.filter;
            }
        }
      },
      onCategory(event){
            this.filter = [];

            this.listOfAllProjects.forEach(element => {
                    if(element.category_id == event.target.value){
                        this.filter.push(element);
                        JSON.stringify(this.filter);
                        this.categoryId = element.category_id;
                        this.subCategoryChange();
                    }else{
                        this.projects = this.listOfAllProjects;
                    }
                });
                this.projects = this.filter;
            },
      onSubCategory(event){
            this.filter = [];

            this.listOfAllProjects.forEach(element => {
                    if(element.sub_category_id == event.target.value){
                        this.filter.push(element);
                        JSON.stringify(this.filter);
                    }else{
                        this.projects = this.listOfAllProjects;
                    }
                });
                this.projects = this.filter;
            },
      subCategoryChange(){
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
                axios.get("api/subcategories/"+this.categoryId, config).then(({data}) => (this.subcategories = data)).catch(error => console.log('error', error));
            },
  },

  created(){
      this.loadData();
  }
}
</script>
