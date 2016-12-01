<template>
  <div class="panel panel-default" :class="{ 'panel-primary': vote !== null }">
    <div class="panel-heading">
      <div class="panel-title clearfix">
        <div class="pull-left">Current Vote</div>
        <div class="pull-right">
          <a href="/vote" class="btn btn-xs btn-default">
            <i class="fa fa-bars"></i>
          </a>
          <a @click="voteShow = ! voteShow" class="btn btn-xs btn-info">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="panel-body" v-if="vote !== null && voteShow">
      <div class="row">
        <div class="col-md-12">
          <strong>{{ vote.name }}</strong>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover" v-if="vote !== null && voteShow">
      <thead>
        <tr>
          <th>Option</th>
          <th class="text-center">Votes</th>
          <th class="text-center">Percent</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="option in vote.options">
          <td>{{ option.key_word }}</td>
          <td class="text-center">{{ option.votes }}</td>
          <td class="text-center">{{ option.percent }}</td>
        </tr>
      </tbody>
    </table>
    <div class="panel-footer" v-show="vote !== null && voteShow">
      <div class="btn-group btn-group-justified">
        <div class="btn-group">
          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span v-if="vote.status == 0">Inactive</span>
            <span v-if="vote.status == 1">Active</span>
            <span v-if="vote.status == 2">Finished</span>
            <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Set Status</li>
            <li @click="toggleVoteStatus(vote.id, 0)" :class="{ 'active': vote.status === 0 }"><a>Inactive</a></li>
            <li @click="toggleVoteStatus(vote.id, 1)" :class="{ 'active': vote.status === 1 }"><a>Active</a></li>
            <li @click="toggleVoteStatus(vote.id, 2)" :class="{ 'active': vote.status === 2 }"><a>Finished</a></li>
          </ul>
        </div>
        <div class="btn-group">
          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span v-if="vote.accepting_flag == 0">Not Accepting Votes</span>
            <span v-if="vote.accepting_flag == 1">Accepting Votes</span>
            <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Set Accepting Votes</li>
            <li @click="toggleVoteAcceptance(vote.id, 1)" :class="{ 'active': vote.accepting_flag === 1 }">
              <a>Accepting Votes</a>
            </li>
            <li @click="toggleVoteAcceptance(vote.id, 0)" :class="{ 'active': vote.accepting_flag === 0 }">
              <a>Not Accepting Votes</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-body" v-if="vote === null && voteShow">
      <a href="/vote/create" class="btn btn-block btn-info">Create a new Vote</a>
    </div>
  </div>
</template>
<style>
</style>
<script>
  export default{
    data(){
      return {
        vote:     app.activeVote,
        voteShow: true,
      }
    },

    ready() {
      _christmasEcho.bind(this)('Voting', 'VoteWasUpdated', 'vote')
    },

    methods: {
      toggleVoteStatus(voteId, statusId) {
        this.$http.get('/vote/' + voteId + '/status/' + statusId)
            .then((data) =>
            {
              this.vote = data.body
            })
      },

      toggleVoteAcceptance(voteId, statusId) {
        this.$http.get('/vote/' + voteId + '/acceptance/' + statusId)
            .then((data) =>
            {
              this.vote = data.body
            })
      },
    }
  }
</script>
