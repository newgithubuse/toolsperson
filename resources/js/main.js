require('./bootstrap')
import Vue from 'vue'
import Cookies from 'js-cookie'
import VueRouter from 'vue-router'
import App from './layouts/App.vue'
import routes from './routes.js'
import store from './store/index.js'
import 'normalize.css'
import ElementUi from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import moment from 'moment'
import VeeValidate from 'vee-validate'

moment.locale('zh-tw')

Vue.use(VeeValidate)
Vue.use(VueRouter)
Vue.use(ElementUi)
Vue.directive('scroll', {
    bind: function(el, binding) {
        window.addEventListener('scroll', () => {
            let fnc = binding.value
            fnc(el)
        })
    }
})

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    let loginstatus = window.localStorage.getItem('loginstatus')
    console.log('loginstatus : ' + loginstatus)
    if (loginstatus) {
        next()
    } else {
        if (to.meta.requireAuth) {
            next()
        } else {
            next('/login')
        }
    }
})

const app = new Vue({
    el: '#app',
    router,
    store,
    mounted() {
        this.$store.dispatch('CONTENTS_READ')
    },
    render: h => h(App)
})