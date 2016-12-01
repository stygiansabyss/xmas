<template>
  <div>
    <div v-show="this.settings.scroll_speed != '0'">
      <div class="text-marquee text-center">
        {{ settings.scroll_text }}
      </div>
    </div>
    <div v-show="this.settings.scroll_speed == '0'">
      <div class="text-center">
        {{ settings.scroll_text }}
      </div>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        settings: app.settings,
      }
    },

    ready() {
      this.setMarquee()

      _settingsEcho.bind(this)(function (self, e)
      {
        self.setMarquee()
      })
    },

    methods: {
      setMarquee() {
        $('.text-marquee')
                .simplemarquee('destroy')
                .simplemarquee({
                  speed:              this.settings.scroll_speed,
                  delayBetweenCycles: 0,
                  cycles:             'infinity',
                }).simplemarquee('update')
      },
    }
  }
</script>
