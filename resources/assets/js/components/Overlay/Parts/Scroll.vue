<template>
  <div class="scroll" v-transition="marquee">
    <scroll-text v-if="settings.scroll_mode === 'text'"></scroll-text>
    <scroll-raffle v-if="settings.scroll_mode === 'raffle'"></scroll-raffle>
    <scroll-vote v-if="settings.scroll_mode === 'vote'"></scroll-vote>
    <scroll-incentive v-if="settings.scroll_mode === 'incentive'"></scroll-incentive>
    <scroll-tweet v-if="settings.scroll_mode === 'twitter'"></scroll-tweet>
    <scroll-donation v-if="settings.scroll_mode === 'donations'"></scroll-donation>
  </div>
</template>
<style></style>
<script>
  import ScrollText from './Scroll/Text.vue'
  import ScrollRaffle from './Scroll/Raffle.vue'
  import ScrollVote from './Scroll/Vote.vue'
  import ScrollIncentive from './Scroll/Incentive.vue'
  import ScrollTweet from './Scroll/Tweet.vue'
  import ScrollDonation from './Scroll/Donation.vue'

  export default {
    data() {
      return {
        settings: app.settings,
      }
    },

    components: {
      'scroll-text':      ScrollText,
      'scroll-raffle':    ScrollRaffle,
      'scroll-vote':      ScrollVote,
      'scroll-incentive': ScrollIncentive,
      'scroll-tweet':     ScrollTweet,
      'scroll-donation':  ScrollDonation,
    }
  }
</script>
