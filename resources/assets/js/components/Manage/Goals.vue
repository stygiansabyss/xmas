<template>
  <div class="panel panel-default" :class="{ 'panel-primary': goal !== null }">
    <div class="panel-heading">
      <div class="panel-title clearfix">
        <div class="pull-left">Current Goal</div>
        <div class="pull-right">
          <a href="/goal" class="btn btn-xs btn-default">
            <i class="fa fa-bars"></i>
          </a>
          <a href="/goal/edit/{{ goal.id }}" class="btn btn-xs btn-info" v-if="goal != null">
            <i class="fa fa-edit"></i>
          </a>
          <a @click="goalShow = ! goalShow" class="btn btn-xs btn-info">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="panel-body" v-show="goalShow">
      <form class="form-horizontal">
        <div v-if="goal === null">
          <div class="form-group">
            <div class="col-md-12">
              <a href="/goal/create" class="btn btn-block btn-info">Create a new Goal</a>
            </div>
          </div>
        </div>
        <div v-if="goal !== null">
          <div class="form-group">
            <label class="col-md-4 control-label">Starting Value</label>

            <div class="col-md-2">
              <p class="form-control-static">
                {{ goal.start_value }}
              </p>
            </div>
            <label class="col-md-3 control-label">Raised</label>

            <div class="col-md-3">
              <p class="form-control-static">{{ total.raised }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Goal</label>

            <div class="col-md-8">
              <p class="form-control-static">{{ goal.goal }}</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Percentage</label>

            <div class="col-md-8">
              <div class="form-control-static">
                <div class="progress" style="margin-bottom: 0;">
                  <div class="progress-bar progress-bar-primary" role="progressbar" :aria-valuenow="goal.percent"
                       aria-valuemin="0" aria-valuemax="100" :style="{ width: goal.percent +'%' }">
                    {{ goal.percent }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="/goal/reached/{{ goal.id }}"
             class="confirm-continue btn btn-block btn-xs btn-info"
             style="position: relative; bottom: -5px;"
          >
            Mark goal reached
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
        goal:     app.activeGoal,
        goalShow: true,
      }
    },

    ready() {
      _christmasEcho.bind(this)('Goals', 'GoalWasUpdated', 'goal')
    }
  }
</script>
