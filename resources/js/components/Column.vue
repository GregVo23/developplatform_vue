<template>
    <section id="sidebar" aria-labelledby="section-2-title" class="hidden">
        <h2 class="sr-only" id="section-2-title">
            Section title
        </h2>
        <div
            class="rounded-lg bg-white overflow-hidden shadow"
            id="sidebar"
        >
            <div class="p-6">
                <!-- Column Content -->

                <!-- This example requires Tailwind CSS v2.0+ -->

                <nav class="space-y-1" aria-label="Sidebar">
                    <h3>Les catégories</h3>

                    <ul
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <a
                            href="#"
                            class="
                                bg-gray-100
                                text-gray-900
                                group
                                flex
                                items-center
                                px-3
                                py-2
                                text-sm
                                font-medium
                                rounded-md
                            "
                            aria-current="page"
                        >
                            <!-- Heroicon  -->
                            <svg
                                class="
                                    text-gray-400
                                    group-hover:text-gray-500
                                    flex-shrink-0
                                    -ml-1
                                    mr-3
                                    h-6
                                    w-6
                                "
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                />
                            </svg>
                            <span class="truncate">
                                {{ category.name }}
                            </span>
                        </a>
                    </ul>

                    <a
                        href="#"
                        class="
                            text-gray-600
                            hover:bg-gray-50 hover:text-gray-900
                            group
                            flex
                            items-center
                            px-3
                            py-2
                            text-sm
                            font-medium
                            rounded-md
                        "
                    >
                        <!-- Heroicon name: outline/users -->
                        <svg
                            class="
                                text-gray-400
                                group-hover:text-gray-500
                                flex-shrink-0
                                -ml-1
                                mr-3
                                h-6
                                w-6
                            "
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                            />
                        </svg>
                        <span class="truncate">
                            "Pas de sous-catégories"
                        </span>
                    </a>
                    <router-link
                        to="/accueil" class="block text-base font-medium text-gray-500 hover:text-gray-900">Accueil
                    </router-link>
                    <router-link
                        to="/favoris" class="block text-base font-medium text-gray-500 hover:text-gray-900">Favoris
                    </router-link>
                    <router-link
                        to="/accueil" class="block text-base font-medium text-gray-500 hover:text-gray-900">Accueil
                    </router-link>
                    <router-link
                        to="/accueil" class="block text-base font-medium text-gray-500 hover:text-gray-900">Accueil
                    </router-link>
                    <router-link
                        to="/accueil" class="block text-base font-medium text-gray-500 hover:text-gray-900">Accueil
                    </router-link>
                </nav>
            </div>
        </div>
    </section>
</template>


<script>
    export default {
        props: ['categories'],
        name: "Column",

        data() {
            return {
                charged: false,
                show:false,
            }
        },

        created () {
            this.allcategories = this.categories;
        },

        methods: {


            loadFormData() {
                let lastKnownScrollPosition = 0;
                let ticking = false;
                let footer = document.querySelector('#footer');
                let height = document.querySelector("main").offsetHeight;


                function doSomething(scrollPos) {

                    let position = window.pageYOffset;

                    if(position > height - 500){

                        document.querySelector("#sidebar > div").style.width = '100%';
                        document.querySelector('#sidebar').style.position = 'relative';
                        document.querySelector('#sidebar').style.width = '100%';
                        document.querySelector('#sidebar').style.transition = 'background-color 0.3s ease';
                        document.querySelector('#sidebar').style.backgroundColor = 'transparent';
                        document.querySelector('#sidebar').style.display = 'flex';

                    }else{

                        document.querySelector("#sidebar > div").style.width = '100%';
                        document.querySelector('#sidebar').style.position = 'fixed';
                        document.querySelector('#sidebar').style.width = '32%';
                        document.querySelector('#sidebar').style.transition = 'background-color 0.3s ease';
                        document.querySelector('#sidebar').style.backgroundColor = 'white';
                        document.querySelector('#sidebar').style.display = 'flex';
                    }
                }

                document.addEventListener('scroll', function(e) {
                    lastKnownScrollPosition = window.scrollY;


                    if (!ticking) {
                    window.requestAnimationFrame(function() {
                        doSomething(lastKnownScrollPosition);
                        ticking = false;
                    });

                    ticking = true;
                    }
                });
            },
        },
        created() {
            this.loadFormData();
        },
}
</script>

<style>
    #sidebar{
        position: fixed;;
    }
</style>