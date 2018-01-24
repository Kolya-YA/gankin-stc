document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.toggle-menu').onclick = toggleMenu;
    window.onscroll = function() {
        arrowToTop.hidden = (pageYOffset < (document.documentElement.clientHeight / 2));
    };
    arrowToTop.onclick = function() {
        window.scrollTo(pageXOffset, 0);
    };
}, false);

function toggleMenu() {
    let headerSatus = document.querySelector('.page-header');
    if (headerSatus.classList.contains('page-header--opened')) {
        headerSatus.classList.add('page-header--closed');
        headerSatus.classList.remove('page-header--opened');
    } else {
        headerSatus.classList.add('page-header--opened');
        headerSatus.classList.remove('page-header--closed');
    }
}

document.addEventListener('DOMContentLoaded', function() {

    let rentTypeSelect = document.querySelector('select[name="EquipmentForm\[type\]"]');
    if (rentTypeSelect) {
        rentTypeSelect.onchange = changeRentAdd;
    }

    let trainingLevel = document.querySelector('select[name="SchoolForm\[level\]');
    if (trainingLevel) {
        trainingLevel.onchange = hiLevelOptions;
    }

    let percentToPayPal = document.getElementById('paypal_percent');
    if (percentToPayPal) {
        percentToPayPal.onchange = percentChange;
    }

    let percentToPayCard = document.getElementById('OrderForm_percent');
    if (percentToPayCard) {
        percentToPayCard.onchange = percentChange;
    }

}, false);

function percentChange() {
    let toPay = +document.getElementById('totalToPay').dataset.price;

    if (this.checked) toPay *= .2;
    document.getElementById('valueToPay').textContent = (toPay.toFixed(2) + ' €');
}

function hiLevelOptions() {
    let curLevel = this.value,
        levelNote = document.querySelector('.note'),
        lessonType = document.querySelector('select[name="SchoolForm\[lesson\]');

    if (curLevel === 'intermediate' || curLevel === 'sport') {
        levelNote.style.display = 'block';
        lessonType.options[1].selected = true;
        lessonType.options[2].disabled = true;
        lessonType.options[3].disabled = true;
    } else {
        levelNote.style.display = 'none';
        lessonType.options[1].selected = true;
        lessonType.options[2].disabled = false;
        lessonType.options[3].disabled = false;
    }
}

function changeRentAdd() {
    let typeOfRent = this.value;
    let addEqOpt = document.querySelectorAll('.rent-type');

    for (let eqOpt of addEqOpt) {
        eqOpt.style.display = 'none';
        let radioOpt = eqOpt.querySelectorAll('input');
        for (let opt of radioOpt) {
            opt.setAttribute("disabled", "disabled");
        }
    }

    if (typeOfRent === 'kite' || typeOfRent === 'wind') {
        let addEqOpt = document.querySelectorAll('.rent-type.' + typeOfRent);
        for (let eqOpt of addEqOpt) {
            eqOpt.style.display = 'block';
            let radioOpt = eqOpt.querySelectorAll('input');
            for (let opt of radioOpt) {
                opt.removeAttribute("disabled");
            }
        }
    }
}

$(function() {
  // $('.form-style-2').jqTransform();
  // $('.datepicker').datepicker({
  //   showOn: 'button',
  //   buttonImage: '/images/calendar.png',
  //   buttonImageOnly: true,
  //   dateFormat: 'dd-mm-yy',
  //   minDate: new Date((new Date()).getTime() + 2 * (24 * 60 * 60 * 1000)),
  // });

  // $('#OrderForm_percent, #paypal_percent').change(function() {
  //   var price = +$('#order .total').data('price');
	//
  //   if ($(this).is(':checked'))
  //     price *= .2;
	//
  //   $('#order .total .value').text(price.toFixed(2) + ' €');
  // });
	
  $('#btnPayPal').click(function() {
  // $('#order-page #form3 .button').click(function() {

    if ($('#paypal_accept').is(':checked'))
      $(this).parents('form').submit();
    else $('#paypal_accept').siblings('.errorMessage').show();
			
    return false;

  });
});

function switch_lang(lang) {
  $.cookie('lang', lang, {path: '/'});
  window.location.reload();
}

function update_rent_type() {
  let type = $('[name=EquipmentForm\\[type\\]]').val();

  $('.label.rent-type').hide();
  $('.label.rent-type input').prop('disabled', true);
  
  if (type == 'kite' || type == 'wind')
  {
    $('.label.rent-type.'+type).show();
    $('.label.rent-type.'+type+' input').prop('disabled', false);
  }
  
  let disabled = $('.label.rent-type :radio:disabled:checked');
  if (disabled) {
    $('.label.rent-type :radio:enabled[value='+disabled.val()+']').prop('checked', true);
  }
}

// window.onload = (function() {
//   let slider = $('#slide');
//   if (slider.length) {
//     slider.camera({
//       pagination      : false,
//       navigation      : false,
//       transPeriod     : 2000,
//       fx              : 'simpleFade',
//       time            : 7000
//     });
//   }
// });