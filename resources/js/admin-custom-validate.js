/**
 * Single customValidate implementation (data-valid contract).
 * Ported from public/js/custom-form-validation.js — same API for admin forms.
 * Uses window.jQuery only (layout sync) to avoid a second jQuery instance.
 */

const requiredError = 'This field is required.';
const emailError = 'Please enter the valid email address.';
const minMsg = 'This field should be greater than or equal to ';
const maxMsg = 'This field should be less than or equal to ';
const equalMsg = 'This field should be equal to ';

function errorDisplay(error) {
    return `<span class="custom-error" role="alert">${error}</span>`;
}

function validateEmail(sEmail) {
    const filter = /^([\w-.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return filter.test(sEmail);
}

export function customValidate(formName) {
    const $ = window.jQuery;
    try {
        $('.popuploader').show();

        let form = $(`form[name='${formName}']`);
        if (form.length === 0) {
            form = $(`#${formName}-form`);
        }
        if (form.length === 0) {
            form = $(`#${formName}`);
        }
        if (form.length === 0) {
            console.error(`Form with name "${formName}" not found`);
            $('.popuploader').hide();
            return false;
        }

        if (typeof window.tinymce !== 'undefined' && typeof window.tinymce.triggerSave === 'function') {
            window.tinymce.triggerSave();
        }

        let i = 0;
        $('.custom-error').remove();

        form.find(':input[data-valid]').each(function () {
            const dataValidation = $(this).attr('data-valid');
            if (!dataValidation) return;

            const splitDataValidation = dataValidation.split(' ');
            let j = 0;

            if ($.inArray('required', splitDataValidation) !== -1) {
                const forClass = $(this).attr('class') || '';
                if (forClass.indexOf('multiselect_subject') !== -1) {
                    const value = $.trim($(this).val());
                    if (value.length === 0) {
                        i++;
                        j++;
                        $(this).parent().after(errorDisplay(requiredError));
                    }
                } else if (!$.trim($(this).val())) {
                    i++;
                    j++;
                    $(this).after(errorDisplay(requiredError));
                }
            }

            if (j <= 0) {
                if ($.inArray('email', splitDataValidation) !== -1) {
                    const emailVal = $.trim($(this).val());
                    if (emailVal !== '' && !validateEmail(emailVal)) {
                        i++;
                        $(this).after(errorDisplay(emailError));
                    }
                }

                const forMin = splitDataValidation.find((a) => a.includes('min'));
                if (typeof forMin !== 'undefined') {
                    const digit = forMin.split('-')[1];
                    const value = $.trim($(this).val()).length;
                    if (value < digit) {
                        i++;
                        $(this).after(errorDisplay(`${minMsg} ${digit} character.`));
                    }
                }

                const forMax = splitDataValidation.find((a) => a.includes('max'));
                if (typeof forMax !== 'undefined') {
                    const digit = forMax.split('-')[1];
                    const value = $.trim($(this).val()).length;
                    if (value > digit) {
                        i++;
                        $(this).after(errorDisplay(`${maxMsg} ${digit} character.`));
                    }
                }

                const forEqual = splitDataValidation.find((a) => a.includes('equal'));
                if (typeof forEqual !== 'undefined') {
                    const digit = forEqual.split('-')[1];
                    const value = ($.trim($(this).val()).replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-')).length;
                    if (value != digit) {
                        i++;
                        $(this).after(errorDisplay(`${equalMsg} ${digit} character.`));
                    }
                }
            }
        });

        if (i > 0) {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            $('.popuploader').hide();
            return false;
        }

        if (form[0]) {
            form[0].submit();
        }
        return true;
    } catch (error) {
        console.error('Error in customValidate:', error);
        window.jQuery('.popuploader').hide();
        return false;
    }
}

window.customValidate = customValidate;
