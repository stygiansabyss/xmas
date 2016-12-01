<template>
  <div class="text-marquee">
    <div>
      <div v-for="donation in donations">
        {{ donation.comment }} ~<span style="color: #54515b;">{{ donation.name }}</span>
        <span><i class="fa fa-tree"></i></span>
      </div>
    </div>
  </div>
</template>
<style>
  .text-marquee div div {
    display: inline-block;
  }
</style>
<script>
  export default {
    data() {
      return {
        donations: app.donations,
        settings:  app.settings,
        cycle:     0,
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
              this.setDonations()

              setTimeout(() =>
              {
                this.setMarquee()
              }, 500)
            }
          })
          .listen('.App.Services.Donating.Events.DonationWasReceived', (e) =>
          {
            this.donations.push(e.donation)
          })

    },

    methods: {
      setMarquee() {
        let jqEl = $('.text-marquee')

        if (jqEl.data('_simplemarquee')) {
          var instance            = jqEl.data('_simplemarquee')
          instance._options.speed = this.settings.scroll_speed
          instance.update(false)
        } else {
          jqEl.bind('cycle', () =>
          {
            if (this.cycle == 2) {
              this.setDonations()
            }

            if (this.cycle != 2) {
              this.cycle = this.cycle + 1
            }
          })

          jqEl.simplemarquee({
            speed:              this.settings.scroll_speed,
            delayBetweenCycles: 0,
            cycles:             'infinity',
            space:              1189,
          }).simplemarquee('update')
        }
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
