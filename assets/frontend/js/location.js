//$('body').delegate('#country_id', 'change', function() {
//    var country_id = $(this).val();
//    
//    if (country_id != '') {
//        
//        $.ajax({
//            type: "POST",
//            url: baseurl + "ajax-province-list",
//            data: {
//                "country_id": country_id
//            },
//            dataType: "json",
//            success: function(data) {
//                $('#province').html('');
//                $('#city').html('');
//                if (data.success) {
//                    $('#province').html('<option value="">Select Province</option>');
//                    $('#city').html('<option value="">Select Province First</option>');
//                    $.each(data.province_list, function(key, value) {
//                       // alert(value.country_id);
//                        $('#province').append('<option value="' + value.province_id + '">' + value.province_name + '</option>');
//                    });
//                } else {
//                    $('#province').html('<option value="">No Record Found</option>');
//                    $('#city').html('<option value="">Select Province First</option>');
//                }
//
//                //$('#province_id').append('<option value="">No Province Found</option>');
//
//            }
//        });
//    }
//});
