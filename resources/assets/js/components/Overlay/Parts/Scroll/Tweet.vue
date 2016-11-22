<template>
  <div class="tweets" id="tweets" :class="settings.scroll_speed" v-transition="fade">
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
      Echo.channel('christmas')
        .listen('.App.Services.Administrating.Events.SettingChanged', (e) => {
            Vue.set(this.settings, e.setting.name, e.setting.value);
            if (this.settings.scroll_mode == 'twitter')
            {
              this.setTweets();
            }

            if (this.settings.scroll_mode == 'donations')
            {
              this.setDonations();
            }
        });

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
        });

        this.getTweets();
      }
    }
  }
</script>
