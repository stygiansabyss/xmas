<template>
  <div class="panel panel-default" :class="{ 'panel-primary': incentive !== null }">
    <div class="panel-heading">
      <div class="panel-title clearfix">
        <div class="pull-left">Current Incentive</div>
        <div class="pull-right">
          <a href="/incentives" class="btn btn-xs btn-default">
            <i class="fa fa-bars"></i>
          </a>
          <a @click="incentiveShow = ! incentiveShow" class="btn btn-xs btn-info">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="panel-body" v-show="incentiveShow">
      <form>
        <div v-if="incentive === null">
          <div class="form-group">
            <div class="col-md-12">
              <a href="/incentive/create" class="btn btn-block btn-info">
                Create a new Incentive
              </a>
            </div>
          </div>
        </div>
        <div v-if="incentive !== null">
          <div class="form-group">
            <label class="col-md-3 control-label">Target</label>

            <div class="col-md-3">
              <p class="form-control-static">{{ incentive.target }}</p>
            </div>
            <label class="col-md-3 control-label">Received</label>

            <div class="col-md-3">
              <p class="form-control-static">{{ incentive.count }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Reward</label>

            <div class="col-md-9">
              <p class="form-control-static">{{ incentive.reward }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Percentage</label>

            <div class="col-md-9">
              <div class="form-control-static">
                <div class="progress" style="margin-bottom: 0;">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ incentive.percent }}"
                       aria-valuemin="0" aria-valuemax="100" style="width: {{ incentive.percent }}%;">
                    {{ incentive.percent }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="/incentive/reached/{{ incentive.id }}"
             class="confirm-continue btn btn-block btn-xs btn-info"
             style="position: relative; bottom: -5px;"
          >
            Mark incentive reached
          </a>
        </div>
      </form>
    </div>
  </div>
</template>
<style>
</style>
<script>
  export default{
    data(){
      return {
        incentive:     app.activeIncentive,
        incentiveShow: true,
      }
    },
  }
</script>
