<div class="full" id="vue">
  <div class="stream">&nbsp;</div>
  <div class="logo"
       v-if="settings.goal_mode == 'logos'"
       v-transition="fade"
  >
    <img src="/img/charity/Oxfam.png" style="width: 100px;" />
    <img src="/img/charity/CancerResearch.png" style="width: 100px;" />
    <img src="/img/charity/MentalHealth.png" style="width: 100px;" />
    <img src="/img/charity/SpecialEffect.png" style="width: 100px;" />
    <img src="/img/charity/MSF.png" style="width: 100px;" />
    <img src="/img/charity/GamesAid.png" style="width: 100px;" />
    <img src="/img/charity/Fauna.png" style="width: 100px;" />
  </div>
  <div class="goal"
       v-if="settings.goal_mode == 'goal' && goal != null"
       v-transition="fade"
  >
    <div class="goal-target">
      <div class="goal-total">$@{{ goal.goal }}</div>
    </div>
    <div class="goal-bar">
      <div class="goal-percent">@{{ goal.percent }}%</div>
      <div class="goal-progress" v-class="reached: goal.percent >= 100" style="height: calc(@{{ goal.percent }}% - 9px);"></div>
    </div>
  </div>
  <div class="vote"
       v-if="settings.goal_mode == 'vote' && vote != null"
       v-transition="fade"
  >
    <div class="vote-question">
      <div class="vote-text">@{{ vote.name }}</div>
    </div>
    <div class="vote-bar">
      <div class="vote-chunk" v-repeat="option: vote.options" v-show="option.votes > 0" style="height: @{{ option.percent }}%;">
        <div class="vote-percent clearfix">@{{ option.percent_overlay }}</div>
        <div class="vote-progress"></div>
      </div>
    </div>
  </div>

  <div class="total" v-if="settings.total_display == 1">$@{{ total.raised }}</div>
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
        goal: window.goal,
        total: window.total,
        vote: window.vote,
        order: null,
      },

      ready: function () {
        self = this;

        var socket = io('{!! config('app.url') !!}:3000');

        socket.on('christmas:App\\Events\\ChristmasSettingChanged', function (message) {
          self.settings.$set(message.setting.keyName, message.setting.value);

          if (self.settings.scroll_mode == 'twitter') {
            self.setTweets();
          }
          if (self.settings.scroll_mode == 'donations') {
            self.setDonations();
          }
        });

        socket.on('christmas:App\\Events\\TotalWasChanged', function (message) {
          self.$set('total', message.total);
        });

        socket.on('christmas:App\\Events\\GoalWasUpdated', function (message) {
          self.$set('goal', message.goal);
        });

        socket.on('christmas:App\\Events\\VoteWasUpdated', function (message) {
          self.$set('vote', message.vote);
        });

        self.checkVoteBar();
      },

      methods: {
        checkVoteBar: function () {
          if (this.settings.goal_mode == 'vote') {
            var barHeight = $('.vote-bar').height();
            var combinedHeight = 0;

            $('.vote-chunk').each(function () {
              if ($(this).css('display') != 'none') {
                combinedHeight = combinedHeight + $(this).height();
              }
            });

            if (combinedHeight > barHeight) {
              var difference = combinedHeight - barHeight;
              var targetChunk = $('.vote-chunk:last-of-type');
              var newHeight = targetChunk.height() - difference;

              $('.vote-chunk:last-of-type').height(newHeight);
            }
            if (combinedHeight < barHeight) {
              var difference = combinedHeight - barHeight;
              var targetChunk = $('.vote-chunk:last-of-type');
              var newHeight = targetChunk.height() + difference;

              $('.vote-chunk:last-of-type').height(newHeight);
            }
          }
        }
      }
    });
  </script>
@endsection
