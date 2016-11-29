<template>
  <div class="tweets" id="donations" :class="settings.scroll_speed" transition="fade">
    <div v-for="donation in donations">
      {{ donation.comment }} ~<span style="color: #54515b;">{{ donation.name }}</span>
      <span><i class="fa fa-tree"></i></span>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        donations: app.donations,
        settings:  app.settings,
      }
    },
    ready: function() {
      Echo.channel('christmas')
        .listen('.App.Services.Administrating.Events.SettingChanged', (e) => {
            Vue.set(this.settings, e.setting.name, e.setting.value);

            if (this.settings.scroll_mode == 'donations')
            {
              this.setDonations();
            }
        })
        .listen('.App.Services.Donating.Events.DonationWasReceived', (e) => {
          this.donations.push(e.donation);
        });
    },
    methods: {
      getDonations() {
        self = this;

        $('#donations').bind('animationend webkitAnimationEnd', function ()
        {

          $('#donations').removeClass(self.settings.scroll_speed);

          setTimeout(function ()
          {
            $('#donations').addClass(self.settings.scroll_speed);
          }, 1);

          self.setDonations();
        });
      },
      setDonations() {
        this.$http.get('/donation/overlay', function (data, status, request)
        {
          this.$set('donations', data);
        });

        this.getDonations();
      },
    }
  }
</script>
