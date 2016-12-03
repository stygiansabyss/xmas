<template>{{ formattedCompValue }}</template>
<style></style>
<script>
  export default {
    props: ['value'],

    data() {
      return {
        compValue: 0,
        interval: false,
        formattedCompValue: "",
      }
    },

    ready() {
       this.compValue = this.value ? this.value : 0;
       this.formattedCompValue = this.format(this.compValue);
    },

    watch: {
      value: function() {
        window.clearInterval(this.interval);
        if(this.value == this.compValue)
        {
          return;
        }
        this.interval = window.setInterval(function() {
          if(this.compValue != this.value) {
            var difference = (this.value - this.compValue) / 10;
            if (difference < 0.01)
            {
                difference = Math.round(difference * 100) / 100;
            }
            if(difference == 0)
            {
                this.compValue = this.value;
            } else {
                this.compValue = Math.round((this.compValue + difference) * 100) / 100;
            }
            this.formattedCompValue = this.format(this.compValue);
          }
        }.bind(this), 50);
      },
    },
    methods: {
      format: function (number) {
        return number.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
    }
  }
</script>
