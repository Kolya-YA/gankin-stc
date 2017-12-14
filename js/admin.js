$(function(){
	tinymce.init({
		selector: '.wysiwyg',
		height: 400,
		plugins: ['code', 'link', 'lists', 'image', 'charmap', 'visualblocks'],
		toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | visualblocks code',
	});

	tinymce.init({
		toolbar: 'undo redo | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | bullist numlist | outdent indent',
 })

	$('.multilang-field .switch').click(function(){
		var field = $(this).parents('.multilang-field');
		var lang = $(this).data('lang');
		
		field.find('.switch').removeClass('active');
		$(this).addClass('active');
		
		field.find('.editor').hide();
		field.find('.editor[data-lang='+lang+']').show();
	});

	$('.row.branch input[type=checkbox].branch-switch').each(function(){
		if (!$(this).is(':checked'))
		{
			$(this).parents('.row').find('fieldset').hide();
		}
	});

	$('.row.branch input[type=checkbox].branch-switch').change(function(){
		if ($(this).is(':checked'))
		{
			$(this).parents('.row').find('fieldset').show();
		}
		else
			$(this).parents('.row').find('fieldset').hide();
	});

	$('.row.branch').each(function(){
		var row = $(this);
		var type = $(this).data('type');
		row.find('[name*=SchoolBranch]').each(function(){
			$(this).attr('name', $(this).attr('name').replace('SchoolBranch', 'branches['+type+']'));
		});
		row.find('[name*=SchoolPrice]').each(function(){
			var input = $(this);
			var duration = $(this).data('duration');
			var lesson_type = $(this).data('type');
			
			$(this).attr('name', $(this).attr('name').replace('SchoolPrice', 'prices['+type+']['+lesson_type+']['+duration+']'));
		});
	});
	
	$( '.datepicker' ).datepicker({
		dateFormat: 'yy-mm-dd',
	});
	
	$('#map_code').change(function(){
		 var matches = $(this).val().match(/[^\w]ll=(-?[\d.]+),(-?[\d.]+)/);
		
		if (matches.length == 3)
		{
			var lat = parseFloat(matches[1]);
			var lng = parseFloat(matches[2]);
			
			$('#School_latitude').val(lat);
			$('#School_longitude').val(lng);
		}
	});

});