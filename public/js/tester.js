$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var loading= false;
var isPushEnabled= false;
var pushButtonDisabled= true;
let notifications = [];
let total;

function RegisterServiceWorker() {
	if (!('serviceWorker' in navigator)) {
        console.log('Service workers aren\'t supported in this browser.')
        return
      }

      navigator.serviceWorker.register('/sw.js')
        .then(() => this.initialiseServiceWorker())
}

function initialiseServiceWorker () {
      if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported.')
        return
      }

      if (Notification.permission === 'denied') {
        console.log('The user has blocked notifications.')
        return
      }

      if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported.')
        return
      }
  }

  function subscribe () {
      navigator.serviceWorker.ready.then(registration => {
        const options = { userVisibleOnly: true }
        const vapidPublicKey = window.Laravel.vapidPublicKey

        if (vapidPublicKey) {
          options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
        }

        registration.pushManager.subscribe(options)
          .then(subscription => {
            this.isPushEnabled = true
            this.pushButtonDisabled = false

            this.updateSubscription(subscription)
          })
          .catch(e => {
            if (Notification.permission === 'denied') {
              console.log('Permission for Notifications was denied')
              this.pushButtonDisabled = true
            } else {
              console.log('Unable to subscribe to push.', e)
              this.pushButtonDisabled = false
            }
          })
      })
    }


    function unsubscribe () {
      navigator.serviceWorker.ready.then(registration => {
        registration.pushManager.getSubscription().then(subscription => {
          if (!subscription) {
            this.isPushEnabled = false
            this.pushButtonDisabled = false
            return
          }

          subscription.unsubscribe().then(() => {
            this.deleteSubscription(subscription)

            this.isPushEnabled = false
            this.pushButtonDisabled = false
          }).catch(e => {
            console.log('Unsubscription error: ', e)
            this.pushButtonDisabled = false
          })
        }).catch(e => {
          console.log('Error thrown while unsubscribing.', e)
        })
      })
    }

    function togglePush () {
      if (this.isPushEnabled) {
        this.unsubscribe()
      } else {
        this.subscribe()
      }
    }

    function updateSubscription (subscription) {
      const key = subscription.getKey('p256dh')
      const token = subscription.getKey('auth')
      const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

      const data = {
        endpoint: subscription.endpoint,
        publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        contentEncoding
      }

      this.loading = true

      $.post('/subscriptions', data)
        .then(() => { this.loading = false })
    }

    function deleteSubscription (subscription) {
      this.loading = true

      $.post('/subscriptions/delete', { endpoint: subscription.endpoint })
        .then(() => { this.loading = false })
    }

    function sendNotification () {
      this.loading = true

      $.post('/notifications')
        .catch(error => console.log(error))
        .then(() => { this.loading = false })
    }

    /**
     * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
     *
     * @param  {String} base64String
     * @return {Uint8Array}
     */
    function urlBase64ToUint8Array (base64String) {
      const padding = '='.repeat((4 - base64String.length % 4) % 4)
      const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/')

      const rawData = window.atob(base64)
      const outputArray = new Uint8Array(rawData.length)

      for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i)
      }

      return outputArray
    }

    function fetch (limit) {
      $.get('/notifications', { params: limit  },function (data) {
          console.log(limit);
          this.notifications = data.notifications.map(({ id, data, created }) => {
            return {
              id: id,
              title: data.title,
              body: data.body,
              created: created,
              action_url: data.action_url
            }
          })
          var content = '';
          $.each(this.notifications,function (key,value) {
              content += '<a class="content">'
              content += '<div class ="notification-item">'
              content +=  '<h4 class="item-title">'+value.title+'</h4>'
              content += '<p class="item-info">'+value.body+'</p>'
              content += '</div>'
              content += '</a>'
              console.log(value);
          })
          $('.notifications-wrapper').html(content);
      })
        // .then(({ data: { total, notifications } }) => {
        //   this.total = total
        //   this.notifications = notifications.map(({ id, data, created }) => {
        //     return {
        //       id: id,
        //       title: data.title,
        //       body: data.body,
        //       created: created,
        //       action_url: data.action_url
        //     }
        //   })
        //   console.log(this.notifications);
        // })
    }

$(document).ready(function () {
    RegisterServiceWorker()
    subscribe();
    fetch(5);
    //console.log(fetch());
    $('#notif').on('click',function () {
    	sendNotification();
    })

    $('#acc').on('click',function () {
    	togglePush();
    })
})