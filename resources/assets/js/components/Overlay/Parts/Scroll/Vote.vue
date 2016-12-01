<template>
  <div>
    <div v-show="this.settings.scroll_speed != '0'">
      <div class="text-marquee">
        Donate now with the words {{ vote.options_readable }} to vote!
      </div>
    </div>
    <div v-show="this.settings.scroll_speed == '0'">
      <div class="text-center">
        Donate now with the words {{ vote.options_readable }} to vote!
      </div>
    </div>
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
      this.setMarquee()

      _settingsEcho.bind(this)(function (self, e)
      {
        if (self.settings.scroll_mode === 'text') {
          self.setMarquee();
        }
      })
      _christmasEcho.bind(this)('Voting', 'VoteWasUpdated', 'vote')
    },

    methods: {
      setMarquee() {
        var jqEl = $('.text-marquee')

        if (jqEl.data('_simplemarquee')) {
          var instance            = jqEl.data('_simplemarquee')
          instance._options.speed = this.settings.scroll_speed
          instance.update(false)
        } else {
          jqEl.simplemarquee({
            speed:              this.settings.scroll_speed,
            delayBetweenCycles: 0,
            cycles:             'infinity',
          }).simplemarquee('update')
        }
      },
    }
  }
</script>
