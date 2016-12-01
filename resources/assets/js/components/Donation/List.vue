<template>
  <div class="container donation-list">
    <div class="list-group">
      <div class="list-group-item" v-if="donations.length === 0">
        No messages to display at this time.
      </div>
      <div class="list-group-item row"
           v-for="donation in donations"
           transition="donation-fade"
           :id="donation.id"
      >
        <div class="col-md-3">
          <div class="statcard statcard-primary p-a-md" :class="{ 'statcard-success': donation.amount > 50 }">
            <h3 class="statcard-number">
              <i class="fa fa-dollar"></i>{{ donation.amount }}
            </h3>
            <span class="statcard-desc">{{ donation.created_at_short }}</span>
          </div>
        </div>
        <div class="col-md-7">
          <span class="text-muted">Donator:</span>&nbsp;
          <span class="text-primary">{{ donation.name }}</span>
          <br />
                                                  <!--<span class="text-muted">Email:</span>&nbsp;<span class="text-primary">@{{ donation.email }}</span><br />-->
          <div class="hr-divider"></div>
          <span>{{ donation.comment }}</span>
        </div>
        <div class="col-md-2">
          <div class="statcard statcard-danger text-center p-a-md"
               @click="confirmDelete(donation.id)"
               v-if="deleting != donation.id"
          >
            <h3 class="statcard-number">
              <i class="fa fa-fw fa-check-circle-o"></i>
            </h3>
            <span class="statcard-desc">Read</span>
          </div>
          <div class="statcard statcard-info text-center p-a-md"
               @click="doDelete(donation.id, $index)"
               v-if="deleting == donation.id"
          >
            <h3 class="statcard-number">
              <i class="fa fa-fw fa-check-circle-o"></i>
            </h3>
            <span class="statcard-desc">Confirm?</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  .donation-list {
    margin-top:     20px;
    font-family:    'Roboto Condensed', sans-serif;
    text-transform: uppercase;
    font-size:      1.3em;
  }
</style>
<script>
  export default {
    data() {
      return {
        donations: app.donations,
        deleting:  null
      }
    },

    ready() {
      Echo.channel('donation_read')
          .listen('.App.Services.Donating.Events.DonationWasRead', (e) =>
          {
            this.donations = this.donations.filter((item) =>
            {
              return item.id != e.donation.id;
            })

            this.checkDonations()
          })
          .listen('.App.Services.Donating.Events.DonationsWereReset', (e) =>
          {
            this.donations = []
            this.checkDonations()
          })

      Echo.channel('christmas')
          .listen('.App.Services.Donating.Events.TotalWasChanged', (e) =>
          {
            this.checkDonations()
          })
    },

    methods: {
      confirmDelete(id) {
        this.$set('deleting', id);
      },

      doDelete(id, index) {
        this.$set('deleting', null);
        this.donations.$remove(index);

        this.$http.get('/donation/read/' + id);

        this.donations = this.donations.filter((item) =>
        {
          return item.id != id;
        })

        this.checkDonations()
      },

      checkDonations() {
        if (this.donations.length === 0) {
          window.location.reload();
        }
      }
    }
  }
</script>
