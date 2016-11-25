<template>
  <div>
    <div class="col-sm-offset-3 col-md-offset-3 col-sm-9 col-md-9">
      <strong>Tier {{ index + 1 }}</strong>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label">Minimum Amount</label>

      <div class="col-md-9">
        <div class="input-group">
          <span class="input-group-addon">$</span>
          <input type="number" class="form-control" v-model="form.minimum" required="required" number />
          <span class="input-group-addon">.00</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label">Reward</label>

      <div class="col-md-9">
        <input type="text" class="form-control" v-model="form.reward" required="required" />
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props: ['index', 'form'],
  }
</script>
