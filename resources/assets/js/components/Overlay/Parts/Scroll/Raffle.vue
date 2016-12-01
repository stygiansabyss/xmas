<template>
  <div v-if="raffle != null" transition="fade">
    <div v-show="settings.scroll_speed != '0'">
      <div class="text-marquee text-center">
        <div v-for="tier in raffle.tiers">
          Donate more than {{ tier.minimum }} for a chance to win {{ tier.reward }}
          <span><i class="fa fa-tree"></i></span>
        </div>
      </div>
    </div>
    <div v-show="settings.scroll_speed == '0'">
      <div>
        <div class="text-center">
          <div v-for="tier in raffle.tiers">
            Donate more than {{ tier.minimum }} for a chance to win {{ tier.reward }}
            <span><i class="fa fa-tree"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  .text-marquee div div {
    display: inline-block;
  }
</style>
<script>
  export default {
    data() {
      return {
        raffle:   app.raffle,
        settings: app.settings,
      }
    },

    ready() {
      this.setMarquee();
      _settingsEcho.bind(this)(function (self, e)
      {
        self.getRaffle()
        self.setMarquee()
      })
      _christmasEcho.bind(this)('Raffling', 'RaffleEntryAdded', 'raffle')
    },

    methods: {
      setMarquee() {
        if (this.settings.scroll_mode != 'raffle') {
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

      getRaffle() {
        if (this.raffle != null) {
          return true
        }

        this.$http.get('/raffle/overlay')
            .then((data) =>
            {
              this.raffle = data.body
            })
      }
    }
  }
</script>
