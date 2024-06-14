import './bootstrap';
import { createApp } from 'vue';
import ZohoForm from './components/ZohoForm.vue';

const app = createApp({});
app.component('zoho-form', ZohoForm);
app.mount('#app');
