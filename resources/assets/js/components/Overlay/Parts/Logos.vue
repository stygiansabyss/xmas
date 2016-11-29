<template>
  <div class="logo"
       v-if="settings.goal_mode == 'logos'"
       transition="fade"
  >
    <img v-for="logo in logos" :src="logo.path" />
  </div>
</template>
<style>
  .logo img {
    width: 100%;
  }
</style>
<script>
  export default {
    data() {
      return {
        logos:    app.logos,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
    },
  }
</script>
