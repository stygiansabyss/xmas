<template>
  <div class="full">
    <div class="stream">&nbsp;</div>
    <scroll></scroll>
  </div>
</template>
<style></style>
<script>
  import Scroll from './Parts/Scroll.vue'

  export default {
    data() {
      return {
        order: null,
      }
    },

    components: {
      'scroll': Scroll,
    }
  }
</script>
