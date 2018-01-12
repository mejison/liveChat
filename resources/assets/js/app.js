
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).fromNow();
  }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

let token =  localStorage.getItem('_token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}


const app = new Vue({
    el: '#app',
    data: {
        messages: []
    },
    created() {
        let mainData = this;

        mainData.getAllMessages((response) => {
            mainData.messages = response.data;
            mainData.scrollToBottom();
        });

        Echo.channel('chatroom')
            .listen('MessagePosted', (e) => {
                mainData.messages.push({
                    message: e.message.message,
                    user: e.user,
                    attach : e.message.attach ? e.message.attach : "",
                    is_code : e.message.is_code ? true : false,
                    created_at : e.message.created_at
                });
                mainData.scrollToBottom();
            });
    },
    methods : {
        getAllMessages(callback) {
            axios.get('/api/messages').then(callback);
        },
        addMessage(message) {
            let mainData = this;
            mainData.messages.push(message);
            axios.post('/api/messages', message).then((res) => {
                mainData.scrollToBottom();
            });
        },
        scrollToBottom() {
            let elm = document.getElementsByClassName("messages-body")[0];
            if (elm) {
                setTimeout(function(){
                    elm.scrollTop = elm.scrollHeight;
                }, 0);
            }
        },
    }
});