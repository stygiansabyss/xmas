<overlay-all></overlay-all>

{{--ready: function () {--}}
{{--self = this;--}}

{{--var socket = io('{!! config('app.url') !!}:3000');--}}

{{--if (self.settings.scroll_mode == 'twitter') {--}}
  {{--self.setTweets();--}}
{{--}--}}
{{--if (self.settings.scroll_mode == 'donations') {--}}
  {{--self.setDonations();--}}
{{--}--}}

{{--socket.on('christmas:App\\Events\\ChristmasSettingChanged', function (message) {--}}
  {{--self.settings.$set(message.setting.keyName, message.setting.value);--}}

  {{--if (self.settings.scroll_mode == 'twitter') {--}}
    {{--self.setTweets();--}}
  {{--}--}}
  {{--if (self.settings.scroll_mode == 'donations') {--}}
    {{--self.setDonations();--}}
  {{--}--}}
{{--});--}}

{{--socket.on('christmas:App\\Events\\TotalWasChanged', function (message) {--}}
  {{--self.$set('total', message.total);--}}
{{--});--}}

{{--socket.on('christmas:App\\Events\\DonationReceived', function (message) {--}}
  {{--self.donations.push(message.donation);--}}
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

{{--self.checkVoteBar();--}}
{{--},--}}
