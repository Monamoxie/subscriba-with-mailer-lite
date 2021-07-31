import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import { store } from './store/index'
import Main from './Main'
import vueCountryRegionSelect from 'vue-country-region-select'
import { ValidationObserver, ValidationProvider, extend, localize, setInteractionMode } from 'vee-validate'
import en from 'vee-validate/dist/locale/en.json'
import * as rules from 'vee-validate/dist/rules'
import { VueSpinners } from '@saeris/vue-spinners'

Vue.config.productionTip = false
Vue.use(VueRouter)
Vue.use(vueCountryRegionSelect)
Vue.component('ValidationObserver', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)
// setInteractionMode('lazy')
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule])
})
Vue.use(VueSpinners)

const router = new VueRouter({
    routes,
    store,
    mode: 'history'
})

new Vue({
    render: h => h(Main),
    router,
    store,
}).$mount('#app')

require('./bootstrap');
