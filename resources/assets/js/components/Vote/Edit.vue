<template>
  <div class="container">
    <p class="lead">Editing Vote: {{ form.name }}</p>
    <form class="form-horizontal" method="POST" @submit.prevent="onSubmit()">
      <div class="form-group">
        <label class="col-md-3 control-label">Vote Label</label>
        <div class="col-md-9">
          <input type="text" v-model="form.name" class="form-control" required="required" />
        </div>
      </div>
      <vote-option v-for="option in optionCount" :index="option" :form="form.options[option]"></vote-option>
      <vote-option v-for="option in newOptionCount" :index="option + optionCount" :form="form.new_options[option]"></vote-option>
      <div class="form-group">
        <div class="col-sm-offset-3 col-md-offset-3 col-sm-9 col-md-9">
          <p class="form-control-static">
            <a @click="addOption()">Add Option</a>
          </p>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
          <button type="submit" class="btn btn-primary">Save Vote</button>
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
  import Option from './Option.vue'

  export default {
    data() {
      return {
        vote:           app.vote,
        optionCount:    app.vote.options.length,
        newOptionCount: 0,
        form:           {
          _token:      Laravel.csrfToken,
          name:        app.vote.name,
          options:     app.vote.options,
          new_options: [],
        }
      }
    },

    components: {
      'vote-option': Option,
    },

    methods: {
      addOption() {
        this.form.new_options.push({
          minimum: null,
          reward:  null,
        })
        this.$set('newOptionCount', this.newOptionCount + 1)
      },

      onSubmit() {
        this.$http.post('/vote/edit/' + this.vote.id, this.form)
            .then((response) =>
            {
              if (response.ok) {
                window.location.href = '/vote';
              } else {
                window.alert('Error ' + response.status + ' when saving vote.');
              }
            })
      }
    }
  }
</script>
