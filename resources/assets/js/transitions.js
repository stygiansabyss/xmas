Vue.transition('fade', {
  enter: function (el, done)
         {
           $(el).css('opacity', 0);
           if (this.order == 'leave') {
             setTimeout(function ()
             {
               $(el).animate({opacity: 1}, 2000);
             }, 2000);
           } else {
             this.$set('order', 'enter');
             $(el).animate({opacity: 1}, 2000);
           }
           done();
         },
  leave: function (el, done)
         {
           if (this.order == 'enter') {
             setTimeout(function ()
             {
               $(el).animate({display: 'none'}, 2000);
             }, 2000);
           } else {
             this.$set('order', 'leave');
             $(el).animate({display: 'none'}, 2000);
           }
           done();
         },
});
