import { createRouter, createWebHistory } from 'vue-router';

import HomePage from './pages/HomePage.vue';
import Message from './pages/Message.vue';
import Projects from './pages/project/Projects.vue';
import CreateProject from './pages/project/CreateProject.vue';
import Favorite from './pages/Favorite.vue';
import Offer from './pages/project/Offer.vue';
import Search from './pages/project/Search.vue';
import Profil from './pages/Profil.vue';


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/dashboard', redirect: '/home' },
        { path: '/home', component: HomePage },
        { path: '/message', component: Message },
        { path: '/projets', component: Projects },
        { path: '/nouveau', component: CreateProject },
        { path: '/favoris', component: Favorite },
        { path: '/offres', component: Offer },
        { path: '/rechercher', component: Search },
        { path: '/profil', component: Profil },
    ]
  });

  router.beforeEach((to, from, next) => {
      console.log(to, from);
      next();
  });

  export default router;

