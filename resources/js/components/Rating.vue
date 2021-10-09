<template>
  <div class="flex">
    <button
      type="button"
      v-for="i in 5"
      :key="i"
      @click="starts(i)"
      @mouseover="starts(i)"
    >
      <svg
        class="block h-10 w-10"
        :class="[value >= i ? 'text-yellow' : 'text-grey']"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path
          d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
        />
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  name: "Rating",
  props: ["rate"],
  data() {
    return {
      value: this.rate,
    };
  },
  methods: {
    starts: function (i) {
      this.value = i;
      this.$emit("starts", this.value);
    },
  },
};
</script>
