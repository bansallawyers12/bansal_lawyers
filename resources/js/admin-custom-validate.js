/**
 * Single customValidate implementation (data-valid contract) — vanilla (Phase 5).
 */

const requiredError = 'This field is required.';
const emailError = 'Please enter the valid email address.';
const minMsg = 'This field should be greater than or equal to ';
const maxMsg = 'This field should be less than or equal to ';
const equalMsg = 'This field should be equal to ';

function errorDisplay(error) {
    const span = document.createElement('span');
    span.className = 'custom-error';
    span.setAttribute('role', 'alert');
    span.textContent = error;
    return span;
}

function validateEmail(sEmail) {
    const filter =
        /^([\w-.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return filter.test(sEmail);
}

function resolveForm(formName) {
    return (
        document.querySelector(`form[name='${formName}']`) ||
        document.getElementById(`${formName}-form`) ||
        document.getElementById(formName)
    );
}

function fieldValue(el) {
    if (el.type === 'checkbox' || el.type === 'radio') {
        return el.checked ? el.value : '';
    }
    return (el.value || '').trim();
}

function showPopupLoader(show) {
    document.querySelectorAll('.popuploader').forEach((el) => {
        el.style.display = show ? 'block' : 'none';
        if (show) el.classList.remove('hidden-loader');
        else el.classList.add('hidden-loader');
    });
}

export function customValidate(formName) {
    try {
        showPopupLoader(true);

        const form = resolveForm(formName);
        if (!form) {
            console.error(`Form with name "${formName}" not found`);
            showPopupLoader(false);
            return false;
        }

        if (typeof window.tinymce !== 'undefined' && typeof window.tinymce.triggerSave === 'function') {
            window.tinymce.triggerSave();
        }

        let errorCount = 0;
        document.querySelectorAll('.custom-error').forEach((el) => el.remove());

        form.querySelectorAll('input[data-valid], select[data-valid], textarea[data-valid]').forEach((input) => {
            const dataValidation = input.getAttribute('data-valid');
            if (!dataValidation) return;

            const rules = dataValidation.split(/\s+/).filter(Boolean);
            let localErrors = 0;

            if (rules.includes('required')) {
                const forClass = input.getAttribute('class') || '';
                const value = fieldValue(input);
                if (forClass.includes('multiselect_subject')) {
                    if (value.length === 0) {
                        errorCount++;
                        localErrors++;
                        input.parentNode?.insertAdjacentElement('afterend', errorDisplay(requiredError));
                    }
                } else if (!value) {
                    errorCount++;
                    localErrors++;
                    input.insertAdjacentElement('afterend', errorDisplay(requiredError));
                }
            }

            if (localErrors > 0) return;

            if (rules.includes('email')) {
                const emailVal = fieldValue(input);
                if (emailVal !== '' && !validateEmail(emailVal)) {
                    errorCount++;
                    input.insertAdjacentElement('afterend', errorDisplay(emailError));
                }
            }

            const forMin = rules.find((a) => a.includes('min'));
            if (forMin) {
                const digit = forMin.split('-')[1];
                const value = fieldValue(input).length;
                if (Number(value) < Number(digit)) {
                    errorCount++;
                    input.insertAdjacentElement('afterend', errorDisplay(`${minMsg} ${digit} character.`));
                }
            }

            const forMax = rules.find((a) => a.includes('max'));
            if (forMax) {
                const digit = forMax.split('-')[1];
                const value = fieldValue(input).length;
                if (Number(value) > Number(digit)) {
                    errorCount++;
                    input.insertAdjacentElement('afterend', errorDisplay(`${maxMsg} ${digit} character.`));
                }
            }

            const forEqual = rules.find((a) => a.includes('equal'));
            if (forEqual) {
                const digit = forEqual.split('-')[1];
                const value = fieldValue(input)
                    .replace(/[^a-z0-9\s]/gi, '')
                    .replace(/[_\s]/g, '-').length;
                if (Number(value) != Number(digit)) {
                    errorCount++;
                    input.insertAdjacentElement('afterend', errorDisplay(`${equalMsg} ${digit} character.`));
                }
            }
        });

        if (errorCount > 0) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            showPopupLoader(false);
            return false;
        }

        form.submit();
        return true;
    } catch (error) {
        console.error('Error in customValidate:', error);
        showPopupLoader(false);
        return false;
    }
}

window.customValidate = customValidate;
