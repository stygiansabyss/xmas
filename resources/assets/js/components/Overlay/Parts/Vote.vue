<template>
  <div class="vote"
       v-if="settings.goal_mode == 'vote' && vote != null"
       transition="fade"
  >
    <div class="vote-question">
      <div class="vote-text">{{ vote.name }}</div>
    </div>
    <div class="vote-bar">
      <div class="vote-chunk" v-for="option in vote.options" v-show="option.votes > 0"
           :style="{ height: option.percent +'%' }">
        <div class="vote-percent clearfix">{{ option.percent_overlay }}</div>
        <div class="vote-progress"></div>
      </div>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        vote:     app.vote,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
      _christmasEcho.bind(this)('Voting', 'VoteWasUpdated', 'vote', function (self, e)
      {
        self.checkVoteBar()
      })

      this.checkVoteBar()
    },

    methods: {
      checkVoteBar() {
        if (this.settings.goal_mode == 'vote') {
          let barHeight      = $('.vote-bar').height()
          let combinedHeight = 0

          $('.vote-chunk').each(function ()
          {
            if ($(this).css('display') != 'none') {
              combinedHeight = combinedHeight + $(this).height()
            }
          })

          if (combinedHeight > barHeight) {
            let difference  = combinedHeight - barHeight
            let targetChunk = $('.vote-chunk:last-of-type')
            let newHeight   = targetChunk.height() - difference

            $('.vote-chunk:last-of-type').height(newHeight)
          }
          if (combinedHeight < barHeight) {
            let difference  = barHeight - combinedHeight
            let targetChunk = $('.vote-chunk:last-of-type')
            let newHeight   = targetChunk.height() + difference

            $('.vote-chunk:last-of-type').height(newHeight)
          }
        }
      }
    }
  }
</script>
