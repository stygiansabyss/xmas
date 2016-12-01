<template>
  <div class="panel panel-default" :class="{ 'panel-primary': raffle !== null }">
    <div class="panel-heading">
      <div class="panel-title clearfix">
        <div class="pull-left">Current Raffle</div>
        <div class="pull-right">
          <a class="btn btn-xs btn-inverse"
             v-show="raffle != null && raffle.status == 0"
             @click="toggleRaffleStatus(raffle.id, 1)"
             title="Set Active"
          >
            <i class="fa fa-ban"></i>
          </a>
          <a href="/raffle/{{ raffle.id }}/status/2"
             class="btn btn-xs btn-success"
             v-show="raffle != null"
             @click="toggleRaffleStatus(raffle.id, 2)"
             title="Set Finished"
          >
            <i class="fa fa-check-circle"></i>
          </a>
          <a href="/raffle/watch/{{ raffle.id }}" class="btn btn-xs btn-warning" v-show="raffle != null">
            <i class="fa fa-eye"></i>
          </a>
          <a href="/raffle/winner/{{ raffle.id }}" class="btn btn-xs btn-warning" v-show="raffle != null">
            <i class="fa fa-trophy"></i>
          </a>
          <a href="/raffle" class="btn btn-xs btn-default">
            <i class="fa fa-bars"></i>
          </a>
          <a href="/raffle/edit/{{ raffle.id }}" class="btn btn-xs btn-info" v-show="raffle != null">
            <i class="fa fa-edit"></i>
          </a>
          <a @click="raffleShow = ! raffleShow" class="btn btn-xs btn-info">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
    <table class="table table-striped table-hover" v-show="raffle !== null && raffleShow">
      <thead>
        <tr>
          <td><strong>Amount</strong></td>
          <td class="text-center"><strong>Entries</strong></td>
          <td class="text-center"><strong>Winners</strong></td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tier in raffle.tiers">
          <td>{{ tier.minimum }}</td>
          <td class="text-center">{{ tier.entries }}</td>
          <td class="text-center">{{ tier.winner_count }}</td>
          <td class="text-right">
            <a class="btn btn-xs btn-default"
               v-show="tier.status == 0"
               @click="toggleTierStatus(tier.id, 1)"
               title="Set Active"
            >
              <i class="fa fa-ban"></i>
            </a>
            <a class="btn btn-xs btn-success"
               v-show="tier.status == 1"
               @click="toggleTierStatus(tier.id, 0)"
               title="Set Inactive"
            >
              <i class="fa fa-check-circle"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="panel-footer" v-show="raffle !== null">
      <div class="btn-group btn-group-justified">
        <div class="btn-group">
          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span v-if="raffle.status == 0">Inactive</span>
            <span v-if="raffle.status == 1">Active</span>
            <span v-if="raffle.status == 2">Finished</span>
            <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">Set Status</li>
            <li @click="toggleRaffleStatus(raffle.id, 0)" :class="{ 'active': raffle.status == 0 }"><a>Inactive</a>
            </li>
            <li @click="toggleRaffleStatus(raffle.id, 1)" :class="{ 'active': raffle.status == 1 }"><a>Active</a></li>
            <li @click="toggleRaffleStatus(raffle.id, 2)" :class="{ 'active': raffle.status == 2 }"><a>Finished</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel-body" v-show="raffle === null && raffleShow">
      <a href="/raffle/create" class="btn btn-block btn-info">Create a new Raffle</a>
    </div>
  </div>
</template>
<style>
</style>
<script>
  export default{
    data(){
      return {
        raffle:     app.activeRaffle,
        raffleShow: true,
      }
    },

    methods: {
      toggleTierStatus(tierId, statusId) {
        this.$http.get('/raffle/tier/' + tierId + '/status/' + statusId)
            .then((data) =>
            {
              this.raffle = data.body
            })
      },

      toggleRaffleStatus(raffleId, statusId) {
        this.$http.get('/raffle/' + raffleId + '/status/' + statusId)
            .then((data) =>
            {
              this.raffle = data.body
            })
      }
    }
  }
</script>
