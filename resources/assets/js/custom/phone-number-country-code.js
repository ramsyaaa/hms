// 'use strict';
//
// let input = document.querySelector('.phoneNumber'),
//     errorMsg = document.querySelector('.error-msg'),
//     validMsg = document.querySelector('.valid-msg');
//
// let errorMap = [
//     'Invalid number',
//     'Invalid country code',
//     'Too short',
//     'Too long',
//     'Invalid number'];
//
// // initialise plugin
// let intl = window.intlTelInput(input, {
//     initialCountry: 'auto',
//     separateDialCode: true,
//     geoIpLookup: function (success, failure) {
//         $.get('https://ipinfo.io', function () {
//         }, 'jsonp').always(function (resp) {
//             var countryCode = (resp && resp.country)
//                 ? resp.country
//                 : '';
//             success(countryCode);
//         });
//     },
//     utilsScript: $('.utilsScript').val(),
// });
//
// let reset = function () {
//     input.classList.remove('error');
//     errorMsg.innerHTML = '';
//     errorMsg.classList.add('d-none');
//     validMsg.classList.add('d-none');
// };
//
// input.addEventListener('blur', function () {
//     reset();
//     if (input.value.trim()) {
//         if (intl.isValidNumber()) {
//             validMsg.classList.remove('d-none');
//         } else {
//             input.classList.add('error');
//             var errorCode = intl.getValidationError();
//             errorMsg.innerHTML = errorMap[errorCode];
//             errorMsg.classList.remove('d-none');
//         }
//     }
// });
//
// // on keyup / change flag: reset
// input.addEventListener('change', reset);
// input.addEventListener('keyup', reset);
// const phoneNo = $('.phoneNo').val();
// if (typeof phoneNo != 'undefined' && phoneNo !== '') {
//     setTimeout(function () {
//         $('.phoneNumber').trigger('change');
//     }, 500);
// }
// listen('blur keyup change countrychange', function () {
//     if (typeof phoneNo != 'undefined' && phoneNo !== '') {
//         intl.setNumber('+' + phoneNo);
//         phoneNo = '';
//     }
//     let getCode = intl.selectedCountryData['dialCode'];
//     $('.prefix_code').val(getCode);
// });
//
// if ($('.isEdit').val()) {
//     let getCode = intl.selectedCountryData['dialCode'];
//     $('.prefix_code').val(getCode);
// }
//
// let getPhoneNumber = $('.phoneNumber').val();
// let removeSpacePhoneNumber = getPhoneNumber.replace(/\s/g, '');
// $('.phoneNumber').val(removeSpacePhoneNumber);
//
// $(document).ready(function () {
//     $('.phoneNumber').focus();
//     $('.phoneNumber').blur();
//     let getPhoneNumber = $('.phoneNumber').val();
//     let removeSpacePhoneNumber = getPhoneNumber.replace(/\s/g, '');
//     $('.phoneNumber').val(removeSpacePhoneNumber);
// });


'use strict';

document.addEventListener('turbo:load', loadPhoneNumberCountryCodeData)

function loadPhoneNumberCountryCodeData(){

    if (!$('.phoneNumber').length) {
        return false
    }
    Lang.setLocale($('.userCurrentLanguage').val())
    let input = document.querySelector('.phoneNumber'),
        errorMsg = document.querySelector('.error-msg'),
        validMsg = document.querySelector('.valid-msg');
    let errorMap = [
        Lang.get('messages.common.invalid_number'),
        Lang.get('messages.common.invalid_country_code'),
        Lang.get('messages.common.too_short'),
        Lang.get('messages.common.too_long'),];
    // initialise plugin
    if($('.isEdit').val()) {
        var countryValue = $('.country_iso').val()
    }
    else {
        var countryValue = $('.getISOCode').val()
    }
    let intl = window.intlTelInput(input, {
        initialCountry: countryValue,
        separateDialCode: true,
        geoIpLookup: function (success, failure) {
            $.get('https://ipinfo.io', function () {
            }, 'jsonp').always(function (resp) {
                var countryCode = (resp && resp.country)
                    ? resp.country
                    : '';
                success(countryCode);
            });
        },
        utilsScript: $('.utilsScript').val(),
    });

    let reset = function () {
        input.classList.remove('error');
        errorMsg.innerHTML = '';
        errorMsg.classList.add('d-none');
        validMsg.classList.add('d-none');
    };

    input.addEventListener('blur', function () {
        reset();
        if (input.value.trim()) {
            if (intl.isValidNumber()) {
                validMsg.classList.remove('d-none');
            } else {
                input.classList.add('error');
                var errorCode = intl.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove('d-none');
            }
        }
    });

// on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
    const phoneNo = $('.phoneNo').val();
    if (typeof phoneNo != 'undefined' && phoneNo !== '') {
        setTimeout(function () {
            $('.phoneNumber').trigger('change');
        }, 500);
    }

    listen('blur keyup change countrychange', function () {
        if (typeof phoneNo != 'undefined' && phoneNo !== '') {
            intl.setNumber('+' + phoneNo);
            phoneNo = ''
        }
        let getCode = intl.selectedCountryData['dialCode']
        $('.prefix_code').val(getCode)
    });

    if ($('.isEdit').val()) {
        let getCode = intl.selectedCountryData['dialCode']
        let country_iso = intl.selectedCountryData['iso2']
        $('.prefix_code').val(getCode)
        $('.country_iso').val(country_iso)
    }

    $('.phoneNumber').focus()
    $('.phoneNumber').blur()
    let getPhoneNumber = $('.phoneNumber').val()
    let removeDashPhoneNumber = getPhoneNumber.replaceAll('-', ' ')
    let removeSpacePhoneNumber = removeDashPhoneNumber.replace(/\s/g, '')
    $('.phoneNumber').val(removeSpacePhoneNumber)
}

