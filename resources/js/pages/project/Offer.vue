<template>
  <main class="mt-4 mb-4">
    <div
      v-show="loaded"
      class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-full lg:px-8"
    >
      <h1 class="text-xl">Mes propositions</h1>
      <!-- Main 3 column grid -->
      <div class="grid grid-cols-1 gap-4 items-start">
        <!-- Left column -->
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
          <section v-if="projects.length > 0" aria-labelledby="section-1-title">
            <div class="rounded-lg bg-white overflow-hidden shadow mb-10">
              <div class="p-4">
                <!-- Content -->

                <template v-for="project in projects" :key="project.id">
                  <div class="flex flex-col mt-2 flex-grow">
                    <div class="flex-grow mt-2">
                      <div
                        :class="project.user_id != user.user_id"
                        class="
                          flex-grow
                          w-full
                          items-center
                          justify-between
                          bg-white
                          dark:bg-gray-800
                          px-6
                          py-4
                          lg:px-8
                          lg:py-6
                          border-l-2 border-indigo-700
                          dark:border-indigo-300
                        "
                      >
                        <!-- card -->
                        <div class="flex justify-between">
                          <a
                            :href="
                              'http://localhost:8000/storage/project/cover/' +
                              project.id +
                              '/' +
                              project.picture
                            "
                            class="hidden md:block"
                          >
                            <div class="flex-none">
                              <img
                                class="h-36 w-36 rounded object-cover"
                                :src="
                                  'http://localhost:8000/project/cover/' +
                                  project.picture
                                "
                                :alt="project.name"
                              />
                            </div>
                          </a>

                          <div class="flex-grow ml-2 lg:ml-6">
                            <span class="text-lg font-bold"> </span>
                            <span class="text-lg font-bold"
                              >{{ project.name }}
                            </span>
                            <p>
                              {{ project.about.substring(0, 100) + " ..." }}
                            </p>

                            <div
                              class="
                                mt-1
                                flex flex-col
                                sm:flex-row sm:flex-wrap
                                sm:mt-0
                                sm:space-x-6
                              "
                            >
                              <div class="flex ml-6">
                                <svg
                                  class="flex-shrink-0 h-6 w-6 text-gray-400"
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke="currentColor"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                  />
                                </svg>
                                <span
                                  class="
                                    ml-2
                                    text-sm text-gray-600
                                    dark:text-gray-300
                                    capitalize
                                  "
                                >
                                  {{ project.nbLike }}
                                </span>
                              </div>

                              <div class="flex ml-6">
                                <svg
                                  class="flex-shrink-0 h-6 w-6 text-gray-400"
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
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                  />
                                </svg>
                                <span
                                  class="
                                    ml-2
                                    text-sm text-gray-600
                                    dark:text-gray-300
                                  "
                                >
                                  {{ project.price }}
                                </span>
                              </div>

                              <div
                                v-if="project.country != 'Null'"
                                class="flex ml-6"
                              >
                                <svg
                                  class="flex-shrink-0 h-6 w-6 text-gray-400"
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
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                                  />
                                </svg>
                                <span
                                  class="
                                    ml-2
                                    text-sm text-gray-600
                                    dark:text-gray-300
                                  "
                                >
                                  {{ project.country }}
                                </span>
                              </div>

                              <div class="flex ml-6">
                                <svg
                                  class="h-5 w-5 fill-current text-gray-400"
                                  viewBox="0 0 24 24"
                                  fill="text-gray-400"
                                >
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
                                            01-3.89-1.63z"
                                  ></path>
                                </svg>
                                <span
                                  class="
                                    ml-2
                                    text-sm text-gray-600
                                    dark:text-gray-300
                                  "
                                >
                                  {{
                                    project.deadline != null
                                      ? project.deadline.split(" ")[0]
                                      : "Pas de deadline"
                                  }}
                                </span>
                              </div>
                            </div>

                            <div class="mt-4 flex justify-between flex-grow">
                              <router-link
                                :to="'/projet/' + project.id"
                                class="
                                  flex
                                  items-center
                                  ml-4
                                  focus:outline-none
                                  group
                                  border
                                  rounded-full
                                  py-2
                                  px-6
                                  leading-none
                                  border-yellow
                                  dark:border-yellow
                                  select-none
                                  hover:bg-yellow
                                  text-yellow
                                  hover:text-white
                                  dark-hover:text-gray-200
                                  transition
                                  ease-in-out
                                  duration-200
                                  transform
                                  hover:-translate-y-1
                                  hover:translate-x-0.5
                                "
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="h-6 w-6"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke="currentColor"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                  />
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                  />
                                </svg>
                                <span
                                  class="text-gray-700 group-hover:text-white"
                                >
                                  Voir le projet
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
          <section v-else aria-labelledby="section-1-title">
            <div class="rounded-lg bg-white overflow-hidden shadow">
              <div class="p-4 text-center">
                <p class="pt-6 text-xl pb-6">
                  Vous n'avez pas encore fait de propositions
                </p>
                <router-link
                  to="/projets"
                  class="
                    w-56
                    flex
                    items-center
                    m-auto
                    focus:outline-none
                    group
                    border
                    rounded-full
                    py-2
                    px-6
                    leading-none
                    border-yellow
                    dark:border-yellow
                    select-none
                    hover:bg-yellow
                    text-yellow
                    hover:text-white
                    dark-hover:text-gray-200
                    transition
                    ease-in-out
                    duration-200
                    transform
                    hover:-translate-y-1
                    hover:translate-x-0.5
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
                  <span class="text-gray-700 group-hover:text-white">
                    Rechercher un projet
                  </span>
                </router-link>

                <div class="flex">
                  <div class="flex-shrink sm-w-3/4 xl-w-2/4 -mb-50 -pb-50">
                    <img
                      src="http://localhost:8000/images/no-projects.jpg"
                      alt="no projects to do"
                    />
                  </div>
                  <div class="flex-grow"></div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      projects: {},
      categories: {},
      subCategories: {},
      user: {},
      $userRate: null,
      loaded: false,
    };
  },
  methods: {
    loadData() {
      const config = {
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };
      axios
        .get("/api/offres", config)
        .then(
          ({ data }) => (
            (this.projects = data[0]),
            (this.categories = data[1]),
            (this.subCategories = data[2]),
            (this.user = data[3]),
            (this.userRate = data[4]),
            (this.loaded = true)
          )
        )
        .catch(function (error) {
          if (error.response) {
            // Request made and server responded
            console.log(error.response.data);
          } else if (error.request) {
            // The request was made but no response was received
            console.log(error.request);
          } else {
            // Something happened in setting up the request that triggered an Error
            console.log("Error", error.message);
          }
        });
    },
  },
  created() {
    console.log("created");
    this.loadData();
  },
};
</script>
