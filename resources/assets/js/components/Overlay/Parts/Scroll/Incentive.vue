<template>
  <div v-show="incentive != null" transition="fade">
    <div v-show="settings.scroll_speed != '0'">
      <div class="text-marquee text-center">
        {{ incentive.reward }}: {{ incentive.count }} / {{ incentive.target }}
      </div>
    </div>
    <div v-show="settings.scroll_speed == '0'">
      <div class="text-center">
        {{ incentive.reward }}: {{ incentive.count }} / {{ incentive.target }}
      </div>
    </div>
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

    ready() {
      this.setMarquee()

      _settingsEcho.bind(this)(function (self, e)
      {
          self.getIncentive()
          self.setMarquee();
      })

      _christmasEcho.bind(this)('Incentivizing', 'IncentiveWasUpdated', 'incentive')
    },

    methods: {
      setMarquee() {
        if (this.settings.scroll_mode != 'incentive') {
          return true
        }

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

      getIncentive() {
        if (this.incentive != null) {
          return true
        }

        this.$http.get('/incentive/overlay')
            .then((data) =>
            {
              this.incentive = data.body
            })
      }
    }
  }
</script>
