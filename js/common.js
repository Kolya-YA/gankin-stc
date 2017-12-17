$(function() {
  $('.form-style-2').jqTransform();
  $( '.datepicker' ).datepicker({
    showOn: 'button',
    buttonImage: '/images/calendar.png',
    buttonImageOnly: true,
    dateFormat: 'dd-mm-yy',
    minDate: new Date((new Date()).getTime() + 2 * (24 * 60 * 60 * 1000)),
  });

  if ($('[name=EquipmentForm\\[type\\]]').length) {
    $('[name=EquipmentForm\\[type\\]]').parent().find('ul a').click(update_rent_type);
    update_rent_type();
  }

  if ($('[name=SchoolForm\\[level\\]]').length)
  {
    $('[name=SchoolForm\\[level\\]]').parent().find('ul a').click(update_school_level);
    update_school_level();
  }
	
  $('#OrderForm_percent, #paypal_percent').change(function() {
    var price = +$('#order .total').data('price');
		
    if ($(this).is(':checked'))
      price *= .2;
		
    $('#order .total .value').text(price);
  });
	
  $('#order-page #form3 .button').click(function() {
    if ($('#paypal_accept').is(':checked'))
      $(this).parents('form').submit();
    else
    {
      $('#paypal_accept').siblings('.errorMessage').show();
    }
			
    return false;
  });
});

function switch_lang(lang)
{
  $.cookie('lang', lang, {path: '/'});
  window.location.reload();
}

function update_school_level()
{
  var level = $('[name=SchoolForm\\[level\\]]').val();
	
  var ul = $('[name=SchoolForm\\[lesson\\]]').parents('.jqTransformSelectWrapper').find('ul');
	
  if (level == 'intermediate' || level == 'sport')
  {
    $('.main-search .note').show();
    ul.children('li:nth-child(2)').children('a')[0].click();
    ul.children('li:nth-child(3),li:nth-child(4)').hide();
  }

  else

  {
    $('.main-search .note').hide();
    ul.children('li:nth-child(3),li:nth-child(4)').show();
  }
		
}

function update_rent_type()
{
  var type = $('[name=EquipmentForm\\[type\\]]').val();
	
  $('.label.rent-type').hide();
  $('.label.rent-type input').prop('disabled', true);
	
  if (type == 'kite' || type == 'wind')
  {
    $('.label.rent-type.'+type).show();
    $('.label.rent-type.'+type+' input').prop('disabled', false);
  }
	
  var disabled = $('.label.rent-type :radio:disabled:checked');
  if (disabled)
  {
    $('.label.rent-type :radio:enabled[value='+disabled.val()+']').prop('checked', true);
  }
}

window.onload = (function() {
  var slider = $('#slide');
  if (slider.length)
  {
    slider.camera({
      pagination      : false, 
      navigation      : false,
      transPeriod     : 2000, 
      fx              : 'simpleFade', 
      time            : 7000
    });
  }
});