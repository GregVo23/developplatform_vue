<template>
  <div v-if="charged == true" class="mx-auto my-5 p-5">
    <div class="md:flex md:-mx-2">
      <!-- Left Side -->
      <div class="w-full md:w-3/12 md:mx-2">
        <!-- Profile Card -->
        <div class="bg-white p-3 border-t-4 border-indigo-400">
          <div class="hover:bg-indigo-700 cursor-pointer">
            <form
              @submit="changeAvatar"
              name="frmAvatar"
              id="frmAvatar"
              method="POST"
              enctype="multipart/form-data"
              action="./api/avatar"
            >
              <label>
                <span
                  className="relative"
                  title="changer l'avatar"
                  class="image overflow-hidden cursor-pointer"
                >
                  <img
                    className="hover:opacity-25 transition-opacity duration-1000 ease-out"
                    :src="user.avatar"
                    :alt="'profile image de ' + user.firstname"
                    style="object-fit: cover"
                  />
                </span>
                <input
                  v-on:change="onChange"
                  class="hidden"
                  type="file"
                  id="avatar"
                  name="avatar"
                />
              </label>
            </form>
          </div>

          <h1
            v-if="firstname"
            class="text-gray-900 font-bold text-xl leading-8 my-1 text-center"
          >
            {{ firstname ? firstname : user.firstname }}
            {{ lastname ? lastname : user.lastname }}
          </h1>
          <h1
            v-else
            class="text-gray-900 font-bold text-xl leading-8 my-1 text-center"
          >
            {{ firstname ? firstname : user.firstname }}
            {{ lastname ? lastname : user.lastname }}
          </h1>
          <p class="mt-4 text-sm text-gray-500 hover:text-gray-600 leading-6">
            {{ user.about }}
          </p>
          <ul
            class="
              bg-gray-100
              text-gray-600
              hover:text-gray-700
              hover:shadow
              py-2
              px-3
              mt-3
              divide-y
              rounded
              shadow-sm
            "
          >
            <li class="flex items-center py-3">
              <span>Abonnement</span>
              <span class="ml-auto">
                <span
                  v-if="subscription != undefined"
                  class="bg-indigo-500 py-1 px-2 rounded text-white text-sm"
                  >{{
                    subscription != false || subscription != null
                      ? subscription.nb_max_projet == 5
                        ? "non"
                        : subscription.nb_max_projet
                      : "non"
                  }}
                  {{
                    subscription != false || subscription != null
                      ? subscription.nb_max_projet == 5
                        ? ""
                        : "€"
                      : ""
                  }}</span
                >
                <span
                  v-else
                  class="bg-indigo-500 py-1 px-2 rounded text-white text-sm"
                  >non</span
                >
              </span>
            </li>
            <li class="flex items-center py-3">
              <span>Status</span>
              <span class="ml-auto">
                <span
                  v-if="subscription != undefined"
                  class="bg-indigo-500 py-1 px-2 rounded text-white text-sm"
                  >{{
                    subscription != false
                      ? subscription.nb_max_projet -
                        subscription.nb_projet +
                        " / " +
                        subscription.nb_max_projet +
                        " actions restantes"
                      : ""
                  }}</span
                >
                <span
                  v-else
                  class="bg-indigo-500 py-1 px-2 rounded text-white text-sm"
                  >non</span
                >
              </span>
            </li>
            <li class="py-3">
              <p>Devenu membre</p>
              <span class="ml-auto">{{ sinds }}</span>
            </li>
          </ul>
        </div>
        <!-- End of profile card -->
        <div class="my-4"></div>
      </div>
      <!-- Right Side -->
      <div class="w-full md:w-9/12 sm:mx-2">
        <!-- Profile tab -->
        <!-- About Section -->
        <div class="bg-white p-3 shadow-sm rounded-xl">
          <div
            v-show="alert"
            id="alert"
            class="
              md:hidden
              transform
              rounded-md
              bg-red-50
              p-4
              transition-opacity
              duration-500
              ease-in-out
            "
          >
            <div class="flex justify-center">
              <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
              </div>
              <div class="ml-3">
                <h3 class="animate-pulse text-sm font-medium text-red-800">
                  Il y a {{ nbErrors }} erreur{{ nbErrors > 0 ? "s" : "" }} !
                </h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul role="list" class="list-disc pl-5 space-y-1">
                    <li v-for="er in this.messages" :key="er">{{ er }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div
            v-show="success"
            id="success"
            class="
              md:hidden
              transform
              rounded-md
              bg-green-50
              p-4
              transition-opacity
              duration-500
              ease-in-out
            "
          >
            <div class="flex justify-center">
              <div class="flex-shrink-0">
                <XCircleIcon
                  class="h-5 w-5 text-green-400"
                  aria-hidden="true"
                />
              </div>
              <div class="ml-3">
                <h3 class="animate-pulse text-sm font-medium text-green-800">
                  Succès !
                </h3>
                <div class="mt-2 text-sm text-green-700">
                  <ul role="list" class="list-disc pl-5 space-y-1">
                    <li v-for="message in this.messages" :key="message">
                      {{ message }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="text-gray-700">
            <div class="grid md:grid-cols-2 text-sm">
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">
                  <b>Prénom</b>
                </div>
                <div v-if="update == false" class="px-4 py-2">
                  {{ firstname ? firstname : user.firstname }}
                </div>
                <div v-else class="px-4 py-2 mr-4">
                  <input
                    v-model="firstname"
                    class="w-full"
                    type="text"
                    :placeholder="firstname ? firstname : user.firstname"
                  />
                </div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">
                  <b>Nom de famille</b>
                </div>
                <div v-if="update == false" class="px-4 py-2">
                  {{ lastname ? lastname : user.lastname }}
                </div>
                <div v-else class="px-4 py-2 mr-4">
                  <input
                    v-model="lastname"
                    class="w-full"
                    type="text"
                    :placeholder="lastname ? lastname : user.lastname"
                  />
                </div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">
                  <b>Téléphone</b>
                </div>
                <div v-if="update == false" class="px-4 py-2">
                  {{ phone ? phone : user.phone }}
                </div>
                <div v-else class="px-4 py-2 mr-4">
                  <input
                    v-model="phone"
                    class="w-full"
                    type="text"
                    :placeholder="phone ? phone : user.phone"
                  />
                </div>
              </div>
              <div class="grid grid-cols-2">
                <div class="px-4 py-2 font-semibold">
                  <b>Email</b>
                </div>
                <div v-if="update == false" class="px-4 py-2">
                  <a class="text-blue-800" :href="'mailto:' + user.email">{{
                    email ? email : user.email
                  }}</a>
                </div>
                <div v-else class="px-4 py-2 mr-4">
                  <input
                    v-model="email"
                    class="w-full"
                    type="text"
                    :placeholder="email ? email : user.email"
                  />
                </div>
              </div>
            </div>
          </div>

          <div class="mt-8 sm:flex">
            <button
              v-if="update == false"
              @click="updateProfil()"
              class="
                flex
                items-center
                ml-4
                focus:outline-none
                group
                border
                rounded-full
                py-1
                px-4
                sm:py-2
                sm:px-8
                leading-none
                border-indigo-600
                dark:border-yellow
                select-none
                hover:bg-indigo-600
                text-indigo-600
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
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
              <span class="text-gray-700 group-hover:text-white">
                Modifier profil
              </span>
            </button>
            <button
              v-else
              @click="updateProfil(), toUpdate()"
              class="
                flex
                items-center
                ml-4
                focus:outline-none
                group
                border
                rounded-full
                py-1
                px-4
                sm:py-2
                sm:px-8
                leading-none
                border-indigo-600
                dark:border-yellow
                select-none
                hover:bg-indigo-600
                text-indigo-600
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
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
              <span class="text-gray-700 group-hover:text-white">
                Ajuster profil
              </span>
            </button>

            <button
              @click="removeUser(user)"
              class="
                mt-6
                sm:mt-0
                flex
                items-center
                ml-4
                focus:outline-none
                group
                border
                rounded-full
                py-1
                px-4
                sm:py-2
                sm:px-8
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
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                />
              </svg>
              <span class="text-gray-700 group-hover:text-white">
                Supprimer profil
              </span>
            </button>
          </div>

          <div
            v-show="alert"
            id="alert"
            class="
              hidden
              md:flex
              transform
              rounded-md
              bg-red-50
              p-4
              transition-opacity
              duration-500
              ease-in-out
            "
          >
            <div class="flex justify-center">
              <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
              </div>
              <div class="ml-3">
                <h3 class="animate-pulse text-sm font-medium text-red-800">
                  Il y a {{ nbErrors }} erreur{{ nbErrors > 0 ? "s" : "" }} !
                </h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul role="list" class="list-disc pl-5 space-y-1">
                    <li v-for="er in this.messages" :key="er">{{ er }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div
            v-show="success"
            id="success"
            class="
              hidden
              md:flex
              transform
              rounded-md
              bg-green-50
              p-4
              transition-opacity
              duration-500
              ease-in-out
            "
          >
            <div class="flex justify-center">
              <div class="flex-shrink-0">
                <XCircleIcon
                  class="h-5 w-5 text-green-400"
                  aria-hidden="true"
                />
              </div>
              <div class="ml-3">
                <h3 class="animate-pulse text-sm font-medium text-green-800">
                  Succès !
                </h3>
                <div class="mt-2 text-sm text-green-700">
                  <ul role="list" class="list-disc pl-5 space-y-1">
                    <li v-for="message in this.messages" :key="message">
                      {{ message }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End of about section -->

        <div class="my-4"></div>
        <div
          class="
            bg-white
            px-4
            py-5
            border-b border-gray-200
            sm:px-6
            rounded-t-xl
          "
        >
          <div
            class="
              flex
              items-center
              space-x-2
              font-semibold
              text-gray-900
              leading-8
              mb-3
            "
          >
            <span clas="text-indigo-500">
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
                  stroke-width="2"
                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                />
              </svg>
            </span>
            <span class="tracking-wide">Mes reviews</span>
          </div>
          <p
            v-if="user.rate"
            class="mt-1 text-gray-600 font-lg text-semibold leading-6 mb-2"
          >
            Ma note moyenne d'appréciation est de
            {{ user.rate ? user.rate : "" }}/5.
          </p>
          <p v-else>Vous n'avez toujours pas reçu de note d'appréciation</p>
          <div v-if="user.rate" class="flex">
            <button
              type="button"
              v-for="i in 5"
              :key="i"
              @click="starts(i)"
              @mouseover="starts(i)"
            >
              <svg
                class="block h-10 w-10"
                :class="[
                  parseInt(user.rate) >= i ? 'text-yellow' : 'text-grey',
                ]"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                />
              </svg>
            </button>
          </div>
        </div>

        <!-- Experience and education -->
        <div
          class="
            bg-white
            p-3
            shadow-sm
            rounded-sm
            px-4
            py-5
            border-b border-gray-200
            sm:px-6
          "
        >
          <div class="sm:grid sm:grid-cols-2">
            <div>
              <div
                class="
                  flex
                  items-center
                  space-x-2
                  font-semibold
                  text-gray-900
                  leading-8
                  mb-3
                "
              >
                <span clas="text-indigo-500">
                  <svg
                    class="h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                  </svg>
                </span>
                <span class="tracking-wide">Mes demandes</span>
              </div>
              <ul v-if="myProjects.length > 0" class="list-inside space-y-2">
                <li v-for="myProject in myProjects" :key="myProject">
                  <router-link
                    :to="'/projet/' + myProject.id"
                    class="
                      text-base
                      font-medium
                      text-gray-500
                      hover:text-gray-900
                      leading-6
                    "
                    >{{
                      myProject.name
                        ? myProject.name.substring(0, 40) + " ..."
                        : ""
                    }}
                  </router-link>
                </li>
              </ul>
              <ul v-else class="list-inside space-y-2">
                <li>
                  <div class="leading-6 text-teal-600">Aucune demandes</div>
                </li>
              </ul>
            </div>
            <div class="pt-6 sm:pt-0">
              <div
                class="
                  flex
                  items-center
                  space-x-2
                  font-semibold
                  text-gray-900
                  leading-8
                  mb-3
                "
              >
                <span clas="text-indigo-500">
                  <svg
                    class="h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path
                      fill="#fff"
                      d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                    />
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                    />
                  </svg>
                </span>
                <span class="tracking-wide">Projets réalisés</span>
              </div>
              <ul
                v-if="myProjectsDone.length > 0"
                class="list-inside space-y-2"
              >
                <li
                  v-for="myProjectDone in myProjectsDone"
                  :key="myProjectDone"
                >
                  <router-link
                    :to="'/projet/' + myProjectDone.id"
                    class="
                      text-base
                      font-medium
                      text-gray-500
                      hover:text-gray-900
                      leading-6
                    "
                    >{{
                      myProjectDone.name
                        ? myProjectDone.name.substring(0, 40) + " ..."
                        : ""
                    }}
                  </router-link>
                </li>
              </ul>
              <ul v-else class="list-inside space-y-2">
                <li>
                  <div class="text-teal-600 leading-6">Aucune réalisations</div>
                </li>
              </ul>
            </div>
          </div>
          <!-- End of Experience and education grid -->
        </div>

        <!-- End of profile tab -->
      </div>
    </div>
  </div>
</template>

<script>
import Rating from "../components/Rating";
import axios from "axios";
import Input from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Input.vue";
import { XCircleIcon } from "@heroicons/vue/solid";

export default {
  data() {
    return {
      myProjectsDone: {},
      myProjects: {},
      user: {},
      sinds: "",
      subscription: "",
      rating: 3,
      avatar: "",
      avatarName: "",
      charged: false,
      update: false,
      firstname: "",
      lastname: "",
      phone: "",
      email: "",
      success: false,
      alert: false,
      nbErrors: null,
      messages: [],
    };
  },

  components: {
    Rating,
    XCircleIcon,
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
        .get("/api/profil", config)
        .then(
          ({ data }) => (
            (this.myProjectsDone = data[0]),
            (this.myProjects = data[1]),
            (this.user = data[2]),
            (this.sinds = data[3]),
            (this.subscription = data[4]),
            (this.charged = true)
          )
        )
        .catch((error) => console.log("error", error));
    },
    onChange(e) {
      this.avatar = e.target.files[0];
      this.avatarName = e.target.files[0].name;
      console.log("change");
      this.changeAvatar(e);
      //this.loadData();
    },
    changeAvatar(e) {
      e.preventDefault();

      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let data = new FormData();
      data.append("file", this.avatar);

      this.messages = [];

      axios
        .post("api/avatar/" + this.user.id, data, config)
        .then((res) => {
          console.log(res.data.message);
          if (res.data.type == "success") {
            this.alert = false;
            this.success = true;
          } else {
            this.success = false;
            this.alert = true;
          }
          if (
            typeof res.data.message === "string" ||
            res.data.message instanceof String
          ) {
            this.messages.push(res.data.message);
          } else {
            for (const [key, values] of Object.entries(res.data.message)) {
              for (const [key, value] of Object.entries(values)) {
                this.messages.push(value);
              }
            }
          }
          this.nbErrors = this.messages.length;
        })
        .catch((error) => {
          console.log(error);
          console.log(error.response);
          if (
            typeof error.response.data.errors === "string" ||
            error.response.data.errors instanceof String
          ) {
            this.messages.push(res.data.message);
          } else {
            for (const [key, value] of Object.entries(
              error.response.data.errors
            )) {
              this.messages.push(value);
            }
            this.nbErrors = this.messages.length;
          }
        });
      setTimeout(() => {
        this.loadData();
      }, 1000);
      setTimeout(() => {
        this.success = false;
        this.alert = false;
      }, 6000);
    },
    removeUser(user) {
      const config = {
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };
      if (
        confirm(
          "Attention, " +
            user.firstname +
            ", êtes vous sur de supprimer votre compte ? Ceci est irréversible même en cas d'abonnement ..."
        )
      ) {
        axios
          .delete("/api/profil/" + user.id, config)
          .then(function (res) {
            console.log(res);
          })
          .catch((error) => {
            console.log("error", error);
          });
        window.location.replace("/");
      } else {
        console.log = "Vous changer d'avis !";
      }
    },
    updateProfil() {
      this.update = !this.update;
    },
    toUpdate() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let data = new FormData();

      data.append("firstname", this.firstname ? this.firstname : "");
      data.append("lastname", this.lastname ? this.lastname : "");
      data.append("email", this.email ? this.email : "");
      data.append("phone", this.phone ? this.phone : "");

      this.messages = [];

      axios
        .post("api/profil/modification/" + this.user.id, data, config)
        .then((res) => {
          console.log(res.data.message);
          if (res.data.type == "success") {
            this.alert = false;
            this.success = true;
          } else {
            this.success = false;
            this.alert = true;
          }
          if (
            typeof res.data.message === "string" ||
            res.data.message instanceof String
          ) {
            this.messages.push(res.data.message);
          } else {
            for (const [key, values] of Object.entries(res.data.message)) {
              for (const [key, value] of Object.entries(values)) {
                this.messages.push(value);
              }
            }
          }
          this.nbErrors = this.messages.length;
        })
        .catch((error) => {
          console.log(error);
          //this.messages = error;

          for (const [key, value] of Object.entries(
            error.response.data.errors
          )) {
            this.messages.push(value);
          }
          this.nbErrors = this.messages.length;
        });
      setTimeout(() => {
        this.success = false;
        this.alert = false;
      }, 6000);
    },
  },

  created() {
    this.loadData();
  },
};
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
