<template>
  <div class="container">
    <p class="lead">Editing Raffle: {{ form.name }}</p>
    <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
      <div class="form-group">
        <label class="col-md-3 control-label">Raffle Name</label>
        <div class="col-md-9">
          <input type="text" v-model="form.name" class="form-control" required="required" />
        </div>
      </div>
      <tier v-for="tier in tierCount" :index="tier" :form="form.tiers[tier]"></tier>
      <tier v-for="tier in newTierCount" :index="tier + tierCount" :form="form.new_tiers[tier]"></tier>
      <div class="form-group">
        <div class="col-sm-offset-3 col-md-offset-3 col-sm-9 col-md-9">
          <p class="form-control-static">
            <a @click="addTier()">Add Tier</a>
          </p>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <button type="submit" class="btn btn-primary">Save Raffle</button>
        </div>
      </div>
    </form>
  </div>
</template>
<style>
  .form-control-static a:hover {
    cursor: pointer;
  }
</style>
<script>
  import Tier from './Tier.vue'

  export default {
    data() {
      return {
        raffle:       app.raffle,
        tierCount:    app.raffle.tiers.length,
        newTierCount: 0,
        form:         {
          _token:    Laravel.csrfToken,
          name:      app.raffle.name,
          tiers:     app.raffle.tiers,
          new_tiers: [],
        }
      }
    },

    components: {
      'tier': Tier,
    },

    methods: {
      addTier() {
        this.form.new_tiers.push({
          minimum: null,
          reward:  null,
        })
        this.$set('newTierCount', this.newTierCount + 1);
      },

      onSubmit() {
        this.$http.post('/raffle/edit/' + this.raffle.id, this.form)
            .then((response) =>
            {
              if (response.ok) {
                window.location.href = '/raffle';
              } else {
                window.alert('Error ' + response.status + ' when saving Raffle.');
              }
            })
      }
    }
  }
</script>
