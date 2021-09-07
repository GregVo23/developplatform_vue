import { createApp } from 'vue';

import routes from './routes.js';
import App from './App.vue';
import Pagination from './components/Pagination.vue';

const app = createApp(App);
app.component('pagination', Pagination);
app.use(routes);
app.mount('#app');
