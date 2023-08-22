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
		//if OAP rating scale change 	
		$('#oap-scale').on('change', function() {
			var accs = $('#accomplishments').val();
			if (accs.length != 0) {
				$('#acc_msg').attr('hidden', true);
			} else {
				$('#acc_msg').attr('hidden', false);
			}
		})
		//check length value
		$('#accomplishments').on('keyup', function() {
			var acc = $(this).val();
			if (acc.length != 0) {
				$('#acc_msg').attr('hidden', true);
			} else {
				$('#acc_msg').attr('hidden', false);
			}

		})

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

		//disabled KRA& KPI checkbox
		$('.checkbox-kra1').attr('disabled', true);
		$('.checkbox-recommend').attr('disabled', true);
		$('.pip-input').attr('disabled', true);
		$('.prof-rec').attr('disabled', true);
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
	//HR Performance Recommendation event handler
	$('.checkbox-recommend :checkbox').on('change', function() {
		$('.checkbox-hr :checkbox').prop('checked', false);
		$(this).prop('checked', true);
	})
	//print employee PAR
	$('#btnPrint').on('click', function(e) {
		e.preventDefault();
		var id = $('#par-id').val();
		var action = 2; //evaluated
		var myData = 'id=' + id + '&action=' + action;
		window.open('../../print/form/printEvalPAR.php?' + myData, '_blank');
	})
	//btnMark event handler
	$('#btnMark').on('click', function(e) {
		e.preventDefault();
		//hide the approve btn
		$('.main-row').hide();
		//show the note input and buttons
		$('.mark-reason').fadeIn();
		//hide button
		$('#btnUpdateRec').hide();
		$(this).hide();
	})
	//btnCANCEL event handler
	$('#btnCancel').on('click', function(e) {
		e.preventDefault();
		//hide the approve btn
		$('.main-row').fadeIn();
		//show the note input and buttons
		$('.mark-reason').hide();
		//show button
		$('#btnUpdateRec').fadeIn();
		$('#btnMark').fadeIn();
	})

	//rater when change
	$('#rater').on('change', function() {
		var val = $(this).val();

		if (val == 1) {
			$('#assignee').attr('disabled', true);
		} else if (val == 2) {
			//display all the supervisor
			$.ajax({
				type: 'POST',
				url: 'controls/get_sup.php',
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (val == 3) {
			//display all the managers/execom
			$.ajax({
				type: 'POST',
				url: 'controls/get_manager.php',
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else {
			$('#assignee').attr('disabled', true);
		}
	})

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

		// Author: Danilo M.
		var comments1_msg = $('#comments1_msg').is(':visible');
		var comments2_msg = $('#comments2_msg').is(':visible');
		var comments3_msg = $('#comments3_msg').is(':visible');
		var comments4_msg = $('#comments4_msg').is(':visible');
		var comments5_msg = $('#comments5_msg').is(':visible');
		var comments6_msg = $('#comments6_msg').is(':visible');
		var action_s = 235; //DECLINED
		// RESTRICTIONS For EMPTY RATING COMMENT WITH THE SUBMIT AJAX
		scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s);
	})
	//save the updated OAP RAting, Performance Recommendation(APPROVER 2 MODULE ONLY)
	$('#btnUpdateRec').on('click', function(e) {
		e.preventDefault();

		//OAP RATING
		var oap_scale = [];
		$('#oap-scale input:checked').each(function() {
			oap_scale.push($(this).attr('value'));
		})

		//ACCOMPLISHMENTS
		var accomplishments = $('#accomplishments').val();
		//HR Recommendations
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
		var myData = 'id=' + id + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&recommendation=' + recommendation + '&gross=' + gross + '&rater=' + rater + '&remarks=' + remarks + '&name=' + name;

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
				var action_s = 234; //UPDATE
				// RESTRICTIONS For EMPTY RATING COMMENT WITH THE SUBMIT AJAX
				scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s);
			} else {
				toastr.error('ERROR! Submit Failed. Please select Performance recommendation.');
			}
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


	//OAP Rating
	$('.checkbox-oap :checkbox').on('change', function() {
		$('.checkbox-oap :checkbox').prop('checked', false);
		$(this).prop('checked', true);
		//select after the changes made
		$('#accomplishments').prop('enable', !this.checked).focus();
	})

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

	function clearAll() {
		//EMPLOYEE DETAILS
		$('#name').val('');
		$('#position').val('');
		$('#department').val('');
		$('#project').val('');
		$('#status').prop('selectedIndex', 0);
		$('#assessment').prop('selectedIndex', 0);
		$('#review-from').val('');
		$('#review-to').val('');
		$('#date-hire').val('');
		$('#rater').prop('selectedIndex', 0);
		//KRA & KPI
		$('#kra1').val('');
		$('#kpi1').val('');
		$('#comments1').val('');
		$('#kra2').val('');
		$('#kpi2').val('');
		$('#comments2').val('');
		$('#kra3').val('');
		$('#kpi3').val('');
		$('#comments3').val('');
		$('#kra4').val('');
		$('#kpi4').val('');
		$('#comments4').val('');
		$('#kra5').val('');
		$('#kpi5').val('');
		$('#comments5').val('');
		//GPF & BI
		$('#gp1a-comment').val('');
		$('#gp1b-comment').val('');
		$('#gp1c-comment').val('');
		$('#gp2a-comment').val('');
		$('#gp2b-comment').val('');
		$('#gp2c-comment').val('');
		$('#gp3a-comment').val('');
		$('#gp3b-comment').val('');
		$('#gp3c-comment').val('');
		$('#gp4a-comment').val('');
		$('#gp4b-comment').val('');
		$('#gp4c-comment').val('');
		$('#gp5a-comment').val('');
		$('#gp5b-comment').val('');
		$('#gp5c-comment').val('');
		$('#gp6a-comment').val('');
		$('#gp6b-comment').val('');
		$('#gp6c-comment').val('');
		$('#gp7a-comment').val('');
		$('#gp7b-comment').val('');
		$('#gp7c-comment').val('');
		$('#gp8a-comment').val('');
		$('#gp8b-comment').val('');
		$('#gp8c-comment').val('');
		$('#gp9a-comment').val('');
		$('#gp9b-comment').val('');
		$('#gp9c-comment').val('');
		$('#gp10a-comment').val('');
		$('#gp10b-comment').val('');
		$('#gp10c-comment').val('');
		//OAP
		$('#kra-total').val('');
		$('#kra-average').val('');
		$('#gp-total').val('');
		$('#gp-average').val('');
		$('#oap-rating').val('');
		//Accomplishments
		$('#accomplishments').val('');
		$('#prof-others').val('');
		//PERFORMANCE IMPROVEMENT PLAN
		$('#pin-1').val('');
		$('#at-1').val('');
		$('#sn-1').val('');
		$('#timeline-1').val('');
		$('#pin-2').val('');
		$('#at-2').val('');
		$('#sn-2').val('');
		$('#timeline-2').val('');
		$('#pin-3').val('');
		$('#at-3').val('');
		$('#sn-3').val('');
		$('#timeline-3').val('');
		//EMPLOYEE COMMENTS
		$('#emp-comments').val('');
		//remove all the checkbox attribute checked
		$('input:checkbox').removeAttr('checked');
	}
</script>
<script src="../functions/eval_function.js"></script>