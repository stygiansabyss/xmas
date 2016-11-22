<template>
  <div class="full">
    <div class="stream">&nbsp;</div>
    <scroll></scroll>
    <div class="jingle">&nbsp;</div>
    <total></total>
  </div>
</template>
<style></style>
<script>
  import Scroll from './Parts/Scroll.vue'
  import Total from './Parts/Total.vue'

  export default {
    components: {
      'scroll': Scroll,
      'total':  Total,
    }
  }
</script>
