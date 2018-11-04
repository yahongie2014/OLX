
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
Vue.prototype.$eventHub = new Vue()

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
import router from './routes'
import store from './store'
import Datatable from 'vue2-datatable-component'
import VueAWN from 'vue-awesome-notifications'
import vSelect from 'vue-select'
import datePicker from 'vue-bootstrap-datetimepicker'
import VueSweetalert2 from 'vue-sweetalert2'
import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'

Vue.use(Datatable)
Vue.use(VueAWN, {
    position: 'top-right'
})
Vue.use(datePicker)
Vue.use(VueSweetalert2)

Vue.component('back-buttton', require('./components/BackButton.vue'))
Vue.component('bootstrap-alert', require('./components/Alert.vue'))
Vue.component('event-hub', require('./components/EventHub.vue'))
Vue.component('vue-button-spinner', require('./components/VueButtonSpinner.vue'))
Vue.component('v-select', vSelect)

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {});
        }
    }
});
