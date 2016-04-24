console.log('Hello');

$('.panel-element').on('click', function(){
  /*ADD STYLE*/
  $(this).closest('.element').find('.panel-element').removeClass('panel-element--selected');
  $(this).addClass('panel-element--selected');
  $elementText = $(this).find('.panel-body strong').text();
  $elementRating = $(this).find('.material-icons').length;
  /*Fill steps*/
  $currentElement = $(this).closest('.element');
  $indexElement = $('.element').index($currentElement);
  
  $('.challenge-step').eq($indexElement).addClass('.challenge-step--done');
  
  $('.recap-element').eq($indexElement).addClass('recap-element--filled').find('.element-name').text($elementText);
  $('.recap-element').eq($indexElement).find('.element-rating').html($elementRating + '<i class="material-icons">star</i>');
});