
// Author: Danilo M.
function restrict_rating_score(chck1, chck2, chck3, chck4, chck5, chckNA, comment, msg) {


    chck1.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', false);
            comment.keyup(function () {
                var charNum = comment.val();
                if (charNum.length > 0) {
                    msg.attr('hidden', true);
                } else {
                    msg.attr('hidden', false);
                }
            })

        }
    });
    chck2.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', false);
            comment.keyup(function () {
                var charNum = comment.val();
                if (charNum.length > 0) {
                    msg.attr('hidden', true);
                } else {
                    msg.attr('hidden', false);
                }
            })

        }
    })
    chck3.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', true)
        }
    });
    chck4.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', false);
            comment.keyup(function () {
                var charNum = comment.val();
                if (charNum.length > 0) {
                    msg.attr('hidden', true);
                } else {
                    msg.attr('hidden', false);
                }
            })

        }
    })
    chck5.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', false);
            comment.keyup(function () {
                var charNum = comment.val();
                if (charNum.length > 0) {
                    msg.attr('hidden', true);
                } else {
                    msg.attr('hidden', false);
                }
            })

        }
    })
    chckNA.on('change', function () {
        if ($(this).attr('checked', true)) {
            msg.attr('hidden', true)
        }
    });
}

//KRA & KPI CALCULATION
function calculate_kra() {
    var kraAverage = 0;
    var val = [];
    var kra_rating1 = [];
    $('#kra1-checkbox input:checked').each(function () {
        kra_rating1.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var kra_rating2 = [];
    $('#kra2-checkbox input:checked').each(function () {
        kra_rating2.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var kra_rating3 = [];
    $('#kra3-checkbox input:checked').each(function () {
        kra_rating3.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var kra_rating4 = [];
    $('#kra4-checkbox input:checked').each(function () {
        kra_rating4.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var kra_rating5 = [];
    $('#kra5-checkbox input:checked').each(function () {
        kra_rating5.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var kra_rating6 = [];
    $('#kra6-checkbox input:checked').each(function () {
        kra_rating6.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })

    //check if checked
    var i = 0;
    if (kra_rating4 == '') {
        kra_rating4 = 0;
        i++;
    }
    if (kra_rating5 == '') {
        kra_rating5 = 0;
        i++;
    }
    if (kra_rating6 == '') {
        kra_rating6 = 0;
        i++;
    }

    //get the value count of NA/0
    var count = 0;
    val.forEach(function (e) {
        if (e == 0 || e == '') {
            i++;
        }
    })
    var zero = 6 - parseFloat(i);

    //KRA & KPI COMPUTATION
    var kraTotal = (parseFloat(kra_rating1) + parseFloat(kra_rating2) + parseFloat(kra_rating3) + parseFloat(kra_rating4) + parseFloat(kra_rating5) + parseFloat(kra_rating6)) / parseFloat(zero);
    var kraAverage = parseFloat(kraTotal) * 0.60;
    //CHECK KRA IF NaN
    if (isNaN(kraTotal)) {
        $('#kra-total').val('0.0');
    } else {
        $('#kra-total').val(kraTotal.toFixed(1));
    }
    //CHECK KRA AVERAGE IF Nan
    if (isNaN(kraAverage)) {
        $('#kra-average').val('0.0%');
    } else {
        $('#kra-average').val(kraAverage.toFixed(1));
        $('#kra-average1').val(kraAverage.toFixed(1));
    }
}


function calculate_gp() {
    var kraAverage = 0;
    var val = [];
    var gp1a_rate = [];
    $('.checkbox-gp1a input:checked').each(function () {
        gp1a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp1b_rate = [];
    $('.checkbox-gp1b input:checked').each(function () {
        gp1b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp1c_rate = [];
    $('.checkbox-gp1c input:checked').each(function () {
        gp1c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp2a_rate = [];
    $('.checkbox-gp2a input:checked').each(function () {
        gp2a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp2b_rate = [];
    $('.checkbox-gp2b input:checked').each(function () {
        gp2b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp2c_rate = [];
    $('.checkbox-gp2c input:checked').each(function () {
        gp2c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp3a_rate = [];
    $('.checkbox-gp3a input:checked').each(function () {
        gp3a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp3b_rate = [];
    $('.checkbox-gp3b input:checked').each(function () {
        gp3b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp3c_rate = [];
    $('.checkbox-gp3c input:checked').each(function () {
        gp3c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp4a_rate = [];
    $('.checkbox-gp4a input:checked').each(function () {
        gp4a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp4b_rate = [];
    $('.checkbox-gp4b input:checked').each(function () {
        gp4b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp4c_rate = [];
    $('.checkbox-gp4c input:checked').each(function () {
        gp4c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp5a_rate = [];
    $('.checkbox-gp5a input:checked').each(function () {
        gp5a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp5b_rate = [];
    $('.checkbox-gp5b input:checked').each(function () {
        gp5b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp5c_rate = [];
    $('.checkbox-gp5c input:checked').each(function () {
        gp5c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp6a_rate = [];
    $('.checkbox-gp6a input:checked').each(function () {
        gp6a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp6b_rate = [];
    $('.checkbox-gp6b input:checked').each(function () {
        gp6b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp6c_rate = [];
    $('.checkbox-gp6c input:checked').each(function () {
        gp6c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp7a_rate = [];
    $('.checkbox-gp7a input:checked').each(function () {
        gp7a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp7b_rate = [];
    $('.checkbox-gp7b input:checked').each(function () {
        gp7b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp7c_rate = [];
    $('.checkbox-gp7c input:checked').each(function () {
        gp7c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp8a_rate = [];
    $('.checkbox-gp8a input:checked').each(function () {
        gp8a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp8b_rate = [];
    $('.checkbox-gp8b input:checked').each(function () {
        gp8b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp8c_rate = [];
    $('.checkbox-gp8c input:checked').each(function () {
        gp8c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp9a_rate = [];
    $('.checkbox-gp9a input:checked').each(function () {
        gp9a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp9b_rate = [];
    $('.checkbox-gp9b input:checked').each(function () {
        gp9b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp9c_rate = [];
    $('.checkbox-gp9c input:checked').each(function () {
        gp9c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp10a_rate = [];
    $('.checkbox-gp10a input:checked').each(function () {
        gp10a_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp10b_rate = [];
    $('.checkbox-gp10b input:checked').each(function () {
        gp10b_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })
    var gp10c_rate = [];
    $('.checkbox-gp10c input:checked').each(function () {
        gp10c_rate.push($(this).attr('value'));
        val.push($(this).attr('value'));
    })

    //get the value count of NA/0
    var i = 0;
    var count = 0;
    val.forEach(function (e) {
        if (e == 0) {
            i++;
        }
    })
    var zero = 30 - parseFloat(i);

    var gpTotal = (parseFloat(gp1a_rate) + parseFloat(gp1b_rate) + parseFloat(gp1c_rate) + parseFloat(gp2a_rate) + parseFloat(gp2b_rate) + parseFloat(gp2c_rate) + parseFloat(gp3a_rate) + parseFloat(gp3b_rate) + parseFloat(gp3c_rate) + parseFloat(gp4a_rate) + parseFloat(gp4b_rate) + parseFloat(gp4c_rate) + parseFloat(gp5a_rate) + parseFloat(gp5b_rate) + parseFloat(gp5c_rate) + parseFloat(gp6a_rate) + parseFloat(gp6b_rate) + parseFloat(gp6c_rate) + parseFloat(gp7a_rate) + parseFloat(gp7b_rate) + parseFloat(gp7c_rate) + parseFloat(gp8a_rate) + parseFloat(gp8b_rate) + parseFloat(gp8c_rate) + parseFloat(gp9a_rate) + parseFloat(gp9b_rate) + parseFloat(gp9c_rate) + parseFloat(gp10a_rate) + parseFloat(gp10b_rate) + parseFloat(gp10c_rate)) / parseFloat(zero);

    var gpAverage = parseFloat(gpTotal) * 0.40;
    //GP TOTAL CONDITION CHECK
    if (isNaN(parseFloat(gpTotal))) {
        $('#gp-total').val('0');
    } else {
        $('#gp-total').val(gpTotal.toFixed(1));
    }
    //GP AVERAGE CONDITION CHECK
    if (isNaN(parseFloat(gpTotal))) {
        $('#gp-average').val(0);
    } else {
        $('#gp-average').val(gpAverage.toFixed(1));
    }

    //OAP TOTAL RATING
    var kraRating = $('#kra-average').val();
    var oapRating = parseFloat(kraRating) + parseFloat(gpAverage);
    if (isNaN(parseFloat(oapRating))) {
        $('#oap-rating').val('0');
    } else {
        $('#oap-rating').val(oapRating.toFixed(1));
    }
    //OAP RATING COMPUTATION
    if (gpAverage == '0' || isNaN(gpAverage)) {
        $('#oap-rating').val(kraAverage.toFixed(1));
    } else {
        $('#oap-rating').val(oapRating.toFixed(1));
    }
    //check the OAP RATING checkbox based on rating
    if (oapRating.toFixed(1) == 5.0) {
        $('#rating-5').prop('checked', true);
        $('#rating-1').prop('checked', false);
        $('#rating-2').prop('checked', false);
        $('#rating-3').prop('checked', false);
        $('#rating-4').prop('checked', false);
    } else if (oapRating.toFixed(1) >= 4.0 && oapRating.toFixed(1) <= 4.9) {
        $('#rating-4').prop('checked', true);
        $('#rating-1').prop('checked', false);
        $('#rating-2').prop('checked', false);
        $('#rating-3').prop('checked', false);
        $('#rating-5').prop('checked', false);
    } else if (oapRating.toFixed(1) >= 3.0 && oapRating.toFixed(1) <= 3.9) {
        $('#rating-3').prop('checked', true);
        $('#rating-1').prop('checked', false);
        $('#rating-2').prop('checked', false);
        $('#rating-4').prop('checked', false);
        $('#rating-5').prop('checked', false);
    } else if (oapRating.toFixed(1) >= 2.0 && oapRating.toFixed(1) <= 2.9) {
        $('#rating-2').prop('checked', true);
        $('#rating-1').prop('checked', false);
        $('#rating-3').prop('checked', false);
        $('#rating-4').prop('checked', false);
        $('#rating-5').prop('checked', false);
    } else if (oapRating.toFixed(1) >= 1.0 && oapRating.toFixed(1) <= 1.9) {
        $('#rating-1').prop('checked', true);
        $('#rating-2').prop('checked', false);
        $('#rating-3').prop('checked', false);
        $('#rating-4').prop('checked', false);
        $('#rating-5').prop('checked', false);
    } else {
        $('#rating-1').prop('checked', false);
        $('#rating-2').prop('checked', false);
        $('#rating-3').prop('checked', false);
        $('#rating-4').prop('checked', false);
        $('#rating-5').prop('checked', false);
    }
}


// restriction for EMPTY RATING's COMMENT WITH THE SUBMIT AJAX
//Author: Danilo M.
function scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s) {
    switch (true) {
        case comments1_msg:
            location.href = "#comments1";
            break;
        case comments2_msg:
            location.href = "#comments2";
            break;
        case comments3_msg:
            location.href = "#comments3";
            break;
        case comments4_msg:
            location.href = "#comments4";
            break;
        case comments5_msg:
            location.href = "#comments5";
            break;
        case comments6_msg:
            location.href = "#comments6";
            break;

        default:
            restriction_of_txtbox(myData, action_s);
    }
}


//RESTRICTION TO GENERAL PERFORMANCE FACTORS AND BEHAVIORAL INDICATORS
//Author: Danilo M.
function restriction_of_txtbox(myData, action_s) {
    //KRA
    var xkra1 = $('#kra1').val();
    var xkra2 = $('#kra2').val();
    var xkra3 = $('#kra3').val();
    var xkra4 = $('#kra4').val();
    var xkra5 = $('#kra5').val();
    var xkra6 = $('#kra6').val();
    //KPI
    var xkpi1 = $('#kpi1').val();
    var xkpi2 = $('#kpi2').val();
    var xkpi3 = $('#kpi3').val();
    var xkpi4 = $('#kpi4').val();
    var xkpi5 = $('#kpi5').val();
    var xkpi6 = $('#kpi6').val();

    //KPI & KRA COMMENTS
    var a_comment1 = $('#comments1').val();
    var b_comment2 = $('#comments2').val();
    var c_comment3 = $('#comments3').val();
    var d_comment4 = $('#comments4').val();
    var e_comment5 = $('#comments5').val();
    var f_comment6 = $('#comments6').val();

    // Bias for result
    var gp1a_comment = $('#gp1a-comment').val();
    var gp1b_comment = $('#gp1b-comment').val();
    var gp1c_comment = $('#gp1c-comment').val();

    //integrity
    var gp2a_comment = $('#gp2a-comment').val()
    var gp2b_comment = $('#gp2b-comment').val()
    var gp2c_comment = $('#gp2c-comment').val();

    //Ownership
    var gp3a_comment = $('#gp3a-comment').val()
    var gp3b_comment = $('#gp3b-comment').val()
    var gp3c_comment = $('#gp3c-comment').val();

    //Teamwork
    var gp4a_comment = $('#gp4a-comment').val()
    var gp4b_comment = $('#gp4b-comment').val()
    var gp4c_comment = $('#gp4c-comment').val();

    //Innovation
    var gp5a_comment = $('#gp5a-comment').val()
    var gp5b_comment = $('#gp5b-comment').val()
    var gp5c_comment = $('#gp5c-comment').val();

    //Customer Fucos
    var gp6a_comment = $('#gp6a-comment').val()
    var gp6b_comment = $('#gp6b-comment').val()
    var gp6c_comment = $('#gp6c-comment').val();

    //Work Standards
    var gp7a_comment = $('#gp7a-comment').val()
    var gp7b_comment = $('#gp7b-comment').val()
    var gp7c_comment = $('#gp7c-comment').val();

    //Job Knowledge
    var gp8a_comment = $('#gp8a-comment').val()
    var gp8b_comment = $('#gp8b-comment').val()
    var gp8c_comment = $('#gp8c-comment').val();

    //Strategic Agility
    var gp9a_comment = $('#gp9a-comment').val()
    var gp9b_comment = $('#gp9b-comment').val()
    var gp9c_comment = $('#gp9c-comment').val();

    //Communication
    var gp10a_comment = $('#gp10a-comment').val()
    var gp10b_comment = $('#gp10b-comment').val()
    var gp10c_comment = $('#gp10c-comment').val();

    switch (true) {

        case a_comment1.length > 2000:
            location.href = "#comments1";
            $('#comment_1').attr('hidden', false).show().fadeOut(6000);
            break;
        case b_comment2.length > 2000:
            location.href = "#comments2";
            $('#comment_2').attr('hidden', false).show().fadeOut(6000);
            break;
        case c_comment3.length > 2000:
            location.href = "#comments3";
            $('#comment_3').attr('hidden', false).show().fadeOut(6000);
            break;
        case d_comment4.length > 2000:
            location.href = "#comments4";
            $('#comment_4').attr('hidden', false).show().fadeOut(6000);
            break;
        case e_comment5.length > 2000:
            location.href = "#comments5";
            $('#comment_5').attr('hidden', false).show().fadeOut(6000);
            break;
        case f_comment6.length > 2000:
            location.href = "#comments6";
            $('#comment_6').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra1.length > 3000:
            location.href = "#kra1";
            $('#kra1_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra2.length > 3000:
            location.href = "#kra2";
            $('#kra2_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra3.length > 3000:
            location.href = "#kra3";
            $('#kra3_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra4.length > 3000:
            location.href = "#kra4";
            $('#kra4_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra5.length > 3000:
            location.href = "#kra5";
            $('#kra5_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkra6.length > 3000:
            location.href = "#kra6";
            $('#kra6_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi1.length > 3000:
            location.href = "#kpi1";
            $('#kpi1_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi2.length > 3000:
            location.href = "#kpi2";
            $('#kpi2_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi3.length > 3000:
            location.href = "#kpi3";
            $('#kpi3_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi4.length > 3000:
            location.href = "#kpi4";
            $('#kpi4_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi5.length > 3000:
            location.href = "#kpi5";
            $('#kpi5_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case xkpi6.length > 3000:
            location.href = "#kpi6";
            $('#kpi6_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp1a_comment.length > 2000:
            location.href = "#gp1a-comment";
            $('#gp1a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp1b_comment.length > 2000:
            location.href = "#gp1b-comment";
            $('#gp1b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp1c_comment.length > 2000:
            location.href = "#gp1c-comment";
            $('#gp1c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp2a_comment.length > 2000:
            location.href = "#gp2a-comment";
            $('#gp2a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp2b_comment.length > 2000:
            location.href = "#gp2b-comment";
            $('#gp2b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp2c_comment.length > 2000:
            location.href = "#gp2c-comment";
            $('#gp2c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp3a_comment.length > 2000:
            location.href = "#gp3a-comment";
            $('#gp3a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp3b_comment.length > 2000:
            location.href = "#gp3b-comment";
            $('#gp3b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp3c_comment.length > 2000:
            location.href = "#gp3c-comment";
            $('#gp3c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp4a_comment.length > 2000:
            location.href = "#gp4a-comment";
            $('#gp4a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp4b_comment.length > 2000:
            location.href = "#gp4b-comment";
            $('#gp4b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp4c_comment.length > 2000:
            location.href = "#gp4c-comment";
            $('#gp4c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp5a_comment.length > 2000:
            location.href = "#gp5a-comment";
            $('#gp5a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp5b_comment.length > 2000:
            location.href = "#gp5b-comment";
            $('#gp5b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp5c_comment.length > 2000:
            location.href = "#gp5c-comment";
            $('#gp5c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp6a_comment.length > 2000:
            location.href = "#gp6a-comment";
            $('#gp6a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp6b_comment.length > 2000:
            location.href = "#gp6b-comment";
            $('#gp6b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp6c_comment.length > 2000:
            location.href = "#gp6c-comment";
            $('#gp6c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp7a_comment.length > 2000:
            location.href = "#gp7a-comment";
            $('#gp7a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp7b_comment.length > 2000:
            location.href = "#gp7b-comment";
            $('#gp7b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp7c_comment.length > 2000:
            location.href = "#gp7c-comment";
            $('#gp7c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp8a_comment.length > 2000:
            location.href = "#gp8a-comment";
            $('#gp8a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp8b_comment.length > 2000:
            location.href = "#gp8b-comment";
            $('#gp8b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp8c_comment.length > 2000:
            location.href = "#gp8c-comment";
            $('#gp8c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp9a_comment.length > 2000:
            location.href = "#gp9a-comment";
            $('#gp9a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp9b_comment.length > 2000:
            location.href = "#gp9b-comment";
            $('#gp9b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp9c_comment.length > 2000:
            location.href = "#gp9c-comment";
            $('#gp9c_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp10a_comment.length > 2000:
            location.href = "#gp10a-comment";
            $('#gp10a_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp10b_comment.length > 2000:
            location.href = "#gp10b-comment";
            $('#gp10b_err').attr('hidden', false).show().fadeOut(6000);
            break;
        case gp10c_comment.length > 2000:
            location.href = "#gp10c-comment";
            $('#gp10c_err').attr('hidden', false).show().fadeOut(6000);
            break;

        default:
            if (action_s == 2) {
                // btn Submit Ajax Call/ Users (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {

                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 1) {
                //btn Draft ajax Call/ Users (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully saved as draft.');
                        } else {
                            toastr.error('ERROR! Save Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 3) {
                // btn Submit Ajax Call/ Users (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            count += 1
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 4) {
                // btn Draft Ajax Call/ Users (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully save as draft.');
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 212) {
                // btn Submit Ajax Call/ Approver 1 (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 211) {
                // btn Draft Ajax Call/ Approver 1 (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully saved as draft.');
                        } else {
                            toastr.error('ERROR! Save Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 112) {
                //btn Submit Approver 1 (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            count += 1;
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 111) {
                //btn Draft Approver 1 (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully save as draft.');
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 128) {
                //btn Submit Approver 2 (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 129) {
                //btn Draft Approver 2 (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully saved as draft.');
                        } else {
                            toastr.error('ERROR! Save Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 230) {
                //btn Submit Approver 2 (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 231) {
                //btn Draft Aprrover 2 (DRAFT_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully save as draft.');
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 239) {
                //btn Submit Approver 3 (CREATE_PAR)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 240) {
                //btn Draft Approver 3 (CREATE_DRAFT)
                // alert(action_s)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/save_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('PAR successfully saved as draft.');
                        } else {
                            toastr.error('ERROR! Save Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 241) {
                //btn Submit Approver 3 (DRAFT_PAR)
                // alert(action_s)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.success('Congratulation! PAR successfully submitted.');
                            //clearAll();
                            $('input[type=text]').attr('disabled', true);
                            $('input[type=checkbox]').attr('disabled', true);
                            $('#btnPrint').show();
                            $('#btnSubmit').hide();
                            $('#btnDraft').hide();
                            //back to top
                            //window.scrollTo(0,0);
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            } else if (action_s == 242) {
                //btn Draft Approver 3 (DRAFT_PAR)
                // alert(action_s)
                $.ajax({
                    type: 'POST',
                    url: '../../controls/update_draft_par.php',
                    data: myData,
                    beforeSend: function () {
                        showToast();
                    },
                    success: function (response) {
                        if (response > 0) {
                            toastr.info('PAR successfully save as draft.');
                        } else {
                            toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
                        }
                    }
                })
            }
    }
}

//characters limit Author: Danilo M.
function KRA_KPI_resctriction(txtkra1, txtkra2, txtkra3, txtkra4, txtkra5, txtkra6, txtkpi1, txtkpi2, txtkpi3, txtkpi4, txtkpi5, txtkpi6) {
    $(txtkra1).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    })
    $(txtkra2).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkra3).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkra4).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkra5).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkra6).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi1).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi2).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi3).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi4).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi5).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
    $(txtkpi6).keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 3000) {
            toastr.error("The maximum number of characters in this field is 3000.");
        }
    });
}


// pop notification if text is above 2K Author: Danilo M.
function general_performance_popup_notif() {
    // Bias for result
    var gp1a_comment = $('#gp1a-comment');
    var gp1b_comment = $('#gp1b-comment');
    var gp1c_comment = $('#gp1c-comment');

    //integrity
    var gp2a_comment = $('#gp2a-comment');
    var gp2b_comment = $('#gp2b-comment');
    var gp2c_comment = $('#gp2c-comment');

    //Ownership
    var gp3a_comment = $('#gp3a-comment');
    var gp3b_comment = $('#gp3b-comment');
    var gp3c_comment = $('#gp3c-comment');

    //Teamwork
    var gp4a_comment = $('#gp4a-comment');
    var gp4b_comment = $('#gp4b-comment');
    var gp4c_comment = $('#gp4c-comment');

    //Innovation
    var gp5a_comment = $('#gp5a-comment');
    var gp5b_comment = $('#gp5b-comment');
    var gp5c_comment = $('#gp5c-comment');

    //Customer Fucos
    var gp6a_comment = $('#gp6a-comment');
    var gp6b_comment = $('#gp6b-comment');
    var gp6c_comment = $('#gp6c-comment');

    //Work Standards
    var gp7a_comment = $('#gp7a-comment');
    var gp7b_comment = $('#gp7b-comment');
    var gp7c_comment = $('#gp7c-comment');

    //Job Knowledge
    var gp8a_comment = $('#gp8a-comment');
    var gp8b_comment = $('#gp8b-comment');
    var gp8c_comment = $('#gp8c-comment');

    //Strategic Agility
    var gp9a_comment = $('#gp9a-comment');
    var gp9b_comment = $('#gp9b-comment');
    var gp9c_comment = $('#gp9c-comment');

    //Communication
    var gp10a_comment = $('#gp10a-comment');
    var gp10b_comment = $('#gp10b-comment');
    var gp10c_comment = $('#gp10c-comment');

    gp1a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp1b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp1c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp2a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp2b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp2c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp3a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp3b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp3c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp4a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp4b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp4c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp5a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp5b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp5c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp6a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp6b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp6c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp7a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp7b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp7c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp8a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp8b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp8c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp9a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp9b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp9c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp10a_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp10b_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });
    gp10c_comment.keyup(function () {
        var txtlength = $(this).val().length;
        if (txtlength > 2000) {
            toastr.error("The maximum number of characters in this field box is 2000.");
        }
    });


}
function scroll_indicator() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    $('#mybar').css("width", scrolled + "%");

}





