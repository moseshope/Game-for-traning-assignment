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
// $('.panel-element').on('click', function(){
//   /*ADD STYLE*/
//   $(this).closest('.element').find('.panel-element').removeClass('panel-element--selected');
//   $(this).addClass('panel-element--selected');
//   $elementText = $(this).find('.panel-body strong').text();
//   console.log($elementText);
//   $elementRating = $(this).find('.material-icons').length;
//   
//   /*Fill steps*/
//   $currentElement = $(this).closest('.element');
//   $indexElement = $('.element').index($currentElement);
//   
//   $('.challenge-step').eq($indexElement).addClass('challenge-step--done');
//   $('.recap-element').eq($indexElement).addClass('recap-element--filled').find('.element-name').text($elementText);
//   $('.recap-element').eq($indexElement).find('.element-rating').html($elementRating + '<i class="material-icons">star</i>');
//   
//   /*Fill form elements hidden input*/
//   $('.elements-form input').eq($indexElement).val($elementText);
//   
//   var elementsFilled = $('.recap-element--filled').length;
//   
//   if (elementsFilled === $('.recap-element').length){
//     $('#btn-create').collapse('show');
//   }
//   
// });
// 
// $('.recap-element').on('click', function(){
//   $textElement = $(this).find('.element-name').text();
//   // $(this).addClass('recap-element-used');
//   $('textarea').insertAtCaret($textElement);
// });
// 
// 
// $('.challenge-step').on('click', function(){
//   $('.challenge-step').removeClass('challenge-step--active');
//   $(this).addClass('challenge-step--active');
// });
// 
// $('.btn-create-idea').on('click', function(){
//   if ($('.recap-element--filled').length === $('.recap-element').length){
//     $('.tab-content').collapse('hide');
//     $('.idea-form').collapse('show');
//   }
// });


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
    console.log('DERNIER ou FORBIDDEN');
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
    console.log('PREMIER');
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
  
  /*Fill form elements hidden input*/
  $('.elements-form input').eq(currentTab).val($elementText);
  
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

//# sourceMappingURL=all.js.map
