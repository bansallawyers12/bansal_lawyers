var requiredError = 'This field is required.';
var emailError = "Please enter the valid email address.";
var captcha = "Captcha invalid.";
var maxError = "Number should be less than or equal to ";
var min = "This field should be greater than or equal to ";
var max = "This field should be less than or equal to ";
var equal = "This field should be equal to ";

function customValidate(formName, savetype = '')
{
	try {
		$(".popuploader").show();

		var form = $("form[name='"+formName+"']");
		if (form.length === 0) {
			form = $('#' + formName + '-form');
		}
		if (form.length === 0) {
			form = $('#' + formName);
		}
		if (form.length === 0) {
			console.error('Form with name "' + formName + '" not found');
			$(".popuploader").hide();
			return false;
		}

		if (typeof tinymce !== 'undefined' && typeof tinymce.triggerSave === 'function') {
			tinymce.triggerSave();
		}

		var i = 0;
		$(".custom-error").remove();

		form.find(':input[data-valid]').each(function(){
			var dataValidation = $(this).attr('data-valid');
			if (!dataValidation) {
				return;
			}
			var splitDataValidation = dataValidation.split(' ');

			var j = 0;
			if($.inArray("required", splitDataValidation) !== -1)
				{
					var for_class = $(this).attr('class') || '';
					if(for_class.indexOf('multiselect_subject') != -1)
						{
							var value = $.trim($(this).val());
							if (value.length === 0)
								{
									i++;
									j++;
									$(this).parent().after(errorDisplay(requiredError));
								}
						}
					else
						{
							if( !$.trim($(this).val()) )
								{
									i++;
									j++;
									$(this).after(errorDisplay(requiredError));
								}
						}
				}
			if(j <= 0)
				{
					if($.inArray("email", splitDataValidation) !== -1)
						{
							if(!validateEmail($.trim($(this).val())))
								{
									i++;
									$(this).after(errorDisplay(emailError));
								}
						}

					var forMin = splitDataValidation.find(a =>a.includes("min"));
					if(typeof forMin != 'undefined')
						{
							var breakMin = forMin.split('-');
							var digit = breakMin[1];

							var value = $.trim($(this).val()).length;
							if(value < digit)
								{
									i++;
									$(this).after(errorDisplay(min+' '+digit+' character.'));
								}
						}

					var forMax = splitDataValidation.find(a =>a.includes("max"));
					if(typeof forMax != 'undefined')
						{
							var breakMax = forMax.split('-');
							var digit = breakMax[1];

							var value = $.trim($(this).val()).length;
							if(value > digit)
								{
									i++;
									$(this).after(errorDisplay(max+' '+digit+' character.'));
								}
						}

					var forEqual = splitDataValidation.find(a =>a.includes("equal"));
					if(typeof forEqual != 'undefined')
						{
							var breakEqual = forEqual.split('-');
							var digit = breakEqual[1];

							var value = ($.trim($(this).val()).replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-')).length;
							if(value != digit)
								{
									i++;
									$(this).after(errorDisplay(equal+' '+digit+' character.'));
								}
						}
				}
		});

		if(i > 0)
			{
				$('html, body').animate({scrollTop:0}, 'slow');
				$(".popuploader").hide();
				return false;
			}

		if (form[0]) {
			form[0].submit();
		}
		return true;

	} catch (error) {
		console.error('Error in customValidate:', error);
		$(".popuploader").hide();
		return false;
	}
}

function errorDisplay(error) {
	return "<span class='custom-error' role='alert'>"+error+"</span>";
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
		return true;
	}
    else {
		return false;
    }
}
