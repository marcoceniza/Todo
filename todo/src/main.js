import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import axios from 'axios';

const app = createApp(App)

const api = axios.create({
    baseURL: import.meta.env.VITE_API_URL, // Use the environment variable set in .env
    // Other axios configuration options...
  });

export default api;

app.use(createPinia())
app.use(router)

app.mount('#app')
