<div class="full" id="vue">
  <div class="stream">&nbsp;</div>
  <div class="jingle">&nbsp;</div>
  <div class="total" v-if="settings.total_display == 1">$@{{ total.raised }}</div>
</div>


@section('js')
  <script>
    var vueModel = new Vue({
      el: '#vue',

      data: {
        settings: window.settings,
        total: window.total,
      },

      ready: function () {
        self = this;

        var socket = io('{!! config('app.url') !!}:3000');

        socket.on('christmas:App\\Events\\ChristmasSettingChanged', function (message) {
          self.settings.$set(message.setting.keyName, message.setting.value);
        });

        socket.on('christmas:App\\Events\\TotalWasChanged', function (message) {
          self.$set('total', message.total);
        });
      }
    });
  </script>
@endsection
