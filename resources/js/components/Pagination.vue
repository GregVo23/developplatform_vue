<template>
  <nav class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0">
    <div class="-mt-px w-0 flex-1 flex">
      <a href="#" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        <ArrowNarrowLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
        Précédent
      </a>
    </div>
    <div v-for="page in nbPages" :key="page" class="hidden md:-mt-px md:flex">
      <a @click.prevent="updateCurrent(page)" href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
        {{ page }}
      </a>
    </div>
    <div class="-mt-px w-0 flex-1 flex justify-end">
      <a href="#" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
        Suivant
        <ArrowNarrowRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
      </a>
    </div>
  </nav>
</template>

<script>
import { ArrowNarrowLeftIcon, ArrowNarrowRightIcon } from '@heroicons/vue/solid'

export default {
  name: "Pagination",
  props: ['nbPages', 'quantityPerPage', 'to', 'from'],
  components: {
      ArrowNarrowLeftIcon,
      ArrowNarrowRightIcon,
  },
    data() {
        return {
          choice: 1,
        };
    },
    methods: {
        updateCurrent: function (i) {
          this.choice = i;
          this.$emit('updatePaginate', this.choice)
        },
     },
   }


</script>