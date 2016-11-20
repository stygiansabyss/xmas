<div class="full" id="vue">
  <div class="stream">&nbsp;</div>
  <div class="scroll" v-transition="marquee">
    <div class="plain-text"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'text'"
    >
      @{{ settings.scroll_text }}
    </div>
    <div class="plain-text"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'raffle'"
         style="margin-top: 4px;"
    >
      <div v-repeat="tier: raffle.tiers">
        Donate more than @{{ tier.minimum }} for a chance to win @{{ tier.reward }}
        <span>
          <i class="fa fa-tree"></i>
        </span>
      </div>
    </div>
    <div class="plain-text"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'vote'"
         style="margin-top: -4px;"
    >
      Donate now with a the words @{{ vote.options_readable }} to vote!
    </div>
    <div class="incentive"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'incentive'"
         style="margin-top: -4px;"
    >
      @{{ incentive.reward }}: @{{ incentive.count }} / @{{ incentive.target  }}
    </div>
    <div class="tweets"
         id="tweets"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'twitter'"
    >
      <div v-repeat="tweet: tweets" id="@{{ tweet.id }}">
        @{{ tweet.text }} ~@@{{ tweet.name }}
        <span>
          <i class="fa fa-twitter text-twitter"></i>
        </span>
      </div>
    </div>
    <div class="tweets"
         id="donations"
         v-class="settings.scroll_speed"
         v-transition="fade"
         v-if="settings.scroll_mode == 'donations'"
    >
      <div v-repeat="donation: donations">
        @{{ donation.comment }} ~<span style="color: #54515b;">@{{ donation.name }}</span>
        <span>
          <i class="fa fa-tree"></i>
        </span>
      </div>
    </div>
  </div>
</div>


@section('js')
  <script>
    Vue.transition('fade', {
      enter: function (el, done) {
        $(el).css('opacity', 0);
        if (vueModel.order == 'leave') {
          setTimeout(function () {
            $(el).animate({opacity: 1}, 2000);
          }, 2000);
        } else {
          vueModel.$set('order', 'enter');
          $(el).animate({opacity: 1}, 2000);
        }
        done();
      },
      leave: function (el, done) {
        if (vueModel.order == 'enter') {
          setTimeout(function () {
            $(el).animate({display: 'none'}, 2000);
          }, 2000);
        } else {
          vueModel.$set('order', 'leave');
          $(el).animate({display: 'none'}, 2000);
        }
        done();
      },
    });

    var vueModel = new Vue({
      el: '#vue',

      data: {
        settings: window.settings,
        tweets: [],
        donations: [],
        incentive: window.incentive,
        raffle: window.raffle,
        vote: window.vote,
        order: null,
      },

      ready: function () {
        self = this;

        var socket = io('{!! config('app.url') !!}:3000');

        if (self.settings.scroll_mode == 'twitter') {
          self.setTweets();
        }
        if (self.settings.scroll_mode == 'donations') {
          self.setDonations();
        }

        socket.on('christmas:App\\Events\\ChristmasSettingChanged', function (message) {
          self.settings.$set(message.setting.keyName, message.setting.value);

          if (self.settings.scroll_mode == 'twitter') {
            self.setTweets();
          }
          if (self.settings.scroll_mode == 'donations') {
            self.setDonations();
          }
        });

        socket.on('christmas:App\\Events\\DonationReceived', function (message) {
          self.donations.push(message.donation);
        });

        socket.on('christmas:App\\Events\\IncentiveWasUpdated', function (message) {
          self.$set('incentive', message.incentive);
        });

        socket.on('christmas:App\\Events\\RaffleEntryAdded', function (message) {
          self.$set('raffle', message.raffle);
        });

        socket.on('christmas:App\\Events\\VoteWasUpdated', function (message) {
          self.$set('vote', message.vote);
        });
      },

      methods: {
        getTweets: function () {
          self = this;

          $('#tweets').bind('animationend webkitAnimationEnd', function () {

            $('#tweets').removeClass(self.settings.scroll_speed).hide();

            setTimeout(function () {
              $('#tweets').show().addClass(self.settings.scroll_speed);
            }, 1);

            self.setTweets();
          });
        },
        setTweets: function () {
          this.$http.get('/christmas/get-tweets', function (data, status, request) {
            this.$set('tweets', data);
          });

          this.getTweets();
        },
        getDonations: function () {
          self = this;

          $('#donations').bind('animationend webkitAnimationEnd', function () {

            $('#donations').removeClass(self.settings.scroll_speed);

            setTimeout(function () {
              $('#donations').addClass(self.settings.scroll_speed);
            }, 1);

            self.setDonations();
          });
        },
        setDonations: function () {
          this.$http.get('/christmas/get-donations', function (data, status, request) {
            this.$set('donations', data);
          });

          this.getDonations();
        },
      }
    });
  </script>
@endsection
