<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover open="true" class="relative bg-white">
    <div
      class="
        flex
        justify-between
        items-center
        px-4
        py-6
        sm:px-6
        md:justify-start
        md:space-x-10
      "
    >
      <div class="flex justify-start lg:w-0 lg:flex-1">
        <a href="/">
          <span class="sr-only">Workflow</span>
          <img
            class="pl-4 h-10 w-auto sm:h-16"
            src="http://localhost:8000/images/logo.svg"
            alt="Developplatform logo"
          />
        </a>
      </div>
      <div class="-mr-2 -my-2 md:hidden">
        <PopoverButton
          class="
            bg-white
            rounded-md
            p-2
            inline-flex
            items-center
            justify-center
            text-gray-400
            hover:text-gray-500
            hover:bg-gray-100
            focus:outline-none
          "
        >
          <span class="sr-only">Open menu</span>
          <MenuIcon class="h-6 w-6" aria-hidden="true" />
        </PopoverButton>
      </div>

      <router-link
        to="/accueil"
        class="text-base font-medium text-gray-500 hover:text-gray-900"
        >Accueil
      </router-link>

      <PopoverGroup as="nav" class="hidden md:flex space-x-10">
        <Popover class="relative pt-8" v-slot="{ open }">
          <PopoverButton
            :class="[
              open ? 'text-gray-900' : 'text-gray-500',
              'group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none',
            ]"
          >
            <span>Projets</span>
            <ChevronDownIcon
              :class="[
                open ? 'text-gray-600' : 'text-gray-400',
                'ml-2 h-5 w-5 group-hover:text-gray-500',
              ]"
              aria-hidden="true"
            />
          </PopoverButton>

          <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-1"
          >
            <PopoverPanel
              class="
                absolute
                z-50
                -ml-4
                mt-3
                transform
                w-screen
                max-w-md
                lg:max-w-2xl
                lg:ml-0
                lg:left-1/2
                lg:-translate-x-1/2
              "
            >
              <div
                class="
                  rounded-lg
                  shadow-lg
                  ring-1 ring-black ring-opacity-5
                  overflow-hidden
                "
              >
                <div
                  class="
                    relative
                    grid
                    gap-6
                    bg-white
                    px-5
                    py-6
                    sm:gap-8
                    sm:p-8
                    lg:grid-cols-2
                  "
                >
                  <a
                    v-for="item in solutions"
                    :key="item.name"
                    class="
                      -m-3
                      p-3
                      flex
                      items-start
                      rounded-lg
                      hover:bg-gray-50
                    "
                  >
                    <div
                      v-if="item.color == true"
                      class="
                        flex-shrink-0 flex
                        items-center
                        justify-center
                        h-10
                        w-10
                        rounded-md
                        bg-indigo-500
                        text-white
                        sm:h-12
                        sm:w-12
                      "
                    >
                      <component
                        :is="item.icon"
                        :to="item.href"
                        class="h-6 w-6"
                        aria-hidden="true"
                      />
                    </div>
                    <div
                      v-else
                      class="
                        flex-shrink-0 flex
                        items-center
                        justify-center
                        h-10
                        w-10
                        rounded-md
                        bg-yellow
                        text-white
                        sm:h-12
                        sm:w-12
                      "
                    >
                      <component
                        :is="item.icon"
                        :to="item.href"
                         @click="open = !open"
                        class="h-6 w-6"
                        aria-hidden="true"
                      />
                    </div>
                    <div class="ml-4">
                      <router-link
                        v-if="item.blade"
                        :to="item.href"
                        class="
                          text-base
                          font-medium
                          text-gray-500
                          hover:text-gray-900
                        "
                        >{{ item.name }}
                        <p :to="item.href" class="mt-1 text-sm text-gray-500">
                          {{ item.description }}
                        </p>
                      </router-link>
                      <a v-else :href="item.href">
                        <p
                          class="
                            text-base
                            font-medium
                            text-gray-500
                            hover:text-gray-900
                          "
                        >
                          {{ item.name }}
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                          {{ item.description }}
                        </p>
                      </a>
                    </div>
                  </a>
                </div>
                <div class="p-5 bg-gray-50 sm:p-8">
                  <a
                    href="#"
                    class="-m-3 p-3 flow-root rounded-md hover:bg-gray-100"
                  >
                    <div class="flex items-center">
                      <div class="text-base font-medium text-gray-900">
                        Enterprise
                      </div>
                      <span
                        class="
                          ml-3
                          inline-flex
                          items-center
                          px-3
                          py-0.5
                          rounded-full
                          text-xs
                          font-medium
                          leading-5
                          bg-indigo-100
                          text-indigo-800
                        "
                      >
                        New
                      </span>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">
                      Empower your entire team with even more advanced tools.
                    </p>
                  </a>
                </div>
              </div>
            </PopoverPanel>
          </transition>
        </Popover>

        <router-link
          to="/abonnement"
          class="pt-8 text-base font-medium text-gray-500 hover:text-gray-900"
          >Abonnement
        </router-link>

        <router-link
          to="/message"
          class="pt-8 text-base font-medium text-gray-500 hover:text-gray-900"
          >Message
        </router-link>

        <Popover class="relative pl-52" v-slot="{ open }">
          <PopoverButton
            :class="[
              open ? 'text-gray-900' : 'text-gray-500',
              'group bg-white rounded-full inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none',
            ]"
          >
            <img
              class="object-cover rounded-full w-20 h-20"
              :src=user.avatar
            />
            <ChevronDownIcon
              :class="[
                open ? 'text-gray-600' : 'text-gray-400',
                'ml-2 h-5 w-5 group-hover:text-gray-500',
              ]"
              aria-hidden="true"
            />
          </PopoverButton>

          <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-1"
          >
            <PopoverPanel
              class="
                absolute
                z-50
                left-1/2
                transform
                -translate-x-1/2
                mt-3
                px-2
                w-screen
                max-w-xs
                sm:px-0
              "
            >
              <div
                class="
                  rounded-lg
                  shadow-lg
                  ring-1 ring-black ring-opacity-5
                  overflow-hidden
                "
              >
                <div
                  class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8"
                >
                    <router-link
                    to="/profil"
                    class="pt-8 text-base font-medium text-gray-500 hover:text-gray-900"
                    >Profil
                    </router-link>

                  <form id="logout-form" action="/logout" method="POST">
                    <input type="hidden" name="_token" :value="csrf" />
                    <button
                      type="submit"
                      onclick="event.preventDefault();
                            this.closest('form').submit();"
                    >
                      Déconnexion
                    </button>
                  </form>
                </div>
              </div>
            </PopoverPanel>
          </transition>
        </Popover>
      </PopoverGroup>
    </div>

    <transition
      enter-active-class="duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="duration-100 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <PopoverPanel
        focus
        class="
          absolute
          top-0
          z-50
          inset-x-0
          p-2
          transition
          transform
          origin-top-right
          md:hidden
        "
      >
        <div
          class="
            rounded-lg
            shadow-lg
            ring-1 ring-black ring-opacity-5
            bg-white
            divide-y-2 divide-gray-50
          "
        >
          <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
              <div>
                <img
                  class="h-8 w-auto"
                  src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                  alt="Workflow"
                />
              </div>
              <div class="-mr-2">
                <PopoverButton
                  class="
                    bg-white
                    rounded-md
                    p-2
                    inline-flex
                    items-center
                    justify-center
                    text-gray-400
                    hover:text-gray-500
                    hover:bg-gray-100
                    focus:outline-none
                    focus:ring-2 focus:ring-inset focus:ring-indigo-500
                  "
                >
                  <span class="sr-only">Close menu</span>
                  <XIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
            <div class="mt-6">
              <nav class="grid grid-cols-1 gap-7">
                <a
                  v-for="item in solutions"
                  :key="item.name"
                  :href="item.href"
                  class="-m-3 p-3 flex items-center rounded-lg hover:bg-gray-50"
                >
                  <div
                    v-if="item.color"
                    class="
                      flex-shrink-0 flex
                      items-center
                      justify-center
                      h-10
                      w-10
                      rounded-md
                      bg-indigo-500
                      text-white
                    "
                  >
                    <component
                      :is="item.icon"
                      class="h-6 w-6"
                      aria-hidden="true"
                    />
                  </div>
                  <div
                    v-else
                    class="
                      flex-shrink-0 flex
                      items-center
                      justify-center
                      h-10
                      w-10
                      rounded-md
                      bg-yellow
                      text-white
                    "
                  >
                    <component
                      :is="item.icon"
                      class="h-6 w-6"
                      aria-hidden="true"
                    />
                  </div>
                  <div class="ml-4 text-base font-medium text-gray-900">
                    {{ item.name }}
                  </div>
                </a>
              </nav>
            </div>
          </div>
          <div class="py-6 px-5">
            <div class="grid grid-cols-2 gap-4">
              <a
                href="#"
                class="text-base font-medium text-gray-900 hover:text-gray-700"
              >
                Pricing
              </a>

              <a
                href="#"
                class="text-base font-medium text-gray-900 hover:text-gray-700"
              >
                Docs
              </a>

              <a
                href="#"
                class="text-base font-medium text-gray-900 hover:text-gray-700"
              >
                Enterprise
              </a>
              <a
                v-for="item in resources"
                :key="item.name"
                :href="item.href"
                class="text-base font-medium text-gray-900 hover:text-gray-700"
              >
                {{ item.name }}
              </a>
            </div>
            <div class="mt-6">
              <a
                href="#"
                class="
                  w-full
                  flex
                  items-center
                  justify-center
                  px-4
                  py-2
                  border border-transparent
                  rounded-md
                  shadow-sm
                  text-base
                  font-medium
                  text-white
                  bg-indigo-600
                  hover:bg-indigo-700
                "
              >
                Sign up
              </a>
              <p class="mt-6 text-center text-base font-medium text-gray-500">
                Existing customer?
                {{ " " }}
                <a href="#" class="text-indigo-600 hover:text-indigo-500">
                  Sign in
                </a>
              </p>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script>
import {
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from "@headlessui/vue";
import {
  ChartBarIcon,
  CursorClickIcon,
  DocumentReportIcon,
  MenuIcon,
  RefreshIcon,
  ShieldCheckIcon,
  ViewGridIcon,
  XIcon,
} from "@heroicons/vue/outline";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import axios from 'axios';

const solutions = [
  {
    name: "Rechercher",
    color: false,
    blade: true,
    description: "Vous rechercher un projet à réaliser.",
    href: "/projets",
    icon: ChartBarIcon,
  },
  {
    name: "Publier",
    color: true,
    blade: true,
    description: "Vous publiez une demande de devis.",
    href: "/nouveau",
    icon: CursorClickIcon,
  },
  {
    name: "Mes propositions",
    color: false,
    blade: true,
    description: "La liste des offres que vous avez soumises.",
    href: "/offres",
    icon: ViewGridIcon,
  },
  {
    name: "Mes projets",
    color: true,
    blade: true,
    description: "La liste de vos demandes de réalisations.",
    href: "/demandes",
    icon: RefreshIcon,
  },
  {
    name: "Mes favoris",
    color: false,
    blade: true,
    description: "Les projets pour lesquels vous marquez un intérêt.",
    href: "/favoris",
    icon: DocumentReportIcon,
  },
];

const resources = [
  {
    name: "Mon profil",
    description: "Toutes mes informations.",
    href: "/profil",
  },
];

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    ChevronDownIcon,
    MenuIcon,
    XIcon,
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      user: {},
    };
  },
  setup() {
    return {
      solutions,
      resources,
    };
  },
  methods : {
      fetchApi(){
        axios.get("api/user", { 'headers': { 'Authorization': 'Bearer 13|TiL3iGtihIVQ2pSGTmfL8QoIKhEwrJvupu7pHa6c' }

        }).then(({data}) => (this.user = data)).catch(error => console.log('error', error));
      }
  },
  mounted(){
      this.fetchApi()
  }
};
</script>

<style>

.router-link-active {
    font-weight: bold;
}

</style>
