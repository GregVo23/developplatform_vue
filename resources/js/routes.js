import { createRouter, createWebHistory } from 'vue-router';

import HomePage from './pages/HomePage.vue';
import Message from './pages/Message.vue';
import Index from './pages/project/Index.vue';
import Create from './pages/project/Create.vue';
import Show from './pages/project/Show.vue';
import Favorite from './pages/Favorite.vue';
import Offer from './pages/project/Offer.vue';
import Search from './pages/project/Search.vue';
import Profil from './pages/Profil.vue';
import Subscription from './pages/Subscription.vue';
import MyProjects from './pages/project/MyProjects.vue';
//import NotFound from './pages/NotFound.vue';

import axios from 'axios'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/dashboard', redirect: '/accueil' },
        { path: '/accueil', component: HomePage },
        { path: '/message', component: Message },
        { path: '/projets', component: Index },
        { path: '/demandes', component: MyProjects },
        { path: '/projet/:id', component: Show },
        { path: '/nouveau', component: Create },
        { path: '/favoris', component: Favorite },
        { path: '/offres', component: Offer },
        { path: '/rechercher', component: Search },
        { path: '/profil', component: Profil },
        { path: '/abonnement', component: Subscription },
        { path: '/*', redirect: '/dashboard' },
        //{ path: '/*', component: NotFound },
        
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

