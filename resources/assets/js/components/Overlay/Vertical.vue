<template>
  <div class="full">
    <div class="stream">&nbsp;</div>
    <logos></logos>
    <goal></goal>
    <vote></vote>
  </div>
</template>
<style></style>
<script>
  import Logos from './Parts/Logos.vue'
  import Goal from './Parts/Goal.vue'
  import Vote from './Parts/Vote.vue'

  export default {
    components: {
      'logos': Logos,
      'goal':  Goal,
      'vote':  Vote,
    }
  }
</script>
