
$(document).ready(function () {

    $.get('https://openexchangerates.org/api/latest.json?app_id=f5507bc893f44f00bcbc057db0ea0e7c',
        function(data) {
            if ( typeof fx !== "undefined" && fx.rates ) {
                fx.rates = data.rates;
                fx.base = data.base;
            }

            $.each(data.rates, function(key, value) {
                $('select.currency').append('<option value="' + key + '">' + key + '</option>');
            });

            $('#currency , #inputValue').on('keyup change', function () {
                $('.balance').html()
                let changingCurrency = $('select.currency').val(),
                    changingValue = $('#inputValue').val();
                if(changingValue && changingCurrency ){
                    $('#btn-submit').prop('disabled', false);
                   let gettingValue = fx.convert(changingValue, {from: "UAH", to: changingCurrency})
                    $('#outputValue').val(Math.fround(gettingValue).toFixed(2))
                }else{
                    $('#btn-submit').prop('disabled', true);
                    $('#outputValue').val('')

                }
            });
        });


});
