<template>
  <div>
    <hr />
    <div class="form-group">
      <div class="col-sm-offset-3 col-md-offset-3 col-sm-9 col-md-9">
        <h4>Option {{ index + 1 }}</h4>
      </div>
    </div>
    <div>
      <div class="form-group">
        <label class="col-md-3 control-label">Key Word</label>

        <div class="col-md-9">
          <input type="text" class="form-control" v-model="form.key_word" />
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  hr + div.form-group div h4 {
    margin: 0;
  }
</style>
<script>
  export default {
    props: [
      'index',
      'form'
    ],
  }

</script>
