<template>
  <div class="plain-text" :class="settings.scroll_speed" v-transition="fade">
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
    }
  }
</script>
