/*DATE*/


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
  
  
  
});





$('.color-list li').each(function(index){
  dataColor = $(this).attr('data-color');
  $(this).css('background-color', dataColor);
});

$('.color-list').on('click', 'li', function(){
  $('.color-list li').removeClass('selected');
  $(this).addClass('selected');
  $('.challenge-color').val($(this).attr('data-color'));
});