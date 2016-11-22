Vue.transition('fade', {
  enter: function (el, done)
         {
           $(el).css('opacity', 0);
           if (vueModel.order == 'leave') {
             setTimeout(function ()
             {
               $(el).animate({opacity: 1}, 2000);
             }, 2000);
           } else {
             vueModel.$set('order', 'enter');
             $(el).animate({opacity: 1}, 2000);
           }
           done();
         },
  leave: function (el, done)
         {
           if (vueModel.order == 'enter') {
             setTimeout(function ()
             {
               $(el).animate({display: 'none'}, 2000);
             }, 2000);
           } else {
             vueModel.$set('order', 'leave');
             $(el).animate({display: 'none'}, 2000);
           }
           done();
         },
});
