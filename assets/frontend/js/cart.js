

$('body').delegate('#saveTax', 'click', function() {

    $.ajax({type: "POST",
        async: 'false',
        url: baseurl + "apply-tax-values",
        dataType: "json",
        data: $("#cart_update").serialize(),
        success: function(data) {
            //alert(data.cart_data);
            $('#full_cart').replaceWith(data.cart_data)
            alert(data.msg);
        }
    })

});

$('body').delegate('#saveCoupon', 'click', function() {

    $.ajax({
        type: "POST",
        async: 'false',
        url: baseurl + "apply-coupon-code",
        dataType: "json",
        data: $("#cart_update").serialize(),
        success: function(data) {
            
            if (data.cart_data) {
                $('#full_cart').replaceWith(data.cart_data)
                alert(data.msg);
            } else {
                alert(data.msg);
            }
        }
    })
});
$('body').delegate('#country_id', 'change', function() {
    var country_id = $(this).val();

    if (country_id != '') {

        $.ajax({
            type: "POST",
            url: baseurl + "ajax-province-list",
            data: {
                "country_id": country_id
            },
            dataType: "json",
            success: function(data) {
                $('#province').html('');
                $('#city').html('');
                if (data.success) {
                    $('#province').html('<option value="">Select Province</option>');
                   // $('#city').html('<option value="">Select Province First</option>');
                    $.each(data.province_list, function(key, value) {
                       //  alert(value.province_id);
                        $('#province').append('<option  value="' + value.province_id + '"> ' + value.province_name + '</option>');
                    });
                } else {
                    $('#province').html('<option value="">No Record Found</option>');
                    $('#city').html('<option value="">Select Province First</option>');
                }
                //$('#province_id').append('<option value="">No Province Found</option>');
            }
        });
    }
});

