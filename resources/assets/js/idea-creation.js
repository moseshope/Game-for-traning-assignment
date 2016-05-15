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
  currentTab = $('.tab-pane--active').index('.tabs-scenario .tab-pane');
  
  if ( currentTab+1 < $('.tabs-scenario .tab-pane').length && allowNext == true  ){
    $('.tab-pane--active').removeClass('in active tab-pane--active');
    $('.tabs-scenario .tab-pane').eq(currentTab+1).addClass('active in tab-pane--active');
    $('.element-recap').removeClass('panel-element--filling');
    $('.element-recap').eq(currentTab+1).find('.panel-element').addClass('panel-element--filling');
    // $('.element-recap').eq(currentTab+1).find('.panel-element .panel-body').append('<div class="text-center placeholder-plus"><i class="fa fa-plus"></i></div>');
    currentTab = currentTab+1;
    allowNext = false;
  }
  else{
    alert('DERNIER ou FORBIDDEN');
  }
  
});

$('.js-btn-element-previous').on('click', function(){  
  currentTab = $('.tab-pane--active').index('.tabs-scenario .tab-pane');
  
  if (currentTab > 0){
    $('.tab-pane--active').removeClass('in active tab-pane--active');
    $('.tabs-scenario .tab-pane').eq(currentTab-1).addClass('active in tab-pane--active');
    $('.element-recap').removeClass('panel-element--filling');
    $('.element-recap').eq(currentTab-1).find('.panel-element').addClass('panel-element--filling');

  }
  else{
    alert('PREMIER');
  }
  currentTab = currentTab-1;
});

$('.tabs-scenario .panel-element').on('click', function(){
  allowNext = true;
  
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
  $('.element-recap').eq(currentTab).find('.panel-element .panel-footer').html($elementRating);
  
  var elementsFilled = $('.panel-element--filled').length;
  
  if (elementsFilled === $('.element-recap').length){
      $('.js-btn-switch-write').attr('disabled', false).removeClass('btn-main--disabled');
    }
  
});


$('.js-btn-switch-write').on('click', function(){
  $('.ideas-create').hide('fast');
  $('.ideas-propose').show('fast');
});

$('.js-modify-elements').on('click', function(){
  $('.ideas-propose').hide('fast');
  $('.ideas-create').show('fast');
});
