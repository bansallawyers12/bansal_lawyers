/**
 * Global TinyMCE defaults for self-hosted GPL usage.
 * Loaded after tinymce.min.js on admin pages.
 */
(function () {
    if (typeof tinymce === 'undefined' || tinymce._defaultsPatched) {
        return;
    }

    tinymce._defaultsPatched = true;

    function filePickerCallback(callback, value, meta) {
        if (meta.filetype !== 'image' && meta.filetype !== 'media') {
            return;
        }

        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', meta.filetype === 'image' ? 'image/*' : 'video/*');
        input.onchange = function () {
            var file = input.files && input.files[0];
            if (!file) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function () {
                callback(reader.result, { alt: file.name });
            };
            reader.readAsDataURL(file);
        };
        input.click();
    }

    function getCspNonce() {
        var meta = document.querySelector('meta[name="csp-nonce"]');
        return meta ? meta.getAttribute('content') : '';
    }

    var cspNonce = getCspNonce();

    var tinymceDefaults = {
        promotion: false,
        branding: false,
        license_key: 'gpl',
        file_picker_callback: filePickerCallback
    };

    if (cspNonce) {
        tinymceDefaults.csp_nonce = cspNonce;
    }

    window.tinymceDefaults = tinymceDefaults;

    var originalInit = tinymce.init.bind(tinymce);
    tinymce.init = function (settings) {
        if (Array.isArray(settings)) {
            settings = settings.map(function (item) {
                return Object.assign({}, tinymceDefaults, item || {});
            });
        } else {
            settings = Object.assign({}, tinymceDefaults, settings || {});
        }

        return originalInit(settings);
    };
})();
