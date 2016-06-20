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

currentTab = 0;
allowNext = false;

$('.js-btn-element-next').on('click', function(){

  currentTab++;

  if (currentTab+1 > $('.ideas-create .tab-pane').length){
    currentTab--;
    console.log('STOP');
  }
  else{
    $('.tab-pane--active').next().addClass('in active tab-pane--active');
    $('.tab-pane--active').first().removeClass('in active tab-pane--active');
  }

});

$('.js-btn-element-previous').on('click', function(){
  currentTab--;

  if (currentTab < 0){
    currentTab++;
    console.log('STOP');
  }
  else{
    $('.tab-pane--active').prev().addClass('in active tab-pane--active');
    $('.tabs-scenario .tab-pane').eq(currentTab+1).removeClass('in active tab-pane--active');

  }
});

$('.tabs-scenario .panel-element').on('click', function(){

  $elementText = $(this).find('.panel-body strong').text();
  $elementRating = $(this).find('.panel-footer').children().clone();

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
  $('.element-recap').eq(currentTab).find('.panel-element .panel-footer').html($elementRating);

  /*Fill form elements hidden input*/
  $('.elements-form input').eq(currentTab).val($elementText);
  $('input[name=rebound]').val(false);

  var elementsFilled = $('.panel-element--filled').length;

  if (elementsFilled === $('.element-recap').length){
      $('.js-btn-switch-write').attr('disabled', false).removeClass('btn-main--disabled');
    }

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

//rebound
