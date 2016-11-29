<template>
  <div class="incentive" :class="settings.scroll_speed" transition="fade" style="margin-top: -4px;">
    {{ incentive.reward }}: {{ incentive.count }} / {{ incentive.target }}
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        incentive: app.incentive,
        settings:  app.settings,
      }
    },
    ready: function() {
      _settingsEcho.bind(this)();
      _christmasEcho.bind(this)('Donating', 'IncentiveWasUpdated', 'incentive');
    }
  }
</script>
