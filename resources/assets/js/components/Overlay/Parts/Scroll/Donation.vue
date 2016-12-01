<template>
  <div class="marquee">
    <div v-for="donation in donations">
      {{ donation.comment }} ~<span style="color: #54515b;">{{ donation.name }}</span>
      <span><i class="fa fa-tree"></i></span>
    </div>
  </div>
</template>
<style>
  .marquee div {
    display: inline-block;
  }
</style>
<script>
  export default {
    data() {
      return {
        donations: app.donations,
        settings:  app.settings,
      }
    },

    ready() {
      if (this.settings.scroll_mode == 'donations') {
        this.setDonations()
      }

      setTimeout(() =>
      {
        this.setMarquee()
      }, 500)

      Echo.channel('christmas')
          .listen('.App.Services.Administrating.Events.SettingChanged', (e) =>
          {
            let originalSetting = this.settings.scroll_mode

            Vue.set(this.settings, e.setting.name, e.setting.value)

            if (originalSetting != 'donations'
                && this.settings.scroll_mode == 'donations') {
              $('.marquee').marquee('destroy')

              this.setDonations()
            }
          })
          .listen('.App.Services.Donating.Events.DonationWasReceived', (e) =>
          {
            this.donations.push(e.donation)
          })

    },

    methods: {
      setMarquee() {
        let self = this

        $('.marquee')
                .bind('finished', function ()
                {
                  self.setDonations()
                })
                .marquee({
                  duration:         this.settings.scroll_speed,
                  delayBeforeStart: 0,
                  duplicated:       false,
                })
      },
      setDonations() {
        this.$http.get('/donation/overlay')
            .then((data) =>
            {
              this.$set('donations', data.body)
            })
      },
    }
  }
</script>
