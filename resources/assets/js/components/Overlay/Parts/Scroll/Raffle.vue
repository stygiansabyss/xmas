<template>
  <div class="plain-text" :class="settings.scroll_speed" v-transition="fade" style="margin-top: 4px;">
    <div v-for="tier in raffle.tiers">
      Donate more than {{ tier.minimum }} for a chance to win {{ tier.reward }}
      <span><i class="fa fa-tree"></i></span>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        raffle:   app.raffle,
        settings: app.settings,
      }
    }
  }
</script>
