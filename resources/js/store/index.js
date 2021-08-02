import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import core from './modules/core'

Vue.use(Vuex)
axios.defaults.headers['Content-Type'] = 'application/json'
axios.defaults.headers.Accept = 'application/json'
axios.defaults.baseURL = process.env.NODE_ENV !== 'production' ? 'http://127.0.0.1:8000/api/v1' : 'https://subscriba.herokuapp.com/api/v1'
export const store = new Vuex.Store({
    modules: {
        core
    }
})