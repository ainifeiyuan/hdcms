import Vue from 'vue'
import Vuex from 'vuex'
import error from './error'
import user from './user'
import site from './site'
import module from './module'
import loading from './loading'
import access from './access'
Vue.use(Vuex)
let modules = { error, user, site, module, loading, access }
//VUEX入口
export default new Vuex.Store({ modules })