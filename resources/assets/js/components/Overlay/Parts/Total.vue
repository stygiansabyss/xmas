<template>
  <div class="total" v-if="settings.total_display == 1">${{ total.raised }}</div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        total: app.total,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
      _christmasEcho.bind(this)('Donating', 'TotalWasChanged', 'total')
    }
  }
</script>
