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
    case (nbBolts >= 15 && nbBolts <= 18) :
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
  ideaUser = $(this).closest('.panel-idea').find('.user-idea-text').text();
  ideaID = $(this).closest('.panel-idea').find('.panel-footer').attr('data-id');
  
  $('.idea-title-delete').text(ideaTitle);
  $('.idea-p-delete').text(ideaP);
  $('.idea-user').text(ideaUser);
  $('.js-delete-idea-button').attr('href', '/admin/' + ideaID + '/delete');
});
