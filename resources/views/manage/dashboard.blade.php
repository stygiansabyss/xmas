<manage-dashboard></manage-dashboard>
{{--<div class="container-fluid" id="vue">--}}
  {{--<div class="row">--}}
    {{--<div class="col-md-4">--}}
    {{--</div> --}}{{-- End Column --}}
    {{--<div class="col-md-4">--}}
      {{--@include('christmas.goal.active')--}}
      {{--@include('christmas.raffle.active')--}}
    {{--</div> --}}{{-- End Column --}}
    {{--<div class="col-md-4">--}}
{{--      @include('christmas.incentive.active')--}}
{{--      @include('christmas.vote.active')--}}
    {{--</div> --}}{{-- End Column --}}
  {{--</div>--}}
{{--</div>--}}

{{--@section('js')--}}
  {{--<script>--}}
    {{--new Vue({--}}
      {{--el: '#vue',--}}

      {{--data: {--}}
        {{--goal: app.activeGoal,--}}
        {{--incentive: app.activeIncentive,--}}
        {{--raffle: app.activeRaffle,--}}
        {{--vote: app.activeVote,--}}
        {{--total: app.total,--}}
        {{--commentCount: app.commentCount,--}}
        {{--shownCount: app.shownCount,--}}
        {{--readCount: app.readCount,--}}
        {{--showAll: 'goal',--}}
        {{--goalShow: true,--}}
        {{--incentiveShow: true,--}}
        {{--raffleShow: true,--}}
        {{--voteShow: true,--}}
      {{--},--}}

      {{--ready: function () {--}}
        {{--self = this;--}}

        {{--var socket = io('{!! config('app.url') !!}:3000');--}}

        {{--socket.on('christmas:App\\Events\\TotalWasChanged', function (message) {--}}
          {{--self.$set('total', message.total);--}}
          {{--self.$set('commentCount', message.commentCount);--}}
          {{--self.$set('shownCount', message.shownCount);--}}
          {{--self.$set('readCount', message.readCount);--}}
        {{--});--}}

        {{--socket.on('christmas:App\\Events\\GoalWasUpdated', function (message) {--}}
          {{--self.$set('goal', message.goal);--}}
        {{--});--}}

        {{--socket.on('christmas:App\\Events\\IncentiveWasUpdated', function (message) {--}}
          {{--self.$set('incentive', message.incentive);--}}
        {{--});--}}

        {{--socket.on('christmas:App\\Events\\RaffleEntryAdded', function (message) {--}}
          {{--self.$set('raffle', message.raffle);--}}
        {{--});--}}

        {{--socket.on('christmas:App\\Events\\VoteWasUpdated', function (message) {--}}
          {{--self.$set('vote', message.vote);--}}
        {{--});--}}
      {{--},--}}

      {{--methods: {--}}
        {{--setShowAll: function (value) {--}}
          {{--this.showAll = value;--}}
        {{--},--}}

        {{--toggleVoteStatus: function (voteId, statusId) {--}}
          {{--this.$http.get('/christmas/vote/'+ voteId +'/status/'+ statusId, function (data) {--}}
            {{--this.vote = data;--}}
          {{--});--}}
        {{--},--}}

        {{--toggleVoteAcceptance: function (voteId, statusId) {--}}
          {{--this.$http.get('/christmas/vote/'+ voteId +'/acceptance/'+ statusId, function (data) {--}}
            {{--this.vote = data;--}}
          {{--});--}}
        {{--},--}}

        {{--toggleTierStatus: function (tierId, statusId) {--}}
          {{--this.$http.get('/christmas/raffle/tier/'+ tierId +'/status/'+ statusId, function (data) {--}}
            {{--this.raffle = data;--}}
          {{--});--}}
        {{--},--}}

        {{--toggleRaffleStatus: function (raffleId, statusId) {--}}
          {{--this.$http.get('/christmas/raffle/'+ raffleId +'/status/'+ statusId, function (data) {--}}
            {{--this.raffle = data;--}}
          {{--});--}}
        {{--}--}}
      {{--}--}}
    {{--});--}}

    {{--$(function () {--}}
      {{--$('[data-toggle="popover"]').popover(--}}
        {{--{--}}
          {{--html: true,--}}
          {{--placement: 'left'--}}
        {{--}--}}
      {{--);--}}
    {{--})--}}
  {{--</script>--}}
{{--@endsection--}}
