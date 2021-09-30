<template>
    <div v-if="charged == true" class="sm-mx-10 md-mx-20 lg-mx-30">
        <div class="px-4 py-5 sm:px-6 flex">
            <div class="flex-grow">
                <h1 class="mt-4 text-xl leading-6 font-medium text-gray-900">
                    {{ project.name }}
                </h1>
                <h5 class="mt-8 max-w-2xl text-sm text-gray-500 font-bold">
                    Description:
                </h5>
                <p class="mt-1 text-sm text-gray-900">
                    {{ project.about }}
                </p>

                <dl
                    class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 mt-6"
                >
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <b>Prix annoncé</b>
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{
                                project.price
                                    ? project.price+" €"
                                    : "Pas de prix annoncé"
                            }}
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <b>Date de réalisation</b>
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{
                                project.deadline
                                    ? project.deadline.split(" ")[0]
                                    : "Pas de deadline"
                            }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="flex-shrink-0 ml-4">
                <a
                    :href="url + '' + picturePath + '' + project.picture"
                    target="about_blank"
                >
                    <img
                        class="h-56 w-56 rounded object-cover"
                        title="Voir en grand"
                        :src="
                            'http://localhost:8000/project/cover/' +
                            project.picture
                        "
                        :alt="project.name"
                    />
                </a>
            </div>
        </div>


        <div v-if="user.id == project.user_id && offers.length > 0" class="border-t px-4 py-5 sm:px-6">
            <span class="flex bg-grey-lighter">
                        <span
                            @click="openOffer = !openOffer"
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                tracking-wide
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                    clip-rule="evenodd"
                                />
                                <path
                                    d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Voir mes offres</span
                            >
                            <a href="#"></a>
                        </span>
                    </span>



  <div v-show="openOffer" class="flex flex-col mt-2">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Montant de offre
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Appréciation globale
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Message
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Accept</span>
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Refuse</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="offer in offers" :key="offer.id" class="bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ offer.amount ? offer.amount+" €" : project.price+" €" }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ offer.rate ? offer.rate+" /5" : "aucune" }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ offer.information ? offer.information : "Pas de message" }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <a @click="acceptProposal(offer)" class="text-indigo-600 hover:text-indigo-900">Accepter</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <a @click="refuseProposal(offer)" class="text-red-600 hover:text-red-900">Refuser</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


        </div>
        <div v-else-if="user.id == project.user_id" class="px-6 text-sm font-medium text-gray-500">
            <b>Offres reçues</b>
            <p class="pt-1">Vous n'avez pas encore reçus d'offre</p>
        </div>
        <div v-else>
        </div>







        <div class="border-t px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">
                        <b>Pièces-jointes</b>
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <ul
                            class="
                                border border-gray-200
                                rounded-md
                                divide-y divide-gray-200
                            "
                        >
                            <li
                                v-if="!document"
                                class="
                                  text-gray-500
                                    pr-4
                                    flex
                                    items-center
                                    justify-between
                                    text-sm
                                "
                            >
                                Pas de pièce-jointe
                            </li>

                            <li v-if="document">
                                <div
                                    v-for="doc in document"
                                    :key="doc"
                                    class="
                                        pl-3
                                        pr-4
                                        py-3
                                        flex
                                        items-center
                                        justify-between
                                        text-sm
                                    "
                                >
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg
                                        class="
                                            flex-shrink-0
                                            h-5
                                            w-5
                                            text-gray-400
                                        "
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        {{ doc }}
                                    </span>
                                    <div class="ml-4 flex-shrink-0">
                                        <a
                                            :href="
                                                url +
                                                '' +
                                                documentPath +
                                                '' +
                                                doc
                                            "
                                            :download="doc"
                                            target="about_blank"
                                            class="
                                                font-medium
                                                text-indigo-600
                                                hover:text-indigo-500
                                            "
                                        >
                                            Télécharger
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <p class="text-sm font-medium text-gray-500">
                <b>Notifications</b>:
                {{ project.notifications ? "Autorisées" : "Refusées " }}
            </p>
        </div>

        <div class="mt-1 px-4 py-5 sm:px-6">
            <p class="mt-8 max-w-2xl text-sm text-gray-500">
                <b>Catégorie:</b> {{ category }}
            </p>
            <p class="text-gray-400 text-sm mt-2">{{ categoryDescription }}</p>

            <p class="mt-2 max-w-2xl text-sm text-gray-500">
                <b>Sous-Catégorie:</b> {{ subCategory }}
            </p>
            <p class="text-gray-400 text-sm mt-2">
                {{ subCategoryDescription }}
            </p>
        </div>
        <div v-if="makeOffer" class="mt-1 px-4 py-5 sm:px-6">
            <p v-if="!isNaN(offer) && offer != null && offer != true" class="text-indigo-800">Vous avez fait une offre pour ce projet de : {{ offer ? offer+" €" : 'Pas d\'offre' }}</p>
            <p v-else class="text-indigo-800">Vous avez accepté ce projet</p>
        </div>
        <div v-else class="mt-1 px-4 py-5 sm:px-6">
            <p class="text-indigo-800">Vous n'avez toujours fait d'offres pour ce projet</p>
        </div>

        <Rating v-model="rating" />

        <section v-if="subscription.nb_max_projet - subscription.nb_projet > 0" class="mb-6">
            <div v-if="!makeOffer" class="flex justify-evenly">
                <button
                    v-if="user.id !== owner.id"
                    @click="accept(project)"
                    class="flex justify-center"
                >
                    <span class="flex bg-grey-lighter">
                        <span
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Accepter le projet</span
                            >
                        </span>
                    </span>
                </button>

                <div v-if="user.id !== owner.id" class="flex justify-center">
                    <span
                        class="flex bg-grey-lighter"
                        @click.prevent="open = !open"
                    >
                        <span
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                v-show="!open"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                v-show="open"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Faire une offre</span
                            >
                        </span>
                    </span>
                </div>

                <div v-cloak v-if="user.id === owner.id" class="flex justify-center">
                    <span class="flex bg-grey-lighter">
                        <span
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                tracking-wide
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                    clip-rule="evenodd"
                                />
                                <path
                                    d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Modifier mon projet</span
                            >
                            <a href="#"></a>
                        </span>
                    </span>
                </div>

                <button
                    v-cloak
                    v-if="user.id === owner.id"
                    class="flex justify-center"
                    @click="removeProject(project)"
                >
                    <span class="flex bg-grey-lighter">
                        <span
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Supprimer mon projet</span
                            >
                        </span>
                    </span>
                </button>
            </div>
            <div v-else>
                <div v-on="charged" class="flex justify-center">
                    <span class="flex bg-grey-lighter">
                        <span
                            @click="removeOffer(project)"
                            class="
                                w-64
                                flex flex-col
                                items-center
                                px-4
                                py-6
                                bg-white
                                text-gray-700
                                rounded-lg
                                shadow-lg
                                tracking-wide
                                uppercase
                                border border-blue
                                cursor-pointer
                                hover:bg-blue hover:text-gray-900
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                                    clip-rule="evenodd"
                                />
                                <path
                                    d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"
                                />
                            </svg>
                            <span
                                class="
                                    mt-2
                                    text-base
                                    leading-normal
                                    text-center
                                "
                                >Retirer mon offre</span
                            >
                            <a href="#"></a>
                        </span>
                    </span>
                </div>
            </div>
            <form
                @submit="formSubmit"
                name="frmNegociation"
                id="frmNegociation"
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8"
                method="POST"
                enctype="multipart/form-data"
                action="./api/projet/offre"
            >
                <div
                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                >
                    <div
                        class="col-span-6 sm:col-span-6"
                        v-show="open"
                        x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <div>
                            <label
                                for="amount"
                                class="block text-sm font-medium text-gray-700"
                                >Proposition de prix</label
                            >
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        left-0
                                        pl-3
                                        flex
                                        items-center
                                        pointer-events-none
                                    "
                                >
                                    <span class="text-gray-500 sm:text-sm">
                                        €
                                    </span>
                                </div>
                                <input
                                    v-model="amount"
                                    type="text"
                                    name="amount"
                                    id="amount"
                                    class="
                                        focus:ring-indigo-500
                                        focus:border-indigo-500
                                        block
                                        w-full
                                        pl-7
                                        pr-12
                                        sm:text-sm
                                        border-gray-300
                                        rounded-md
                                    "
                                    placeholder="0.00"
                                    required
                                    aria-describedby="amount-currency"
                                />
                                <div
                                    class="
                                        absolute
                                        inset-y-0
                                        right-0
                                        pr-3
                                        flex
                                        items-center
                                        pointer-events-none
                                    "
                                >
                                    <span
                                        class="text-gray-500 sm:text-sm"
                                        id="amount-currency"
                                    >
                                        EUR
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 sm:col-span-6"
                        v-show="open"
                        x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <div class="flex justify-between">
                            <label
                                for="information"
                                class="
                                    block
                                    text-sm
                                    font-medium
                                    text-warm-gray-900
                                "
                                >Description proposition</label
                            >
                            <span
                                id="information-max"
                                class="text-sm text-warm-gray-500"
                                >Max. 1000 charactères</span
                            >
                        </div>
                        <div class="mt-1">
                            <textarea
                                v-model="information"
                                id="information"
                                name="information"
                                rows="4"
                                class="
                                    py-3
                                    px-4
                                    block
                                    w-full
                                    shadow-sm
                                    text-warm-gray-900
                                    focus:ring-teal-500 focus:border-indigo-500
                                    border border-gray-300
                                    rounded-md
                                "
                                required
                                aria-describedby="information-max"
                            ></textarea>
                        </div>
                    </div>

                    <button
                        v-show="open"
                        type="submit"
                        @click="submit"
                        class="
                            flex
                            items-center
                            ml-4
                            focus:outline-none
                            group
                            border
                            rounded-full
                            py-2
                            px-8
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
                            hover:-translate-y-1 hover:translate-x-0.5
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
                        <span class="text-gray-700 group-hover:text-white">
                            Faire la proposition
                        </span>
                    </button>
                </div>
            </form>
        </section>
        <section v-else v-cloak class="mt-1 px-4 py-5 sm:px-6 text-center bg-indigo-700 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="mt-2">Hélas vous n'avez plus assez d'actions disponible ce mois-ci...</p>
            <p class="text-xl my-2">Un abonnement, peut-être ?</p>
            <router-link
                to="/abonnement"
                class="pt-8 text-base font-medium text-yellow hover:text-gray-500"
                >Vers les abonnements
            </router-link>
        </section>
    </div>
    <Notification v-if="show" :message="message" :type="type" />
</template>

<script>
import axios from "axios";
import Notification from "../../components/Notification.vue";
import Rating from "../../components/Rating.vue";

export default {
    name: "Show",
    components: {
        Notification,
        Rating,
    },

    data() {
        return {
            id: this.$route.params.id,
            show: {},
            project: {},
            user: {},
            owner: {},
            open: false,
            picturePath: "",
            documentPath: "",
            document: {},
            category: "",
            subCategory: "",
            categoryDescription: "",
            subCategoryDescription: "",
            information: "",
            amount: "",
            message: "",
            type: "",
            show: false,
            charged: false,
            offer: false,
            offers: [],
            openOffer: false,
            acceptProject: false,
            offerProject: false,
            makeOffer: false,
            deadline: false,
            url: "http://localhost:8000/",
            raing: 5,
            subscription: {},
        };
    },

    methods: {
        loadFormData() {
            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            axios
                .get("/api/projet/" + this.id, config)
                .then(
                    ({ data }) => (
                        (this.project = data[0]),
                        (this.user = data[1]),
                        (this.owner = data[2]),
                        (this.picturePath = data[3]),
                        (this.documentPath = data[4]),
                        (this.document = data[5]),
                        (this.category = data[6]),
                        (this.subCategory = data[7]),
                        (this.categoryDescription = data[8]),
                        (this.subCategoryDescription = data[9]),
                        (this.offer = data[10]),
                        (this.offers = data[11]),
                        (this.subscription = data[12]),
                        (this.offer ? this.makeOffer = true : this.makeOffer = false),
                        (this.charged = true)
                    )
                )
                .catch((error) => console.log("error", error));
        },
        accept(project) {
            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            if (confirm("Etes vous sur d'accepter ce projet ?")) {
                axios
                    .post("/api/projet/accepter/" + project.id, config)
                    .then((res) => {
                            //console.log(res.data.message);
                            //console.log(res.data.type);
                        localStorage.setItem("message", res.data.message);
                        localStorage.setItem("type", res.data.type);
                        this.message = res.data.message;
                        this.type = res.data.type;
                    })
                    .catch((error) => {
                        //console.log(error.response.data.errors);
                        this.type = false;
                    });

                this.showNotification();


                this.showNotification();
                this.offer = !this.offer;
                this.open = false;
                this.makeOffer = !this.makeOffer;
                this.offerProject = !this.offerProject;
                this.acceptProject = !this.acceptProject;
            }
        },

        showNotification() {
            this.show = true;
            this.hideNotification();
        },

        hideNotification() {
            this.hideTimeout = setTimeout(() => {
                localStorage.removeItem("message");
                localStorage.removeItem("type");
                this.show = false;
                this.message = "";
                this.type = "";
            }, 5000);
        },

        destroyNotification() {
            this.show = false;
            clearTimeout(this.hideTimeout);
        },

        formSubmit(e) {
            e.preventDefault();

            // Prohibited words
            const words = [
                "connard",
                "salaud",
                "enculé",
                "salope",
                "pute",
                "fuck",
                "baise",
                "cul",
                "penis",
                "fdp",
                "sexe",
                "merde",
            ];

            if (isNaN(this.amount)) {
                console.log("error", "Le montant doit être un nombre");
                this.message = "Le montant doit être un nombre !";
                this.type = false;
                this.showNotification();
                throw new Error("Le montant doit être un nombre !");
            }

            if (this.project.price != undefined) {
                if (this.amount.length > this.project.price / 2) {
                    console.log(
                        "error",
                        "Le montant doit au moins plus grand que la moitié de ce que demande la personne !"
                    );
                    this.message =
                        "Le montant doit au moins plus grand que la moitié de ce que demande la personne ! Vous proposez seulement " +
                        this.amount.length +
                        " € contre " +
                        this.project.price +
                        " € demandé ...";
                    this.type = false;
                    this.showNotification();
                    throw new Error(
                        "Le montant doit au moins plus grand que la moitié de ce que demande la personne !"
                    );
                }
            }

            if (this.information.length > 999) {
                console.log("error", "Pas plus de milles caractères");
                this.message = "Pas plus de milles caractères";
                this.type = false;
                this.showNotification();
                throw new Error("Pas plus de milles caractères !");
            }

            for (const element of words) {
                if (this.information.includes(element)) {
                    console.log(
                        "error",
                        "Votre texte contient un vocabulaire interdit comme : " +
                            element
                    );
                    this.message =
                        "Le texte contient un vocabulaire interdit comme : " +
                        element;
                    this.type = false;
                    this.showNotification();
                    throw new Error(
                        "Le texte contient un vocabulaire interdit !"
                    );
                }
            }

            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };

            let data = new FormData();
            data.append("amount", this.amount ? this.amount : '');
            data.append("information", this.information ? this.information : '');

            if (confirm("Etes vous sur de faire cette offre de "+this.amount+"€ pour ce projet ?")) {

                axios
                    .post("/api/projet/offre/" + this.id, data, config)
                    .then((res) => {
                        localStorage.setItem("message", res.data.message);
                        localStorage.setItem("type", res.data.type);
                        this.message = res.data.message;
                        this.type = res.data.type;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                this.showNotification();
                this.offer = parseInt(this.amount);
                console.log(typeof(this.offer));
                this.open = false;
                this.makeOffer = !this.makeOffer;
                this.offerProject = !this.offerProject;
                this.acceptProject = !this.acceptProject;
            }
        },
        removeProject(project) {
            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            if (
                confirm(
                    "Etes vous sur de supprimer ce projet : " +
                        project.name.substring(0, 25) +
                        " ..."
                )
            ) {
                axios
                    .post("/api/projet/" + this.id, config)
                    .then(function (res) {
                        console.log(res);
                    })
                    .catch((error) => {
                        console.log("error", error);
                        this.message = "Une erreur est survenue !";
                        this.type = false;
                        this.showNotification();
                        throw new Error(
                            "Une erreur est survenue lors de la suppression du projet"
                        );
                    });

                this.message = "Ce projet est supprimé.";
                this.type = true;
                this.showNotification();
                this.offerProject = !this.offerProject;
                window.location.replace("/accueil");
            }
        },
        refuseProposal(offer){
            console.log('refuse');
            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            if (
                confirm(
                    "Etes vous sur de refuser l'offre"
                )
            ) {
                axios
                    .post("/api/offres/refuser/" + offer.id, config)
                    .then(function (res) {
                        console.log(res);
                    })
                    .catch((error) => {
                        console.log("error", error);
                    });
            }
        },
        acceptProposal(offer){
            console.log('accept');
                        const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            if (
                confirm(
                    "Etes vous sur d'accepter cette offre"
                )
            ) {
                axios
                    .post("/api/offres/accepter/" + offer.id, config)
                    .then(function (res) {
                        console.log(res);
                    })
                    .catch((error) => {
                        console.log("error", error);
                    });
            }
        },
        removeOffer(project) {
            const config = {
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            };
            if (
                confirm(
                    "Etes vous sur de retirer vottre offre pour ce projet : " +
                        project.name.substring(0, 25) +
                        " ..."
                )
            ) {
                axios
                    .post("/api/projet/annuler/" + this.id, config)
                    .then(function (res) {
                        localStorage.setItem("message", res.data.message);
                        localStorage.setItem("type", res.data.type);
                        console.log(res.data.message);
                    })
                    .catch((error) => {
                        console.log("error", error);
                    });

                this.type = "success";
                this.message = "Votre offre a été retirée";
                this.showNotification();
                this.offer = !this.offer;
                this.open = false;
                this.makeOffer = !this.makeOffer;
                this.offerProject = !this.offerProject;
                this.acceptProject = !this.acceptProject;
                //window.location.replace("/accueil");
            }
        },
    },

    created() {
        this.loadFormData();
    },
};
</script>

<style></style>
