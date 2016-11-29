<template>
  <div class="plain-text" :class="settings.scroll_speed" transition="fade" style="margin-top: -4px;">
    Donate now with the words {{ vote.options_readable }} to vote!
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        vote:     app.vote,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
      _christmasEcho.bind(this)('Voting', 'VoteWasUpdated', 'vote')
    }
  }
</script>
