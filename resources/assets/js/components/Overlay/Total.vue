<template>
  <div class="full">
    <div class="stream">&nbsp;</div>
    <div class="jingle">&nbsp;</div>
    <total></total>
  </div>
</template>
<style></style>
<script>
  import Total from './Parts/Total.vue'

  export default {
    data() {
      return {
        order: null,
      }
    },

    components: {
      'total': Total,
    }
  }
</script>
