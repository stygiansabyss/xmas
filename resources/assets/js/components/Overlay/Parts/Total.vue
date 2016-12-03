<template>
  <div class="total" v-if="settings.total_display == 1">
    $<animated-number :value="total.raised_raw / 100"></animated-number>
  </div>
</template>
<style></style>
<script>
  import AnimatedNumber from './AnimatedNumber.vue';

  export default {
    data() {
      return {
        total:    app.total,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()

      Echo.channel('christmas')
          .listen('.App.Services.Donating.Events.TotalWasChanged', (e) =>
          {
            this.total = e.total
          })
    },

    components: {
      'animated-number': AnimatedNumber,
    }
  }
</script>
