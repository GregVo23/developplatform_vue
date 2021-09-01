<template>

<form @submit="formSubmit" name="frmProjet" id="frmProjet" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8" method="POST" enctype="multipart/form-data" action="./api/nouveau">

      <div>
        <div>
          <div>
            <h2 class="pb-4 pt-2 text-xl leading-6 font-medium text-gray-900">
              Mon Nouveau Projet
            </h2>
            <p class="mt-1 text-sm text-gray-500">
              Je rentre via le formulaire <u><b>ci-dessous</b></u> toutes les information liées à ma demande de réalisation de projet.
            </p>
          </div>
          <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">



          <div class="sm:col-span-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>

            <select v-model="categoryselected" @change="subCategoryChange()" id="category" name="category" autocomplete="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <option disabled value="">Sélectionner une catégorie</option>
                    <option v-for="category in categories" :key="category.id" :data-id="category.id" :value="category.id">{{ category.name }}</option>

            </select>
        </div>

        <div class="sm:col-span-6">
            <label for="subCategory" class="block text-sm font-medium text-gray-700">Sous catégorie</label>
            <select v-model="subcategoryselected" id="subCategory" name="subCategory" autocomplete="subCategory" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                    <option disabled value="">Sélectionner une catégorie</option>
                    <option v-for="subcategory in subcategories" :key="subcategory.id" :data-id="subcategory.id" :value="subcategory.id">{{ subcategory.name }}</option>



            </select>

        </div>

            <div class="col-span-6 sm:col-span-6">
              <label for="name" class="block text-sm font-medium text-gray-700">
                Nom du projet
              </label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <input v-model="project.titleName" type="text" name="name" id="name" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
              </div>
            </div>

            <div class="col-span-6 sm:col-span-6">
              <label for="about" class="block text-sm font-medium text-gray-700">
                Description de la demande
              </label>
              <div class="mt-1">
                <textarea v-model="project.about" id="about" name="about" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
              </div>
              <p class="mt-2 text-sm text-gray-500">Expliquez ce que vous attendez comme résultat, donnez des exemples.</p>
            </div>

            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
              <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm">
                    €
                  </span>
                </div>
                <input v-model="project.price" type="number" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00" aria-describedby="price-currency">
              </div>
            </div>

            <div class="col-span-6 sm:col-span-6 lg:col-span-3">
              <label for="deadline" class="block text-sm font-medium text-gray-700">Délais</label>
              <input v-model="project.deadline" type="date" name="deadline" id="deadline" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>


        </div>
        <div class="mt-8 flex justify-between">






            <div>

                <label for="picture" class="block text-sm font-medium text-gray-700">
                    Photo de couverture
                    </label>
                    <div class="flex bg-grey-lighter">
                        <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-gray-700 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="mt-2 text-base leading-normal select-none">Choisir une photo</span>
                            <input v-on:change="onChange" type='file' class="hidden" name="picture"/>
                        </label>
                    </div>
            </div>







            <div>
              <label for="document" class="block text-sm font-medium text-gray-700">
                Fichiers (PDF, Jpeg, PNG, txt, Word ...)
              </label>
              <div class="flex bg-grey-lighter">
                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-gray-700 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-900">
                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                    </svg>
                    <span class="mt-2 text-base leading-normal select-none">Vos fichiers</span>
                    <input v-on:change="getFiles" type='file' class="hidden" name="document[]" multiple/>
                    <!--document[]-->
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="pt-8">
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Informations supplémentaires
          </h3>
          <p class="mt-1 text-sm text-gray-500">
            Ces informations seront communiqués au prestataire de votre projet.
          </p>
        </div>

          <section class="mb-6">


            <div class="flex justify-center">
                <div class="flex bg-grey-lighter" @click.prevent ="open = !open">
                  <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-gray-700 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-900">
                      <svg xmlns="http://www.w3.org/2000/svg" v-show="open" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" v-show="!open" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                      </svg>
                      <span class="mt-2 text-base leading-normal text-center select-none">Informations complémentaires</span>
                      <a href="#" ></a>
                  </label>
                </div>
            </div>


          <div v-show="open" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">


                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input v-model="project.phone" type="text" name="phone" id="phone" autocomplete="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div v-show="open" class="col-span-6 sm:col-span-6">
                    <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                    <select v-model="project.country" id="country" name="country" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Belgique</option>
                        <option>France</option>
                        <option>Luxembourg</option>
                    </select>
                </div>

            <div v-show="open" class="col-span-6">
                <label for="street" class="block text-sm font-medium text-gray-700">Rue</label>
                <input v-model="project.street" type="text" name="street" id="street" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div v-show="open" class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="number" class="block text-sm font-medium text-gray-700">Numéro</label>
                <input v-model="project.number" type="number" name="number" id="number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div v-show="open" class="col-span-6 sm:col-span-6 lg:col-span-2">
                <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                <input v-model="project.city" type="text" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div v-show="open" class="col-span-6 sm:col-span-3 lg:col-span-2">
                <label for="postalCode" class="block text-sm font-medium text-gray-700">Code postal</label>
                <input v-model="project.zipcode" type="text" name="postalCode" id="postalCode" autocomplete="postalCode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            </section>

        <div class="pt-8">
          <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Notifications
            </h3>
            <p class="mt-1 text-sm text-gray-500">
              Indiquez les notifications que vous souhaitez recevoir.
            </p>
          </div>
          <div class="mt-6">
            <fieldset>
              <legend class="text-base font-medium text-gray-900">
                Par Email
              </legend>
              <div class="mt-4 space-y-4">
                <div class="relative flex items-start">
                  <div class="flex items-center h-5">
                    <input v-model="project.notifications" id="notifications" name="notifications" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                  </div>
                  <div class="ml-3 text-sm">
                    <label for="notifications" class="font-medium text-gray-700">Offres de prix</label>
                    <p class="text-gray-500">Me notifier si je recois une offre de prix pour mon projet.</p>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <div class="sm:col-span-4 pt-6 pb-10">
            <label for="email" class="block text-sm font-medium text-gray-700">
              Les notifications seront envoyées sur votre adresse email
            </label>
            <div class="mt-1">
              <input id="email" name="email" type="email" class="shadow-sm w-full sm:text-sm border-gray-300 rounded-md " :value="user.email" readonly>
            </div>
          </div>

      </div>

      <div class="pt-8">
        <div>
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Conditions générales (Obligatoire)
          </h3>
        </div>
        <div class="mt-6">
          <fieldset>

          <div class="mt-4 space-y-4">
            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input v-model="project.rules" id="rules" name="rules" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" required>
              </div>
              <div class="ml-3 text-sm">
                <p class="text-gray-700">J'accepte les Conditions <a href="#">générales d’utilisation</a></p>
              </div>
            </div>
          </div>

          </fieldset>
        </div>
      </div>

      <div class="pt-8">
        <div class="flex justify-end">
          <a href="#" class="bg-white mt-4 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Annuler
          </a>
          <button type="submit" class="ml-8 inline-flex justify-center py-4 px-7 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-200 transform hover:-translate-y-1 hover:translate-x-0.5">
            Enregistrer le projet
          </button>
        </div>
      </div>
    </form>

        <div v-show="alert" id="alert" class="rounded-md bg-red-50 p-4 transition-opacity duration-500 ease-in-out">
        <div class="flex">
          <div class="flex-shrink-0">
            <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">
              Il y a {{ nbErrors }} erreur{{ (nbErrors > 0) ? 's' : ''}} à corriger dans le formulaire
            </h3>
            <div class="mt-2 text-sm text-red-700">
              <ul role="list" class="list-disc pl-5 space-y-1">

                  <li v-for="er in this.errors" :key=er>{{ er }}</li>

              </ul>
            </div>
          </div>
        </div>
      </div>

</template>


<script>
import { XCircleIcon } from '@heroicons/vue/solid'
import axios from 'axios'

export default {
  components: {
    XCircleIcon,
  },

    data(){
            const project = {
                user_id: '',
                category_id: '',
                sub_category_id: '',
                titleName: '',
                about: '',
                price: '',
                document: '',
                picture: '',
                phone: '',
                deadline: '',
                email: '',
                country: '',
                city: '',
                zipcode: '',
                number: '',
                street: '',
                notifications: '',
                rules: ''
            }

        return {
            categories: {},
            subcategories: {},
            user: {},
            categoryselected: '',
            subcategoryselected: '',
            open: false,
            project,
            validationErrors: '',
            errors: [],
            alert: false,
            nbErrors: 0,
        }
    },
      computed: {
    refresh() {
        this.alert = false;
        this.validationErrors = '';
        this.errors = [];
        this.nbErrors = 0;
    },
  },
    methods:{
        loadFormData() {
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
            axios.get("api/nouveau", config).then(({data}) => (this.categories = data[0], this.subcategories = data[1], this.user = data[2] )).catch(error => console.log('error', error));
        },
        subCategoryChange() {
            const config = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            }
            axios.get("api/subcategories/"+this.categoryselected, config).then(({data}) => (this.subcategories = data)).catch(error => console.log('error', error));
        },
        onChange(e) {
                this.picture = e.target.files[0];
                this.pictureName = e.target.files[0].name;
        },
        getFiles(e){
                this.document = e.target.files;
                //console.log(this.document);
        },
        formSubmit(e) {
                e.preventDefault();

                // Take all id and email
                this.project.user_id = this.user.id;
                this.project.category_id = this.categoryselected;
                this.project.sub_category_id = this.subcategoryselected;
                this.project.email = this.user.email;


                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }

                let data = new FormData();
                if(this.document != undefined){
                  for (let i = 0; i < this.document.length; i++) {
                      data.append('document[]', this.document[i], this.document[i].name);
                  }
                }
                //data.append('project', this.project);
                data.append('picture', this.picture);
                data.append('user_id', this.project.user_id);
                data.append('category_id', this.project.category_id);
                data.append('sub_category_id', this.project.sub_category_id);
                data.append('name', this.project.titleName);
                data.append('about', this.project.about);
                data.append('price', this.project.price);
                data.append('phone', this.project.phone);
                data.append('deadline', this.project.deadline);
                data.append('email', this.project.email);
                data.append('country', this.project.country);
                data.append('city', this.project.city);
                data.append('zipcode', this.project.zipcode);
                data.append('number', this.project.number);
                data.append('street', this.project.street);
                data.append('notifications', this.project.notifications);
                data.append('rules', this.project.rules);

                

                axios.post('api/store', data, config)
                    .then(function (res) {
                        console.log(res);
                    })
                    .catch(error => {
              if (error.response.status == 422){
              this.validationErrors = error.response.data.errors;
              //console.log(this.validationErrors);
              this.alert = true;

                for (const [key, value] of Object.entries(this.validationErrors)) {
                  this.errors.push(value);
                }
                  this.nbErrors = this.errors.length;
                  document.getElementById('alert').style.opacity = 100;
                  setTimeout(() => { 
                    //document.getElementById('alert').style.display = "flex";
                    document.getElementById('alert').style.opacity = 0;
                  }, 5000);

              }
                  setTimeout(() => {this.refresh();}, 5550);
            })
        },
    },
    created(){
        //console.log('created');
        this.loadFormData();
    }
}
</script>
