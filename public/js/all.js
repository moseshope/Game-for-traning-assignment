$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  })
}
});
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
  $('.time-left').each(function(){
    startDate = $(this).find('.progress.timeline').attr('data-start-date');
    endDate = $(this).find('.progress.timeline').attr('data-end-date');
    daysLeft = dateFns.differenceInCalendarDays(endDate, todayDate);
    
    if (daysLeft < 0){
      $(this).find('.time-left-indic').text('0 day left');
    }
    else{
      $(this).find('.time-left-indic').text(daysLeft + ' days left');
    }
      
    /*JAUGE*/
    totalDays = dateFns.differenceInCalendarDays(endDate, startDate);
    currentPos = dateFns.differenceInCalendarDays(todayDate, startDate);
    posProgressBar = (currentPos / totalDays) * 100;
    
    $(this).find('.progress-bar').css('width', posProgressBar + '%');
    
    if ($('.time-closed').length == 1){
      $(this).find('.time-closed').html('<i class="fa fa-lock"></i> Challenge closed')
      $(this).find('.progress-bar').css('width','100%');
    }
  });
  
  
  
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
  
  /*ANIMATION HOME*/
  $('.home-cover h1').addClass('animated fadeInDown');
  $('.home-cover p').addClass('animated bounceInLeft');
  $('.panel-challenge').addClass('animated fadeIn');
  
  
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
function checkFirstTime(currentTab){
  console.log(currentTab);
  nbSelected = $('.tabs-scenario .tab-pane').eq(currentTab).find('.panel-element--selected').length;
  if (nbSelected > 0){
    return false;
  }
  else{
    return true;
  }
}

function updateDisruptive(){
  nbBolts = $('.element-recap .fa-bolt').length;
  console.log(nbBolts);
  
  switch (true) {
    case (nbBolts < 10) :
      $('.gauge-step').removeClass('gauge-step--active');
      $('.gauge-step').eq(0).addClass('gauge-step--active');
      break;
    case (nbBolts >= 11 && nbBolts < 14) :
    $('.gauge-step').removeClass('gauge-step--active');
      $('.gauge-step').eq(1).addClass('gauge-step--active');
      break;
    case (nbBolts >= 15 && nbBolts < 18) :
    $('.gauge-step').removeClass('gauge-step--active');
      $('.gauge-step').eq(2).addClass('gauge-step--active');
      break;
  }
  
  $('.elements-form input[name="disruptive"]').val(nbBolts);
}

currentTab = 0;
allowNext = false;

$('.js-btn-element-next').on('click', function(){
  $('.js-btn-element-previous').removeAttr('disabled');
  currentTab++;
  if (currentTab == 5){
      $('.js-btn-element-next').attr('disabled', 'disabled');
  }

  if (currentTab+1 > $('.ideas-create .tab-pane').length){
    currentTab--;
  }
  else{
    $('.tab-pane--active').next().addClass('in active tab-pane--active');
    $('.tab-pane--active').first().removeClass('in active tab-pane--active');
  }
  console.log(currentTab);
  
  // $('.panel-element').removeClass('ui-droppable');
  // $('.element-recap').eq(currentTab).find('.panel-element').addClass('panel-element--filling ui-droppable');
  
});

$('.js-btn-element-previous').on('click', function(){
  $('.js-btn-element-next').removeAttr('disabled');
  currentTab--;
  
  if (currentTab == '0'){
    $('.js-btn-element-previous').attr('disabled', 'disabled');
  }

  if (currentTab < 0){
    currentTab++;
  }
  else{
    $('.tab-pane--active').prev().addClass('in active tab-pane--active');
    $('.tabs-scenario .tab-pane').eq(currentTab+1).removeClass('in active tab-pane--active');

  }
});

$('.tabs-scenario .panel-element').on('click', function(){

  $elementText = $(this).find('.panel-body strong').text();
  $elementRating = Number($(this).find('.panel-footer').text());

  $(this).closest('.tab-pane').find('.panel-element').removeClass('panel-element--selected');
  $(this).addClass('panel-element--selected');
  $('.element-recap').eq(currentTab).find('.panel-element').removeClass('panel-element--filling').addClass('panel-element--filled');

  /*CLEAN DIV*/
  $('.element-recap').eq(currentTab).find('.panel-element .placeholder-plus').remove();
  $('.element-recap').eq(currentTab).find('.panel-element .panel-body').children().remove();
  $('.element-recap').eq(currentTab).find('.panel-element .panel-footer').children().remove();


  /*INSERT DATA*/
  $('.element-recap').eq(currentTab).find('.panel-element .panel-body').html('<strong>' + $elementText +'</strong>');
  $('.story').eq(currentTab).text($elementText);
  
  for (i=0;i<$elementRating;i++){
    $('.element-recap').eq(currentTab).find('.panel-element .panel-footer').append('<i class="fa fa-bolt"></i>');
  }
  // $('.element-recap').eq(currentTab).find('.panel-element .panel-footer').html($elementRating);

  /*Fill form elements hidden input*/
  $('.elements-form input').eq(currentTab).val($elementText);
  $('input[name=rebound]').val(false);

  var elementsFilled = $('.panel-element--filled').length;

  if (elementsFilled === $('.element-recap').length){
    $('.js-btn-switch-write').attr('disabled', false).removeClass('btn-main--disabled');
  }
  
  updateDisruptive();

});


$('.js-btn-switch-write').on('click', function(){
  $('.ideas-create').hide('fast');
  $('.ideas-propose').show('fast');
  $(this).hide('fast');
});

$('.js-modify-elements').on('click', function(){
  $('.ideas-propose').hide('fast');
  $('.ideas-create').show('fast');
  $('.js-btn-switch-write').show('fast');
});


/****DRAG AND DROP****/
// $(".tabs-scenario .panel-element").draggable({
//   appendTo: ".ui-droppable, .panel-element--filling",
//   refreshPositions: true,
//   helper: "clone"
// });
// $( ".panel-element--filling, .ui-droppable" ).droppable({
//     activeClass: "ui-state-default",
//     hoverClass: "ui-state-hover",
//     refreshPositions: true,
//     accept: ":not(.ui-sortable-helper)",
//     drop: function(event, ui) {
//       $(ui.draggable).click();
//       // $(this).addClass('ui-droppable');
//     }
//   })

  $('.tabs-scenario .tab-pane').eq(0).find('.panel-element').draggable({
    appendTo: ".droppable0",
    helper: "clone"
  });
  $( ".droppable0" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });
    
  $('.tabs-scenario .tab-pane').eq(1).find('.panel-element').draggable({
    appendTo: ".droppable1",
    helper: "clone"
  });
  $( ".droppable1" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });
  
  $('.tabs-scenario .tab-pane').eq(2).find('.panel-element').draggable({
    appendTo: ".droppable2",
    helper: "clone"
  });
  $( ".droppable2" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });

  $('.tabs-scenario .tab-pane').eq(3).find('.panel-element').draggable({
    appendTo: ".droppable3",
    helper: "clone"
  });
  $( ".droppable3" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });
  
  $('.tabs-scenario .tab-pane').eq(4).find('.panel-element').draggable({
    appendTo: ".droppable4",
    helper: "clone"
  });
  $( ".droppable4" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });
  
  $('.tabs-scenario .tab-pane').eq(5).find('.panel-element').draggable({
    appendTo: ".droppable5",
    helper: "clone"
  });
  $( ".droppable5" ).droppable({
    accept: ":not(.ui-sortable-helper)",
    drop: function(event, ui) {
      $(ui.draggable).click();
      $(this).addClass('ui-droppable');
      $(this).addClass('animated bounceIn');
      setTimeout(function(){
          $('.panel-element').removeClass('bounceIn');
      }, 1000);
    }
  });
//rebound


//DELETE_IDEA

$('.js-modal-delete').on('click', function(){
  ideaTitle = $(this).closest('.panel-idea').find('h3').text();
  ideaP = $(this).closest('.panel-idea').find('h3').next().text();
  ideaUser = $(this).closest('.panel-idea').find('.user-idea').text();
  ideaID = $(this).closest('.panel-idea').find('.panel-footer').attr('data-id');
  
  $('.idea-title-delete').text(ideaTitle);
  $('.idea-p-delete').text(ideaP);
  $('.idea-user').text(ideaUser);
  $('.js-delete-idea-button').attr('href', '/admin/' + ideaID + '/delete');
});

//# sourceMappingURL=all.js.map
