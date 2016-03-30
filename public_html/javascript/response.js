$(function(){
  function Response(){
    this.view = $('body');
    this.backButtons = $('.back');
    this.transitionend = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';

    this.initialize();
  }

  Response.prototype.initialize = function(){
    this.events();
  };

  Response.prototype.events = function(){
    var self = this;

    // this.backButtons.on('click', function(event){
    //   self.backHandler(event);
    // });
  };

  Response.prototype.backHandler = function(event){
    var href = (window.location.origin + $(event.target).attr('href')) || window.location.origin;

    this.view.addClass('out');

    window.setTimeout(function(){
      // window.location = href;
      console.log(href);
    },1000);
    // event.preventDefault();
  };

  var response = new Response();
});
