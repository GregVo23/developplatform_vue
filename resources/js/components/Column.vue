<template>
  <aside id="sidebar" aria-labelledby="section-2-title" class="z-10">
    <div class="rounded-lg bg-white overflow-hidden shadow w-1/3" id="sidebar">
      <div class="p-6">
        <!-- Column Content -->

        <div v-if="subCategoryId !== ''" class="mb-2">
          <img
            class="rounded mb-2 w-11/12"
            :src="subCategoryChosen[0].image ? subCategoryChosen[0].image : ''"
            :alt="subCategoryChosen[0].name ? subCategoryChosen[0].name : ''"
          />
          <h4 class="font-bold text-lg">
            {{ subCategoryChosen[0].name ? subCategoryChosen[0].name : "" }}
          </h4>
          <p>
            {{
              subCategoryChosen[0].description
                ? subCategoryChosen[0].description
                : ""
            }}
          </p>
        </div>
        <div v-else-if="categoryId !== ''">
          <ul v-for="subcategory in allSubCategories" :key="subcategory.id">
            <li
              href="#"
              class="
                bg-white
                text-gray-900
                group
                flex
                items-center
                px-3
                py-2
                text-sm
                font-medium
                rounded-md
                hover:bg-gray-100
                cursor-pointer
              "
              aria-current="page"
            >
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
                {{ subcategory.name }}
              </span>
            </li>
          </ul>
        </div>
        <div v-else>
          <img
            class="w-auto rounded-lg mb-6"
            src="http://localhost:8000/images/logo.svg"
            alt="developplatform"
          />

          <nav class="space-y-1 w-auto" aria-label="Sidebar">
            <div class="flex justify-between">
              <router-link
                to="/accueil"
                class="
                  block
                  text-base
                  font-medium
                  text-gray-500
                  hover:text-gray-900
                "
                >Accueil
              </router-link>
              <router-link
                to="/favoris"
                class="
                  block
                  text-base
                  font-medium
                  text-gray-500
                  hover:text-gray-900
                "
                >Favoris
              </router-link>
              <router-link
                to="/offres"
                class="
                  block
                  text-base
                  font-medium
                  text-gray-500
                  hover:text-gray-900
                "
                >propositions
              </router-link>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </aside>
</template>


<script>
export default {
  props: ["subcategories", "categoryId", "subcategory", "subCategoryId"],
  name: "Column",

  data() {
    return {
      charged: false,
      show: false,
      allSubCategories: [],
      show: false,
      subCategoryChosen: [],
    };
  },

  watch: {
    /**
     *  All subcategories from the chosen category
     */
    subcategories: function () {
      this.allSubCategories = [...this.subcategories];
    },
    /**
     *  The chosen category
     */
    subCategoryId: function () {
      this.subCategoryChosen = [];
      this.subcategories.forEach((element) => {
        if (element.id == this.subCategoryId) {
          this.subCategoryChosen.push(element);
        }
      });
    },
  },

  methods: {
    /**
     * Load all datas
     */
    loadFormData() {
      let lastKnownScrollPosition = 0;
      let ticking = false;
      let footer = document.querySelector("#footer").offsetHeight;
      let height = document.querySelector("#sidebar");

      /**
       *  Effect on the column when scrolling
       */
      function changeColumn(scrollPos) {
        let position = window.pageYOffset;

        if (position < height + 2000) {
          document.querySelector("#sidebar").style.display = "block";
        }

        if (position > height + 2200) {
          document.querySelector("#sidebar").style.display = "none";
        }
      }

      document.addEventListener("scroll", function (e) {
        lastKnownScrollPosition = window.scrollY;

        if (!ticking) {
          window.requestAnimationFrame(function () {
            changeColumn(lastKnownScrollPosition);
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
};
</script>

<style>
#sidebar {
  position: fixed;
}
</style>