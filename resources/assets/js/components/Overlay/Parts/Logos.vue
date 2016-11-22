<template>
  <div class="logo"
       v-if="settings.goal_mode == 'logos'"
       v-transition="fade"
  >
    <img src="/img/charity/Oxfam.png" />
    <img src="/img/charity/CancerResearch.png" />
    <img src="/img/charity/MentalHealth.png" />
    <img src="/img/charity/SpecialEffect.png" />
    <img src="/img/charity/MSF.png" />
    <img src="/img/charity/GamesAid.png" />
    <img src="/img/charity/Fauna.png" />
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
    ready: function() {
      _settingsEcho.bind(this)();
    }
  }
</script>
