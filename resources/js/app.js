import './bootstrap'
import Vue from 'vue'

import NotificationDemo from './components/NotificationDemo'
import NotificationComponent from './components/NotificationComponent'
import NotificationDropdown from './components/NotificationDropdown'

/* eslint-disable-next-line no-new */
new Vue({
  el: '#app',
  components: {
    NotificationDemo,
    NotificationDropdown,
    NotificationComponent,
  }
})
