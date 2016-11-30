Vue.transition('fade', {
  enter (el, done)
  {
    $(el).css('opacity', 0)
    if (this.order == 'leave') {
      setTimeout(() =>
      {
        $(el).animate({opacity: 1}, 2000)
      }, 2000)
    } else {
      this.$set('order', 'enter')
      $(el).animate({opacity: 1}, 2000)
    }
    done()
  },
  leave (el, done)
  {
    if (this.order == 'enter') {
      setTimeout(() =>
      {
        $(el).animate({display: 'none'}, 2000)
      }, 2000)
    } else {
      this.$set('order', 'leave')
      $(el).animate({display: 'none'}, 2000)
    }
    done()
  },
})

Vue.transition('donation-fade', {
  enter (el, done)
  {
    $(el).css('opacity', 0)
    $(el).animate({opacity: 1}, 1000, done)
  },
  enterCancelled (el)
  {
    $(el).stop()
  },
  leave (el, done)
  {
    $(el).animate({opacity: 0}, 1000, done)
  },
  leaveCancelled (el)
  {
    $(el).stop()
  }
})
