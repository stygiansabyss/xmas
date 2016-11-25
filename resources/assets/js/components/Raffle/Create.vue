<template>
  <div class="container">
    <p class="lead">Create a new raffle</p>
    <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
      <div class="form-group">
        <label class="col-md-3 control-label">Raffle Name</label>
        <div class="col-md-9">
          <input type="text" v-model="form.name" class="form-control" />
        </div>
      </div>
      <tier v-for="tier in tierCount" :index="tier" :form="form.tiers[tier]"></tier>
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
<script>
  import Tier from './Tier.vue'

  export default {
    data() {
      return {
        tierCount: 1,
        form:      {
          _token: Laravel.csrfToken,
          name:   null,
          tiers:  [
            {
              minimum: null,
              reward:  null,
            }
          ],
        }
      }
    },

    components: {
      'tier': Tier,
    },

    methods: {
      addTier() {
        this.form.tiers.push({
          minimum: null,
          reward:  null,
        })
        this.$set('tierCount', this.tierCount + 1);
      },

      onSubmit() {
        this.$http.post('/raffle/create', this.form)
            .then((response) =>
            {
              console.log(response)
            })
      }
    }
  }
</script>
