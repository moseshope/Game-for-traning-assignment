/*DATE*/
jQuery('img.svg').each(function(){
  var $img = jQuery(this);
  var imgID = $img.attr('id');
  var imgClass = $img.attr('class');
  var imgURL = $img.attr('src');

  jQuery.get(imgURL, function(data) {
      // Get the SVG tag, ignore the rest
      var $svg = jQuery(data).find('svg');

      // Add replaced image's ID to the new SVG
      if(typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
      }
      // Add replaced image's classes to the new SVG
      if(typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass+' replaced-svg');
      }

      // Remove any invalid XML tags as per http://validator.w3.org
      $svg = $svg.removeAttr('xmlns:a');

      // Replace image with new SVG
      $img.replaceWith($svg);

  }, 'xml');

});

$('document').ready(function(){
  
  /*INJECT DAYS LEFT*/
  
  todayDate = dateFns.format(new Date(), 'YYYY/MM/DD');
  startDate = $('.progress.timeline').attr('data-start-date');
  endDate = $('.progress.timeline').attr('data-end-date');
  daysLeft = dateFns.differenceInCalendarDays(endDate, todayDate);
  
  if (daysLeft < 0){
    $('.time-left-indic').text('0 day left');
  }
  else{
    $('.time-left-indic').text(daysLeft + ' days left');
  }
    
  /*JAUGE*/
  totalDays = dateFns.differenceInCalendarDays(endDate, startDate);
  currentPos = dateFns.differenceInCalendarDays(todayDate, startDate);
  posProgressBar = (currentPos / totalDays) * 100;
  $('.progress-bar').css('width', posProgressBar + '%');
  
  if ($('.time-closed').length == 1){
    $('.time-closed').html('<i class="fa fa-lock"></i> Challenge closed')
    $('.progress-bar').css('width','100%');
  }
  
  /*IMG POINTS*/
  
  nbIdeas = $('.panel-idea').length;
  
  nbLikes = 0;
  $('.stat-container--like .stat-indic').each(function(index){
    transformNB = parseInt($(this).text());
    nbLikes = nbLikes + transformNB;
  });
  
  nbRebounds = 0;
  $('.stat-container--rebound .stat-indic').each(function(index){
    transformNB = parseInt($(this).text());
    nbRebounds = nbRebounds + transformNB;
  });
  
  totalPoints = (nbIdeas * 10) + (nbLikes * 1) - (nbRebounds * 5);
  $('#img-points').text(totalPoints);
  
  
  /***ANIMATION***/
  $('.js-animate-points').addClass('animated shake');
  $('.icon-fadein').addClass('animated bounceIn');
  $('.challenge-cover').find('h2, h4').addClass('animated fadeInDown');
  
  $('.counter').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 1000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
  });

});



/*ADMIN COLORS*/

$('.color-list li').each(function(index){
  dataColor = $(this).attr('data-color');
  $(this).css('background-color', dataColor);
});

$('.color-list').on('click', 'li', function(){
  $('.color-list li').removeClass('selected');
  $(this).addClass('selected');
  $('.challenge-color').val($(this).attr('data-color'));
});