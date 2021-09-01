import { createApp } from 'vue';

import routes from './routes.js';
import App from './App.vue';
import Pagination from './components/Pagination.vue';
//import Notification from './components/Notification.vue';

const app = createApp(App);
//app.component('notification', require('./components/Notification.vue').default);
//app.component('notification', Notification);
app.component('pagination', Pagination);
app.use(routes);
app.mount('#app');
