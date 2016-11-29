<template>
  <div class="logo"
       v-if="settings.goal_mode == 'logos'"
       transition="fade"
  >
    <img src="/img/overlay/Charities/Oxfam.png" />
    <img src="/img/overlay/Charities/CancerResearch.png" />
    <img src="/img/overlay/Charities/MentalHealth.png" />
    <img src="/img/overlay/Charities/SpecialEffect.png" />
    <img src="/img/overlay/Charities/MSF.png" />
    <img src="/img/overlay/Charities/GamesAid.png" />
    <img src="/img/overlay/Charities/Fauna.png" />
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
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
    },
  }
</script>
