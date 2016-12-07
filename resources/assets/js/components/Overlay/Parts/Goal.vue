<template>
  <div class="goal"
       v-if="settings.goal_mode == 'goal' && goal != null"
       transition="fade"
  >
    <div class="goal-text">Goal</div>
    <div class="goal-target">
      <div class="goal-total">${{ goal.goal }}</div>
    </div>
    <div class="goal-bar">
      <div class="goal-percent">{{ goal.percent }}%</div>
      <div class="goal-progress" :class="{ 'reached': goal.reached_at != null }"
           :style="{ height: goal.percent +'%' }"></div>
    </div>
  </div>
</template>
<style></style>
<script>
  export default {
    data() {
      return {
        goal:     app.goal,
        settings: app.settings,
      }
    },

    ready() {
      _settingsEcho.bind(this)()
      _christmasEcho.bind(this)('Goals', 'GoalWasUpdated', 'goal')
    }
  }
</script>
