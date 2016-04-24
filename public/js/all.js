$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
$('.panel-element').on('click', function(){
  /*ADD STYLE*/
  $(this).closest('.element').find('.panel-element').removeClass('panel-element--selected');
  $(this).addClass('panel-element--selected');
  $elementText = $(this).find('.panel-body strong').text();
  $elementRating = $(this).find('.material-icons').length;
  
  /*Fill steps*/
  $currentElement = $(this).closest('.element');
  $indexElement = $('.element').index($currentElement);
  
  $('.challenge-step').eq($indexElement).addClass('challenge-step--done');
  $('.recap-element').eq($indexElement).addClass('recap-element--filled').find('.element-name').text($elementText);
  $('.recap-element').eq($indexElement).find('.element-rating').html($elementRating + '<i class="material-icons">star</i>');
  
  var elementsFilled = $('.recap-element--filled').length;
  
  if (elementsFilled === $('.recap-element').length){
    $('#btn-create').collapse('show');
  }
  
});

$('.challenge-step').on('click', function(){
  $('.challenge-step').removeClass('challenge-step--active');
  $(this).addClass('challenge-step--active');
});

$('.btn-create-idea').on('click', function(){
  if ($('.recap-element--filled').length === $('.recap-element').length){
    $('.tab-content').collapse('hide');
    $('.idea-form').collapse('show');
  }
})


//# sourceMappingURL=all.js.map
