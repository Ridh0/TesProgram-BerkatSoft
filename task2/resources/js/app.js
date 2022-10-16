import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'
const app = createApp(App)

app.use(router)

app.mount('#app')
//create router
