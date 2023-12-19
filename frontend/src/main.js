import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'

import custom_axios from "@/plugins/axios";
//import axios from 'axios'
import VueAxios from "vue-axios";
import Router from './plugins/router';

//Vue.config.productionTip = false

const app = createApp(App)
app.use(VueAxios, custom_axios)
app.use(vuetify)
app.use(Router)
app.mount('#app')

