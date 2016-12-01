<template>
  <div>
    <div v-show="this.settings.scroll_speed != '0'">
      <div class="text-marquee">
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
        if (self.settings.scroll_mode === 'text') {
          self.setMarquee();
        }
      })
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
