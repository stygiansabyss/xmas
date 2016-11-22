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
