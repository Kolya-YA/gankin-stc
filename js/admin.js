$(function(){
	tinymce.init({
		selector: ".wysiwyg",
		plugins: ["code", "link"],
		fontsize_formats: "8pt 9pt 10pt 11pt 12pt 26pt 36pt",
		toolbar: "insertfile undo redo | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor", 
	});
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
	
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd",
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

