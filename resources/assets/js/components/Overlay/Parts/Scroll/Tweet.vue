<template>
  <div class="text-marquee">
    <div>
      <div v-for="tweet in tweets">
        {{ tweet.text }} ~@{{ tweet.name }}
        <span><i class="fa fa-twitter text-twitter"></i></span>
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
        tweets:   app.tweets,
        settings: app.settings,
        cycle:    0,
      }
    },
    ready() {
      if (this.settings.scroll_mode == 'twitter') {
        this.setTweets()
      }

      setTimeout(() =>
      {
        this.setMarquee()
      }, 500)

      Echo.channel('christmas')
          .listen('.App.Services.Administrating.Events.SettingChanged', (e) =>
          {
            let originalSetting = this.settings.scroll_mode

            Vue.set(this.settings, e.setting.name, e.setting.value)

            if (originalSetting != 'twitter'
                && this.settings.scroll_mode == 'twitter') {
              this.setTweets()

              setTimeout(() =>
              {
                this.setMarquee()
              }, 500)
            }
          })
    },
    methods: {
      setMarquee() {
        let jqEl = $('.text-marquee')

        if (jqEl.data('_simplemarquee')) {
          var instance            = jqEl.data('_simplemarquee')
          instance._options.speed = this.settings.scroll_speed
          instance.update(false)
        } else {
          jqEl.bind('cycle', () =>
          {
            if (this.cycle == 2) {
              this.setTweets()
            }

            if (this.cycle != 2) {
              this.cycle = this.cycle + 1
            }
          })

          jqEl.simplemarquee({
            speed:              this.settings.scroll_speed,
            delayBetweenCycles: 0,
            cycles:             'infinity',
            space:              1189,
          }).simplemarquee('update')
        }
      },
      setTweets() {
        this.$http.get('/tweet/overlay')
            .then((data) =>
            {
              this.$set('tweets', data.body)
            })
      },
    }
  }
</script>
