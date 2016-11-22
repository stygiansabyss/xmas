/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')
require('./global')
require('./delete-link')
require('./transitions')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

import Manage from './components/Manage.vue'
import OverlayAll from './components/Overlay/All.vue'
import OverlayBottom from './components/Overlay/Bottom.vue'
import OverlayHorizontal from './components/Overlay/Horizontal.vue'
import OverlayRight from './components/Overlay/Right.vue'
import OverlayTotal from './components/Overlay/Total.vue'
import OverlayVertical from './components/Overlay/Vertical.vue'

var app = new Vue({
  el: 'body',

  ready() {
    if (Laravel.userId !== null) {
      Echo.private('App.Models.User.' + Laravel.userId)
          .notification((notification) =>
          {
            $.notify({
              message: notification.message,
              icon:    notification.icon
            }, {
              // settings
              type: notification.level
            })
          })
    }
  },

  components: {
    'manage-dashboard':   Manage,
    'overlay-all':        OverlayAll,
    'overlay-bottom':     OverlayBottom,
    'overlay-horizontal': OverlayHorizontal,
    'overlay-right':      OverlayRight,
    'overlay-total':      OverlayTotal,
    'overlay-vertical':   OverlayVertical,
  }
});
