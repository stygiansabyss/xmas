<template>
  <div class="full">
    <div class="stream">&nbsp;</div>
    <logos></logos>
    <goal></goal>
    <vote></vote>
    <scroll></scroll>
    <div class="jingle">&nbsp;</div>
    <total></total>
  </div>
</template>
<style></style>
<script>
  import Logos from './Parts/Logos.vue'
  import Goal from './Parts/Goal.vue'
  import Vote from './Parts/Vote.vue'
  import Scroll from './Parts/Scroll.vue'
  import Total from './Parts/Total.vue'

  export default {
    components: {
      'logos':  Logos,
      'goal':   Goal,
      'vote':   Vote,
      'scroll': Scroll,
      'total':  Total,
    }
  }
</script>
