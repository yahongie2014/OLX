importScripts('https://www.gstatic.com/firebasejs/4.6.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.6.2/firebase-messaging.js')

var config = {
    apiKey: "AIzaSyAo6xNZ6cxf1UhK7hd6pis-bpx5yR_gKg0",
    authDomain: "delivery-51579.firebaseapp.com",
    databaseURL: "https://delivery-51579.firebaseio.com",
    projectId: "delivery-51579",
    storageBucket: "",
    messagingSenderId: "471408711217"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload){
    // console.log('onMessage',payload);
    // console.log(payload.notification.body);
    const title = payload.notification.title;
    const options = {
        body : payload.notification.body,
        icon : '/dist/img/logo.png',
        data : payload.notification.click_action
    }

    return self.registration.showNotification(title,options);
})

