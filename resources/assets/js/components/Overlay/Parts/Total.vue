<template>
  <div class="total" v-if="settings.total_display == 1">
    ${{ total.raised }}
  </div>
</template>
<style></style>
<script>
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
    }
  }
</script>
