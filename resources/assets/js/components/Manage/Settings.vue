<template>
  <div class="panel panel-info">
    <div class="panel-heading">
      <div class="panel-title">Settings</div>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" @submit.prevent="onSubmit">
        <input type="hidden" v-model="csrfToken" />
        <div class="form-group" v-for="setting in settings">
          <label class="col-md-3 control-label" :for="setting.name">
            {{ setting.label }}
          </label>
          <div class="col-md-9" v-if="setting.type === 'select'">
            <select :name="setting.name" :id="setting.name" class="form-control" v-model="form.settings[setting.id]">
              <option v-for="(key, option) in setting.options" :value="key" :selected="key == setting.value">
                {{ option }}
              </option>
            </select>
          </div>
          <div class="col-md-9" v-if="setting.type === 'number'">
            <input type="number" :id="setting.name" class="form-control" :value="setting.value" v-model="form.settings[setting.id]" />
          </div>
          <div class="col-md-9" v-if="setting.type === 'text'">
            <input type="text" :id="setting.name" class="form-control" :value="setting.value" v-model="form.settings[setting.id]" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn btn-info">Save Settings</button>
          </div>
        </div>
      </form>
    </div>
    <div class="panel-footer text-white" :class="messageClass" v-show="message != null">
      {{ message }}
    </div>
  </div>
</template>
<style>
</style>
<script>
  export default{
    data(){
      return {
        settings:     app.settings,
        form:         {
          _token:   Laravel.csrfToken,
          settings: {}
        },
        message:      null,
        messageClass: null,
      }
    },

    ready() {
      $.each(this.settings, (setting) =>
      {
        this.form.settings[setting.id] = setting.value
      })
    },

    methods: {
      onSubmit() {
        this.$http.post('/setting/edit', this.form)
            .then((response) =>
            {
              this.message      = response.body
              this.messageClass = 'success'
            }, (response) =>
            {
              this.message      = response.body
              this.messageClass = 'danger'
            })

        setTimeout(() =>
        {
          this.message      = null
          this.messageClass = null
        }, 2000)
      }
    }
  }
</script>
