import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import './assets/tailwind.css'
import axios from 'axios'
import VueAxios from 'vue-axios'
import {FontAwesomeIcon} from './plugins/font-awesome'
import {date, time, datetime} from './services/global';

createApp(App)
    .component('fa', FontAwesomeIcon)
    .use(router)
    .use(VueAxios, axios)
    .mixin({
        methods: {
            date,
            time,
            datetime
        }
    }).mount('#app')
