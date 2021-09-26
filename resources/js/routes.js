import { createRouter, createWebHistory } from 'vue-router';

import HomePage from './pages/HomePage.vue';
import Index from './pages/project/Index.vue';
import Create from './pages/project/Create.vue';
import Show from './pages/project/Show.vue';
import Favorite from './pages/Favorite.vue';
import Offer from './pages/project/Offer.vue';
import Profil from './pages/Profil.vue';
import Subscription from './pages/Subscription.vue';
import MyProjects from './pages/project/MyProjects.vue';

import axios from 'axios'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', redirect: '/accueil' },
        { path: '/dashboard', redirect: '/accueil' },
        { path: '/accueil', name: 'accueil', component: HomePage },
        { path: '/projets', name: 'projets', component: Index },
        { path: '/demandes', name: 'demandes', component: MyProjects },
        { path: '/projet/:id', name: 'projet', component: Show },
        { path: '/nouveau', name: 'nouveau', component: Create },
        { path: '/favoris', name: 'favoris', component: Favorite },
        { path: '/offres', name: 'offres', component: Offer },
        { path: '/profil', name: 'profil', component: Profil },
        { path: '/abonnement', name: 'abonnement', component: Subscription },
        { path: '/*', redirect: '/dashboard' },
        
    ]
  });

  router.beforeEach((to, from, next) => {
      //console.log(to.query.session_id, from);
      if(to.query.session_id != undefined){
        let session = to.query.session_id;
        console.log(session);
        console.log(session.session_id);

        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }

        let data = new FormData();
        data.append('session', session);

        axios.post('api/abonnement', data, config)
        .then(function (res) {
            console.log(res);
        })
        .catch(error => {})
      }
      next();
  });

  export default router;

