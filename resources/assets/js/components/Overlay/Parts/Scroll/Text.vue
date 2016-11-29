<template>
  <div class="plain-text" :class="settings.scroll_speed" transition="fade">
    {{ settings.scroll_text }}
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
    },
  }
</script>
