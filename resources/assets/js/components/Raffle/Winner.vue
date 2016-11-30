<template>
  <div class="row">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <div class="col-md-2">
          <strong>Number of winners to grab</strong>
        </div>
        <div class="col-md-10">
          <input type="number" placeholder="Number of winners to grab" class="form-control" v-model="count" />
        </div>
      </div>
      <br />

      <div class="panel panel-default" v-for="tier in raffle.tiers">
        <div class="panel-heading">
          <div class="panel-title clearfix">
            <div class="pull-left">
              {{ tier.minimum }} - {{ tier.reward }}
            </div>
            <ul class="list-inline pull-right">
              <li>Entries: {{ tier.entries }}</li>
              <li>Winners: {{ tier.winner_count }}</li>
            </ul>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3">
              <button class="btn btn-primary" @click="getWinners(tier.id)">Roll For Winners</button>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover" v-show="tier.unshown_winners.length > 0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Comment</th>
              <th>Amount</th>
              <th>Created</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="donation in tier.unshown_winners">
              <td>{{ donation.name }}</td>
              <td>{{ donation.email }}</td>
              <td class="raffle-winner-comment">
                {{ donation.comment }}
              </td>
              <td>{{ donation.amount }}</td>
              <td>{{ donation.created_at_readable }}</td>
              <td class="text-right">
                <div class="btn-group">
                  <a class="btn btn-primary btn-sm"
                     v-if="donation.pivot.status == 0"
                     @click="setWinnerStatus(1, tier.id, donation.id)"
                     title="This will make the winner show on screen."
                  >
                    Approve
                  </a>
                  <a class="btn btn-default btn-sm"
                     v-if="donation.pivot.status == 1"
                     @click="setWinnerStatus(0, tier.id, donation.id)"
                     title="This will stop the winner from showing on screen."
                  >
                    Un-Approve
                  </a>
                  <a class="btn btn-danger btn-sm"
                     @click="denyWinner(tier.id, donation.id)"
                     title="This will remove the donation as a winner."
                  >
                    Deny
                  </a>
                  <a class="btn btn-warning btn-sm"
                     @click="setWinnerStatus(2, tier.id, donation.id)" `
                     title="Will stop the winner from showing in future results and on screen."
                  >
                    Hide
                  </a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div> <!-- Panel End -->
      <a href="/raffle/preview/{{ raffle.id }}" class="btn btn-info btn-block">Preview Raffle Results</a>
    </div> <!-- Column End -->
  </div>
</template>
<style>
  .raffle-winner-comment {
    overflow-wrap: break-word;
    word-wrap:     break-word;
    word-break:    break-all;
    width:         25%;
  }
</style>
<script>
  export default {
    data() {
      return {
        raffle:  app.raffle,
        count:   1,
        winners: app.winners
      }
    },

    methods: {
      getWinners(tierId) {
        let request = {
          _token: Laravel.csrfToken,
          count:  this.count
        }
        this.$http.post('/raffle/winner/select/' + tierId, request)
            .then((data) =>
            {
              this.raffle = data.body
            })
      },

      setWinnerStatus(status, tierId, donationId) {
        let request = {
          _token:     Laravel.csrfToken,
          tierId:     tierId,
          donationId: donationId
        }
        this.$http.post('/raffle/winner/status/' + status + '/' + tierId + '/' + donationId, request)
            .then((data) =>
            {
              this.raffle = data.body
            })
      },

      denyWinner(tierId, donationId) {
        let request = {
          _token:     Laravel.csrfToken,
          tierId:     tierId,
          donationId: donationId
        }
        this.$http.post('/raffle/winner/deny/' + tierId + '/' + donationId, request)
            .then((data) =>
            {
              this.raffle = data.body
            })
      }
    }
  }
</script>
