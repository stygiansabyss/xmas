<template>
  <div class="tweets" id="tweets" :class="settings.scroll_speed" transition="fade">
    <div v-for="tweet in tweets" id="{{ tweet.id }}">
      {{ tweet.text }} ~@{{ tweet.name }}
      <span><i class="fa fa-twitter text-twitter"></i></span>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        tweets:   app.tweets,
        settings: app.settings,
      }
    },
    ready: function() {
      this.setTweets();
      _settingsEcho.bind(this)(function (self, e)
      {
        if(self.settings.scroll_mode === 'twitter')
        {
            self.setTweets();
        }
      })
    },
    methods: {
      getTweets() {
        self = this;

        $('#tweets').bind('animationend webkitAnimationEnd', function ()
        {

          $('#tweets').removeClass(self.settings.scroll_speed).hide();

          setTimeout(function ()
          {
            $('#tweets').show().addClass(self.settings.scroll_speed);
          }, 1);

          self.setTweets();
        });
      },
      setTweets() {
        this.$http.get('/tweets/overlay', function (data, status, request)
        {
          this.$set('tweets', data);
          this.setMarquee();
        });

        this.getTweets();
      },
      setMarquee() {
        var jqEl = $('.text-marquee');
        if(jqEl.data('_simplemarquee')) {
            var instance = jqEl.data('_simplemarquee');
            instance._options.speed = this.settings.scroll_speed;
            instance._setupAnimation();
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
