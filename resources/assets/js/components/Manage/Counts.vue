<template>
  <div class="panel panel-info">
    <div class="panel-heading">
      <div class="panel-title">Counts</div>
    </div>
    <table class="table table-hover" id="counts-table">
      <tbody>
        <tr>
          <td><strong>Total</strong></td>
          <td class="text-right">{{ total.raised }}</td>
        </tr>
        <tr>
          <td><strong>Donation Comments</strong></td>
          <td class="text-right">{{ commentCount }}</td>
        </tr>
        <tr>
          <td><strong>Donations Shown</strong></td>
          <td class="text-right">{{ shownCount }}</td>
        </tr>
        <tr>
          <td><strong>Donations Read</strong></td>
          <td class="text-right">{{ readCount }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<style>
  #counts-table tr td:first-of-type {
    width: 50%;
  }
</style>
<script>
  export default{
    data(){
      return {
        total:        app.total,
        commentCount: app.commentCount,
        shownCount:   app.shownCount,
        readCount:    app.readCount,
      }
    },

    ready() {
      Echo.channel('christmas')
          .listen('.App.Services.Donating.Events.TotalWasUpdated', (e) =>
          {
            this.total      = e.total
            this.commentCount = e.commentCount
            this.shownCount   = e.shownCount
            this.readCount    = e.readCount
          })

      socket.on('christmas:App\\Events\\TotalWasChanged', function (message)
      {
        self.$set('total', message.total);
        self.$set('commentCount', message.commentCount);
        self.$set('shownCount', message.shownCount);
        self.$set('readCount', message.readCount);
      });
    }
  }
</script>
