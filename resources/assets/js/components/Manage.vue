<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline">
          <li>People on this page:</li>
          <li v-for="user in users | orderBy 'level'" track-by="id" :class="user.color" :title="user.title">
            {{ user.name}}
            <i class="fa fa-fw" :class="user.icon"></i>
          </li>
        </ul>
      </div>
    </div>
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
<style>
  .text-twitch {
    color: #64459b !important;
  }
</style>
<script>
  import Counts from './Manage/Counts.vue'
  import Settings from './Manage/Settings.vue'
  import Goals from './Manage/Goals.vue'
  import Raffles from './Manage/Raffles.vue'
  import Incentives from './Manage/Incentives.vue'
  import Votes from './Manage/Votes.vue'

  export default {
    data() {
      return {
        users: []
      }
    },

    ready() {
      console.log('here')

      Echo.join('manage')
          .here((users) =>
          {
            this.users = users
          })
          .joining((user) =>
          {
            this.users.push(user)
          })
          .leaving((user) =>
          {
            this.users = this.users.filter((item) =>
            {
              return item.id !== user.id;
            })
          })
    },

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
