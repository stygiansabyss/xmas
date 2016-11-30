<template>
  <div class="container">
    <div v-for="tier in tiers" transition="fade">
      <h1 class="text-primary">{{ tier.minimum }} - {{ tier.reward }}</h1>
      <div v-for="winner in tier.winners">
        <div v-if="winner.pivot.status == 1">
          <h2>{{ winner.name }} - {{ winner.email }}</h2>
          <h3 class="text-muted" v-if="winner.comment == ''">No comment provided.</h3>
          <h3 class="text-muted" v-if="winner.comment != ''">{{ winner.comment }}</h3>
          <br />
        </div>
      </div>
      <hr />
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        tiers: app.tiers,
      }
    },
    ready() {
        _christmasEcho.bind(this)('Raffling', 'RaffleApproved', 'tiers')
    }
  }
</script>
