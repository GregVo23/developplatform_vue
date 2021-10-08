<template>
  <nav class="border-t border-gray-200 px-4 flex items-center justify-center sm:px-0">
    <div v-for="page in nbPages" :key="page" class="md:-mt-px md:flex">
      <a @click.prevent="updateCurrent(page)" href="#" class="border-transparent text-gray-600 hover:text-gray-800 hover:border-indigo-700 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
        {{ page }}
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