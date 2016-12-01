<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <manage-counts></manage-counts>
        <manage-settings></manage-settings>
      </div>
      <div class="col-md-4">
        <manage-goals></manage-goals>
        <manage-raffles></manage-raffles>
      </div>
      <div class="col-md-4">
        <manage-incentives></manage-incentives>
        <manage-votes></manage-votes>
      </div>
    </div>
  </div>
</template>

<script>
  import Counts from './Manage/Counts.vue'
  import Settings from './Manage/Settings.vue'
  import Goals from './Manage/Goals.vue'
  import Raffles from './Manage/Raffles.vue'
  import Incentives from './Manage/Incentives.vue'
  import Votes from './Manage/Votes.vue'

  export default {
    components: {
      'manage-counts':     Counts,
      'manage-settings':   Settings,
      'manage-goals':      Goals,
      'manage-raffles':    Raffles,
      'manage-incentives': Incentives,
      'manage-votes':      Votes,
    }
  }
</script>
