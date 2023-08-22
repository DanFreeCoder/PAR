<script>
	$(document).ready(function() {
		// When the user scrolls the page, execute myFunction 
		window.onscroll = function() {
			scroll_indicator()
		};
		$('.datepicker').datepicker({
			clearBtn: true,
			format: "MM dd, yyyy",
			setDate: new Date(),
			autoClose: true
		});

		// auto change '&' to 'and'
		$("textarea").keyup(function() {
			var text = $(this).val();
			var special = new RegExp('&');
			if (special.test(text)) {
				var result = text.replace("&", "and");
				$(this).val(result)
			}
		});

		// auto change '&' to 'and'
		$("input").keyup(function() {
			var text = $(this).val();
			var special = new RegExp('&');
			if (special.test(text)) {
				var result = text.replace("&", "and");
				$(this).val(result)
			}
		});

		//CHECKBOX in IV A. RECOMMENDATIONS
		$('.kra-input').attr('disabled', true);
		$('.checkbox-recommend').attr('disabled', true);
		$('.checkbox-oap-rating').attr('disabled', true);
	})
	//toast
	function showToast() {
		var title = 'Loading...';
		var duration = 500;
		$.Toast.showToast({
			title: title,
			duration: duration,
			image: '../../images/loading.gif'
		});
	}

	function hideLoading() {
		$.Toast.hideToast();
	}

	//print employee PAR
	$('#btnPrint').on('click', function(e) {
		e.preventDefault();
		var id = $('#par-id').val();
		var action = 2;
		var myData = 'id=' + id + '&action=' + action;
		window.open('../../print/form/printEvalPAR.php?' + myData, '_blank');
	})

	//save the updated Performance Recommendation(MANAGER MODULE ONLY)
	$('#btnUpdateRec').on('click', function(e) {
		e.preventDefault();

		//Performance Recommendations
		var recommendation = [];
		$('.hr-recommend input:checked').each(function() {
			recommendation.push($(this).attr('value'));
		})
		var gross = $('#gross-pay').val();
		var id = $('#id').val();
		var name = $('#name').val();
		var rater = $('#rater-id').val();
		var remarks = $('#gross-remarks').val();
		//Performance Recommendations
		var recommendation = [];
		$('.checkbox-recommend input:checked').each(function() {
			recommendation.push($(this).attr('value'));
		})
		var myData = 'id=' + id + '&recommendation=' + recommendation + '&gross=' + gross + '&rater=' + rater + '&remarks=' + remarks + '&name=' + name;

		const acc_true = $('#acc_msg').is(':visible');
		if (acc_true) {
			location.href = "#accomplishments";
		} else {
			if (recommendation != 0) {
				// Author: Danilo M.
				var comments1_msg = $('#comments1_msg').is(':visible');
				var comments2_msg = $('#comments2_msg').is(':visible');
				var comments3_msg = $('#comments3_msg').is(':visible');
				var comments4_msg = $('#comments4_msg').is(':visible');
				var comments5_msg = $('#comments5_msg').is(':visible');
				var comments6_msg = $('#comments6_msg').is(':visible');
				var action_s = 247; //UPDATE
				// RESTRICTIONS For EMPTY RATING COMMENT WITH THE SUBMIT AJAX
				scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s);
			} else {
				toastr.error('ERROR! Submit Failed. Please select Performance recommendation.');
			}
		}
	})

	//btnMark event handler
	$('#btnMark').on('click', function(e) {
		e.preventDefault();
		//hide the approve btn
		$('.main-btn').hide();
		//show the note input and buttons
		$('.mark-reason').fadeIn();
	})
	//btnCANCEL event handler
	$('#btnCancel').on('click', function(e) {
		e.preventDefault();
		//hide the approve btn
		$('.main-btn').fadeIn();
		//show the note input and buttons
		$('.mark-reason').hide();
	})
	//checkbox restrictions and functionalities
	//OAP Rating
	$('.checkbox-oap :checkbox').on('change', function() {
		$('.checkbox-oap :checkbox').prop('checked', false);
		$(this).prop('checked', true);
		//enable input box
		$('#accomplishments').prop('disabled', false);
		//select after the changes made
		$('#accomplishments').prop('enable', !this.checked).focus();
	})

	// //HR Performance Recommendation event handler
	// $('.checkbox-recommend :checkbox').on('change', function() {
	// 	$('.checkbox-hr :checkbox').prop('checked', false);
	// 	$(this).prop('checked', true);
	// })

	//HR Performance Recommendation event handler
	$('.checkbox-recommend :checkbox').on('change', function() {
		if ($(this).val() === 'For Regularization' || $(this).val() === 'For Promotion' || $(this).val() === 'For Salary Adjustment') {
			if ($(this).is(':checked')) {
				$(this).prop('checked', true);
			}
		} else {
			$('.checkbox-hr :checkbox').prop('checked', false);
			$(this).prop('checked', true);
		}
	});
	//btnDecline PAR event handler
	$('#btnDeclined').on('click', function(e) {
		e.preventDefault();

		var id = $('#id').val(); //PAR ID
		var emp_name = $('#name').val(); //EMP NAME
		var reviewer = $('#rater-id').val(); //EMP SUPERVISOR ID
		var reason = $('#reason').val();
		var gross = $('#gross-pay').val();
		var remarks = $('#gross-remarks').val();
		var reason = $('#reason').val();
		//Performance Recommendations
		var recommendation = [];
		$('.checkbox-recommend input:checked').each(function() {
			recommendation.push($(this).attr('value'));
		})
		var myData = 'id=' + id + '&emp_name=' + emp_name + '&rater_id=' + reviewer + '&reason=' + reason + '&gross=' + gross + '&remarks=' + remarks + '&recommendation=' + recommendation + '&reason=' + reason;

		$.ajax({
			type: 'POST',
			url: '../../controls/declined_par.php',
			data: myData,
			beforeSend: function() {
				showToast();
			},
			success: function(response) {
				if (response > 0) {
					toastr.success('PAR successfully mark as declined.');
				} else {
					toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
				}
			}
		})
	})
	//save the PAR
	$('#btnSubmit').on('click', function(e) {
		e.preventDefault();

		var id = $('#id').val();
		var par_id = $('#par-id').val();
		var name = $('#name').val();
		var position = $('#position').val();
		var department = $('#department').val();
		var project = $('#project').val();
		var status = $('#status option:selected').text();
		var assessment = $('#assessment option:selected').text();
		var from = $('#review-from').val();
		var to = $('#review-to').val();
		var date_hire = $('#date-hire').val();
		var rater = $('#rater').val();
		var rater_name = $('#rater-id').val();
		var email = $('$email').val();
		var eval_by = $('#eval-by').val();
		//kra & kpi1
		var kra1 = $('#kra1').val();
		var kpi1 = $('#kpi1').val();
		var comments1 = $('#comments1').val();
		var sup_com1 = $('#sup-comment1').val();
		var kra_rating1 = [];
		$('#kra1-checkbox input:checked').each(function() {
			kra_rating1.push($(this).attr('value'));
		})
		//kra & kpi 2
		var kra2 = $('#kra2').val();
		var kpi2 = $('#kpi2').val();
		var comments2 = $('#comments2').val();
		var sup_com2 = $('#sup-comment2').val();
		var kra_rating2 = [];
		$('#kra2-checkbox input:checked').each(function() {
			kra_rating2.push($(this).attr('value'));
		})
		//kra & kpi 3
		var kra3 = $('#kra3').val();
		var kpi3 = $('#kpi3').val();
		var comments3 = $('#comments3').val();
		var sup_com3 = $('#sup-comment3').val();
		var kra_rating3 = [];
		$('#kra3-checkbox input:checked').each(function() {
			kra_rating3.push($(this).attr('value'));
		})
		//kra & kpi 4
		var kra4 = $('#kra4').val();
		var kpi4 = $('#kpi4').val();
		var comments4 = $('#comments4').val();
		var sup_com4 = $('#sup-comment4').val();
		var kra_rating4 = [];
		$('#kra4-checkbox input:checked').each(function() {
			kra_rating4.push($(this).attr('value'));
		})
		//kra & kpi 5
		var kra5 = $('#kra5').val();
		var kpi5 = $('#kpi5').val();
		var comments5 = $('#comments5').val();
		var sup_com5 = $('#sup-comment5').val();
		var kra_rating5 = [];
		$('#kra5-checkbox input:checked').each(function() {
			kra_rating5.push($(this).attr('value'));
		})
		//kra & kpi 6
		var kra6 = $('#kra6').val();
		var kpi6 = $('#kpi6').val();
		var comments6 = $('#comments6').val();
		var sup_com6 = $('#sup-comment6').val();
		var kra_rating6 = [];
		$('#kra6-checkbox input:checked').each(function() {
			kra_rating6.push($(this).attr('value'));
		})
		//GPF & BI
		//BIAS FOR RESULT
		var gp1a_comment = $('#gp1a-comment').val();
		var gp1a_rate = [];
		$('#gp1a input:checked').each(function() {
			gp1a_rate.push($(this).attr('value'));
		})
		var gp1b_comment = $('#gp1b-comment').val();
		var gp1b_rate = [];
		$('#gp1b input:checked').each(function() {
			gp1b_rate.push($(this).attr('value'));
		})
		var gp1c_comment = $('#gp1c-comment').val();
		var gp1c_rate = [];
		$('#gp1c input:checked').each(function() {
			gp1c_rate.push($(this).attr('value'));
		})
		//INTEGRITY
		var gp2a_comment = $('#gp2a-comment').val();
		var gp2a_rate = [];
		$('#gp2a input:checked').each(function() {
			gp2a_rate.push($(this).attr('value'));
		})
		var gp2b_comment = $('#gp2b-comment').val();
		var gp2b_rate = [];
		$('#gp2b input:checked').each(function() {
			gp2b_rate.push($(this).attr('value'));
		})
		var gp2c_comment = $('#gp2c-comment').val();
		var gp2c_rate = [];
		$('#gp2c input:checked').each(function() {
			gp2c_rate.push($(this).attr('value'));
		})
		//OWNERSHIP
		var gp3a_comment = $('#gp3a-comment').val();
		var gp3a_rate = [];
		$('#gp3a input:checked').each(function() {
			gp3a_rate.push($(this).attr('value'));
		})
		var gp3b_comment = $('#gp3b-comment').val();
		var gp3b_rate = [];
		$('#gp3b input:checked').each(function() {
			gp3b_rate.push($(this).attr('value'));
		})
		var gp3c_comment = $('#gp3c-comment').val();
		var gp3c_rate = [];
		$('#gp3c input:checked').each(function() {
			gp3c_rate.push($(this).attr('value'));
		})
		//TEAMWORK
		var gp4a_comment = $('#gp4a-comment').val();
		var gp4a_rate = [];
		$('#gp4a input:checked').each(function() {
			gp4a_rate.push($(this).attr('value'));
		})
		var gp4b_comment = $('#gp4b-comment').val();
		var gp4b_rate = [];
		$('#gp4b input:checked').each(function() {
			gp4b_rate.push($(this).attr('value'));
		})
		var gp4c_comment = $('#gp4c-comment').val();
		var gp4c_rate = [];
		$('#gp4c input:checked').each(function() {
			gp4c_rate.push($(this).attr('value'));
		})
		//INNOVATION
		var gp5a_comment = $('#gp5a-comment').val();
		var gp5a_rate = [];
		$('#gp5a input:checked').each(function() {
			gp5a_rate.push($(this).attr('value'));
		})
		var gp5b_comment = $('#gp5b-comment').val();
		var gp5b_rate = [];
		$('#gp5b input:checked').each(function() {
			gp5b_rate.push($(this).attr('value'));
		})
		var gp5c_comment = $('#gp5c-comment').val();
		var gp5c_rate = [];
		$('#gp5c input:checked').each(function() {
			gp5c_rate.push($(this).attr('value'));
		})
		//CUSTOMER FOCUS
		var gp6a_comment = $('#gp6a-comment').val();
		var gp6a_rate = [];
		$('#gp6a input:checked').each(function() {
			gp6a_rate.push($(this).attr('value'));
		})
		var gp6b_comment = $('#gp6b-comment').val();
		var gp6b_rate = [];
		$('#gp6b input:checked').each(function() {
			gp6b_rate.push($(this).attr('value'));
		})
		var gp6c_comment = $('#gp6c-comment').val();
		var gp6c_rate = [];
		$('#gp6c input:checked').each(function() {
			gp6c_rate.push($(this).attr('value'));
		})
		//WORK STANDARDS
		var gp7a_comment = $('#gp7a-comment').val();
		var gp7a_rate = [];
		$('#gp7a input:checked').each(function() {
			gp7a_rate.push($(this).attr('value'));
		})
		var gp7b_comment = $('#gp7b-comment').val();
		var gp7b_rate = [];
		$('#gp7b input:checked').each(function() {
			gp7b_rate.push($(this).attr('value'));
		})
		var gp7c_comment = $('#gp7c-comment').val();
		var gp7c_rate = [];
		$('#gp7c input:checked').each(function() {
			gp7c_rate.push($(this).attr('value'));
		})
		//JOB KNOWLEDGE
		var gp8a_comment = $('#gp8a-comment').val();
		var gp8a_rate = [];
		$('#gp8a input:checked').each(function() {
			gp8a_rate.push($(this).attr('value'));
		})
		var gp8b_comment = $('#gp8b-comment').val();
		var gp8b_rate = [];
		$('#gp8b input:checked').each(function() {
			gp8b_rate.push($(this).attr('value'));
		})
		var gp8c_comment = $('#gp8c-comment').val();
		var gp8c_rate = [];
		$('#gp8c input:checked').each(function() {
			gp8c_rate.push($(this).attr('value'));
		})
		//STRATEGIC AGILITY
		var gp9a_comment = $('#gp9a-comment').val();
		var gp9a_rate = [];
		$('#gp9a input:checked').each(function() {
			gp9a_rate.push($(this).attr('value'));
		})
		var gp9b_comment = $('#gp9b-comment').val();
		var gp9b_rate = [];
		$('#gp9b input:checked').each(function() {
			gp9b_rate.push($(this).attr('value'));
		})
		var gp9c_comment = $('#gp9c-comment').val();
		var gp9c_rate = [];
		$('#gp9c input:checked').each(function() {
			gp9c_rate.push($(this).attr('value'));
		})
		//COMMUNICATION
		var gp10a_comment = $('#gp10a-comment').val();
		var gp10a_rate = [];
		$('#gp10a input:checked').each(function() {
			gp10a_rate.push($(this).attr('value'));
		})
		var gp10b_comment = $('#gp10b-comment').val();
		var gp10b_rate = [];
		$('#gp10b input:checked').each(function() {
			gp10b_rate.push($(this).attr('value'));
		})
		var gp10c_comment = $('#gp10c-comment').val();
		var gp10c_rate = [];
		$('#gp10c input:checked').each(function() {
			gp10c_rate.push($(this).attr('value'));
		})
		//OAP
		var kra_total = $('#kra-total').val();
		var gp_total = $('#gp-total').val();
		var kra_average = $('#kra-average').val();
		var gp_average = $('#gp-average').val();
		var oap_total = $('#oap-rating').val();
		//OAP SCALE
		var oap_scale = [];
		$('#oap-scale input:checked').each(function() {
			oap_scale.push($(this).attr('value'));
		})
		//ACCOMPLISHMENTS
		var accomplishments = $('#accomplishments').val();
		//PROFESSIONAL DEVELOPMENT
		var prof_dev = [];
		$('#prof-dev input:checked').each(function() {
			prof_dev.push($(this).attr('value'));
		})
		var prof_others = $('#prof-others').val();
		//PERFORMANCE IMPROVEMENT PLAN
		var pin1 = $('#pin-1').val();
		var at1 = $('#at-1').val();
		var sn1 = $('#sn-1').val();
		var timeline1 = $('#timeline-1').val();
		var pin2 = $('#pin-2').val();
		var at2 = $('#at-2').val();
		var sn2 = $('#sn-2').val();
		var timeline2 = $('#timeline-2').val();
		var pin3 = $('#pin-3').val();
		var at3 = $('#at-3').val();
		var sn3 = $('#sn-3').val();
		var timeline3 = $('#timeline-3').val();
		//EMPLOYEE COMMENTS
		var emp_comment = $('#emp-comments').val();
		//Performance Recommendations
		var recommendation = [];
		$('.checkbox-recommend input:checked').each(function() {
			recommendation.push($(this).attr('value'));
		})
		var gross = $('#gross-pay').val();
		var remarks = $('#gross-remarks').val();
		//check KRA Rating
		if (kra_rating4 == '') {
			kra_rating4 = 0;
		}

		if (kra_rating5 == '') {
			kra_rating5 = 0;
		}
		//indicate action UPDATE
		var action = 2;
		var access = $('#access').val();

		var myData = 'id=' + id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&emp_email=' + emp_email + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + 'sup_com1=' + sup_com1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&sup_com2=' + sup_com2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&sup_com3=' + sup_com3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&sup_com4=' + sup_com4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&sup_com5=' + sup_com5 + '&kra_rating5=' + kra_rating5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&sup_com6=' + sup_com6 + '&kra_rating6=' + kra_rating6 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&recommendation=' + recommendation + '&gross=' + gross + '&remarks=' + remarks + '&eval_by=' + eval_by + '&action=' + action + '&access=' + access;

		//employee details section(Check if empty)
		if (name != '' && position != '' && department != '' && project != '' && status != null && assessment != null && from != '' && to != '' && date_hire != '' && rater != '') {
			//KRA & KPI section
			if (kra1 != '' || kpi1 != '' || kra_rating1 != '' || kra2 != '' || kpi2 != '' || kra_rating2 != '' || kra3 != '' || kpi3 != '' || kra_rating3 != '' || kra4 != '' || kpi4 != '' || kra_rating4 != '' || kra5 != '' || kpi5 != '' || kra_rating5 != '') {
				if (gp1a_rate != '' || gp1b_rate != '' || gp1c_rate != '' || gp2a_rate != '' || gp2b_rate != '' || gp2c_rate != '' || gp3a_rate != '' || gp3b_rate != '' || gp3c_rate != '' || gp4a_rate != '' || gp4b_rate != '' || gp4c_rate != '' || gp5a_rate != '' || gp5b_rate != '' || gp5c_rate != '' || gp6a_rate != '' || gp6b_rate != '' || gp6c_rate != '' || gp7a_rate != '' || gp7b_rate != '' || gp7c_rate != '' || gp8a_rate != '' || gp8b_rate != '' || gp8c_rate != '' || gp9a_rate != '' || gp9b_rate != '' || gp9c_rate != '' || gp10a_rate != '' || gp10b_rate != '' || gp10c_rate != '') {
					//FOR HR Ref (Performance Recommendation)
					if (recommendation != '') {
						$.ajax({
							type: 'POST',
							url: '../../controls/save_supPAR.php',
							data: myData,
							beforeSend: function() {
								showToast();
							},
							success: function(response) {
								if (response > 0) {
									toastr.success('Congratulation! PAR successfully submitted.');
									$('#btnPrint').show();
									$('#btnSubmit').hide();
									$('#btnMark').hide();
									//back to top
									//window.scrollTo(0,0);
								} else {
									toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
								}
							}
						})
					} else {
						toastr.error('ERROR! Please input a Performance Recommendation.');
					}
				} else {
					toastr.error('ERROR! You skip some details or score in General Performance section. Please check it again.');
				}
			} else {
				toastr.error('ERROR! Please fill out all the data needed in KRA & KPI section.');
			}
		} else {
			toastr.error('ERROR! Please fill out all the data needed in employee details section.');
		}
	})

	//KPI & KRA checkbox event handler
	$('.checkbox-kra1 :checkbox').on('change', function() {
		$('.checkbox-kra1 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-kra2 :checkbox').on('change', function() {
		$('.checkbox-kra2 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-kra3 :checkbox').on('change', function() {
		$('.checkbox-kra3 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-kra4 :checkbox').on('change', function() {
		$('.checkbox-kra4 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-kra5 :checkbox').on('change', function() {
		$('.checkbox-kra5 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-kra6 :checkbox').on('change', function() {
		$('.checkbox-kra6 :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})

	//General Performance factors checkbox event handler & score calculation
	//BIAS FOR RESULT
	$('.checkbox-gp1a :checkbox').on('change', function() {
		$('.checkbox-gp1a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp1b :checkbox').on('change', function() {
		$('.checkbox-gp1b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp1c :checkbox').on('change', function() {
		$('.checkbox-gp1c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//INTEGRITY
	$('.checkbox-gp2a :checkbox').on('change', function() {
		$('.checkbox-gp2a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp2b :checkbox').on('change', function() {
		$('.checkbox-gp2b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp2c :checkbox').on('change', function() {
		$('.checkbox-gp2c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//OWNERSHIP
	$('.checkbox-gp3a :checkbox').on('change', function() {
		$('.checkbox-gp3a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp3b :checkbox').on('change', function() {
		$('.checkbox-gp3b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp3c :checkbox').on('change', function() {
		$('.checkbox-gp3c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//TEAMWORK
	$('.checkbox-gp4a :checkbox').on('change', function() {
		$('.checkbox-gp4a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp4b :checkbox').on('change', function() {
		$('.checkbox-gp4b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp4c :checkbox').on('change', function() {
		$('.checkbox-gp4c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//INNOVATION
	$('.checkbox-gp5a :checkbox').on('change', function() {
		$('.checkbox-gp5a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp5b :checkbox').on('change', function() {
		$('.checkbox-gp5b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp5c :checkbox').on('change', function() {
		$('.checkbox-gp5c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//CUSTOMER FOCUS
	$('.checkbox-gp6a :checkbox').on('change', function() {
		$('.checkbox-gp6a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp6b :checkbox').on('change', function() {
		$('.checkbox-gp6b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp6c :checkbox').on('change', function() {
		$('.checkbox-gp6c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp7a :checkbox').on('change', function() {
		$('.checkbox-gp7a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp7b :checkbox').on('change', function() {
		$('.checkbox-gp7b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp7c :checkbox').on('change', function() {
		$('.checkbox-gp7c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//JOB KNOWLEDGE
	$('.checkbox-gp8a :checkbox').on('change', function() {
		$('.checkbox-gp8a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp8b :checkbox').on('change', function() {
		$('.checkbox-gp8b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp8c :checkbox').on('change', function() {
		$('.checkbox-gp8c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//STRATEGIC AGILITY
	$('.checkbox-gp9a :checkbox').on('change', function() {
		$('.checkbox-gp9a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp9b :checkbox').on('change', function() {
		$('.checkbox-gp9b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp9c :checkbox').on('change', function() {
		$('.checkbox-gp9c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	//COMMUNICATION
	$('.checkbox-gp10a :checkbox').on('change', function() {
		$('.checkbox-gp10a :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp10b :checkbox').on('change', function() {
		$('.checkbox-gp10b :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})
	$('.checkbox-gp10c :checkbox').on('change', function() {
		$('.checkbox-gp10c :checkbox').prop('checked', false);
		$(this).prop('checked', true);

		calculate_kra();
		calculate_gp();
	})

	//KRA & KPI CALCULATION
	function calculate_kra() {
		var val = [];
		var kra_rating1 = [];
		$('#kra1-checkbox input:checked').each(function() {
			kra_rating1.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var kra_rating2 = [];
		$('#kra2-checkbox input:checked').each(function() {
			kra_rating2.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var kra_rating3 = [];
		$('#kra3-checkbox input:checked').each(function() {
			kra_rating3.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var kra_rating4 = [];
		$('#kra4-checkbox input:checked').each(function() {
			kra_rating4.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var kra_rating5 = [];
		$('#kra5-checkbox input:checked').each(function() {
			kra_rating5.push($(this).attr('value'));
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

		//get the value count of NA/0
		var count = 0;
		val.forEach(function(e) {
			if (e == 0 || e == '') {
				i++;
			}
		})
		var zero = 5 - parseFloat(i);

		//KRA & KPI COMPUTATION
		var kraTotal = (parseFloat(kra_rating1) + parseFloat(kra_rating2) + parseFloat(kra_rating3) + parseFloat(kra_rating4) + parseFloat(kra_rating5)) / parseFloat(zero);
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
		var val = [];
		var gp1a_rate = [];
		$('.checkbox-gp1a input:checked').each(function() {
			gp1a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp1b_rate = [];
		$('.checkbox-gp1b input:checked').each(function() {
			gp1b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp1c_rate = [];
		$('.checkbox-gp1c input:checked').each(function() {
			gp1c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp2a_rate = [];
		$('.checkbox-gp2a input:checked').each(function() {
			gp2a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp2b_rate = [];
		$('.checkbox-gp2b input:checked').each(function() {
			gp2b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp2c_rate = [];
		$('.checkbox-gp2c input:checked').each(function() {
			gp2c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp3a_rate = [];
		$('.checkbox-gp3a input:checked').each(function() {
			gp3a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp3b_rate = [];
		$('.checkbox-gp3b input:checked').each(function() {
			gp3b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp3c_rate = [];
		$('.checkbox-gp3c input:checked').each(function() {
			gp3c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp4a_rate = [];
		$('.checkbox-gp4a input:checked').each(function() {
			gp4a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp4b_rate = [];
		$('.checkbox-gp4b input:checked').each(function() {
			gp4b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp4c_rate = [];
		$('.checkbox-gp4c input:checked').each(function() {
			gp4c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp5a_rate = [];
		$('.checkbox-gp5a input:checked').each(function() {
			gp5a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp5b_rate = [];
		$('.checkbox-gp5b input:checked').each(function() {
			gp5b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp5c_rate = [];
		$('.checkbox-gp5c input:checked').each(function() {
			gp5c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp6a_rate = [];
		$('.checkbox-gp6a input:checked').each(function() {
			gp6a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp6b_rate = [];
		$('.checkbox-gp6b input:checked').each(function() {
			gp6b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp6c_rate = [];
		$('.checkbox-gp6c input:checked').each(function() {
			gp6c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp7a_rate = [];
		$('.checkbox-gp7a input:checked').each(function() {
			gp7a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp7b_rate = [];
		$('.checkbox-gp7b input:checked').each(function() {
			gp7b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp7c_rate = [];
		$('.checkbox-gp7c input:checked').each(function() {
			gp7c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp8a_rate = [];
		$('.checkbox-gp8a input:checked').each(function() {
			gp8a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp8b_rate = [];
		$('.checkbox-gp8b input:checked').each(function() {
			gp8b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp8c_rate = [];
		$('.checkbox-gp8c input:checked').each(function() {
			gp8c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp9a_rate = [];
		$('.checkbox-gp9a input:checked').each(function() {
			gp9a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp9b_rate = [];
		$('.checkbox-gp9b input:checked').each(function() {
			gp9b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp9c_rate = [];
		$('.checkbox-gp9c input:checked').each(function() {
			gp9c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp10a_rate = [];
		$('.checkbox-gp10a input:checked').each(function() {
			gp10a_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp10b_rate = [];
		$('.checkbox-gp10b input:checked').each(function() {
			gp10b_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})
		var gp10c_rate = [];
		$('.checkbox-gp10c input:checked').each(function() {
			gp10c_rate.push($(this).attr('value'));
			val.push($(this).attr('value'));
		})

		//get the value count of NA/0
		var i = 0;
		var count = 0;
		val.forEach(function(e) {
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
</script>
<script src="../functions/eval_function.js"></script>