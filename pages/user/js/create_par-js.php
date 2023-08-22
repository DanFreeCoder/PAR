<script>
	$(window).on('load', function() {
		$('#exampleModal').modal('show');

		// When the user scrolls the page, execute myFunction 
		window.onscroll = function() {
			scroll_indicator()
		};

	});
	$(document).ready(function() {


		$('.datepicker').datepicker({
			clearBtn: true,
			format: "MM dd, yyyy",
			setDate: new Date(),
			autoClose: true
		});

		$('#years').hide();
		$('#assessment').on('change', function() {
			var assess = $(this).val();
			if (assess == 1 || assess == 7) {
				$('#from').hide();
				$('#years').show();
				$('#to').hide();
			} else {
				$('#from').show();
				$('#years').hide();
				$('#to').show();
			}
		})


		// KRA Rating section start
		var kra1_1 = $('#kra1-1');
		var kra2_1 = $('#kra1-2');
		var kra3_1 = $('#kra1-3');
		var kra4_1 = $('#kra1-4');
		var kra5_1 = $('#kra1-5');
		var kra1_NA_1 = $('#kra1-na');
		var kra_comment = $('#comments1');
		var kra1_msg_1 = $('#comments1_msg');
		//section A.
		restrict_rating_score(kra1_1, kra2_1, kra3_1, kra4_1, kra5_1, kra1_NA_1, kra_comment, kra1_msg_1);
		// KRA Rating section end

		// KRA Rating section start
		var kra1_2 = $('#kra2-1');
		var kra2_2 = $('#kra2-2');
		var kra3_2 = $('#kra2-3');
		var kra4_2 = $('#kra2-4');
		var kra5_2 = $('#kra2-5');
		var kra1_NA_2 = $('#kra2-na');
		var kra_comment_2 = $('#comments2');
		var kra1_msg_2 = $('#comments2_msg');
		//section B.
		restrict_rating_score(kra1_2, kra2_2, kra3_2, kra4_2, kra5_2, kra1_NA_2, kra_comment_2, kra1_msg_2);
		// KRA Rating section end

		// KRA Rating section start
		var kra1_3 = $('#kra3-1');
		var kra2_3 = $('#kra3-2');
		var kra3_3 = $('#kra3-3');
		var kra4_3 = $('#kra3-4');
		var kra5_3 = $('#kra3-5');
		var kra1_NA_3 = $('#kra3-na');
		var kra_comment_3 = $('#comments3');
		var kra1_msg_3 = $('#comments3_msg');
		//section C.
		restrict_rating_score(kra1_3, kra2_3, kra3_3, kra4_3, kra5_3, kra1_NA_3, kra_comment_3, kra1_msg_3);
		// KRA Rating section end

		// KRA Rating section start
		var kra1_4 = $('#kra4-1');
		var kra2_4 = $('#kra4-2');
		var kra3_4 = $('#kra4-3');
		var kra4_4 = $('#kra4-4');
		var kra5_4 = $('#kra4-5');
		var kra1_NA_4 = $('#kra4-na');
		var kra_comment_4 = $('#comments4');
		var kra1_msg_4 = $('#comments4_msg');
		//section D.
		restrict_rating_score(kra1_4, kra2_4, kra3_4, kra4_4, kra5_4, kra1_NA_4, kra_comment_4, kra1_msg_4);
		// KRA Rating section end

		// KRA Rating section start
		var kra1_5 = $('#kra5-1');
		var kra2_5 = $('#kra5-2');
		var kra3_5 = $('#kra5-3');
		var kra4_5 = $('#kra5-4');
		var kra5_5 = $('#kra5-5');
		var kra1_NA_5 = $('#kra5-na');
		var kra_comment_5 = $('#comments5');
		var kra1_msg_5 = $('#comments5_msg');
		//section E.
		restrict_rating_score(kra1_5, kra2_5, kra3_5, kra4_5, kra5_5, kra1_NA_5, kra_comment_5, kra1_msg_5);
		// KRA Rating section end

		// KRA Rating section start
		var kra1_6 = $('#kra6-1');
		var kra2_6 = $('#kra6-2');
		var kra3_6 = $('#kra6-3');
		var kra4_6 = $('#kra6-4');
		var kra5_6 = $('#kra6-5');
		var kra1_NA_6 = $('#kra6-na');
		var kra_comment_6 = $('#comments6');
		var kra1_msg_6 = $('#comments6_msg');
		//section F.
		restrict_rating_score(kra1_6, kra2_6, kra3_6, kra4_6, kra5_6, kra1_NA_6, kra_comment_6, kra1_msg_6);
		// KRA Rating section end

		var txtkra1 = "#kra1";
		var txtkra2 = "#kra2";
		var txtkra3 = "#kra3";
		var txtkra4 = "#kra4";
		var txtkra5 = "#kra5";
		var txtkra6 = "#kra6";
		var txtkpi1 = "#kpi1";
		var txtkpi2 = "#kpi2";
		var txtkpi3 = "#kpi3";
		var txtkpi4 = "#kpi4";
		var txtkpi5 = "#kpi5";
		var txtkpi6 = "#kpi6";
		KRA_KPI_resctriction(txtkra1, txtkra2, txtkra3, txtkra4, txtkra5, txtkra6, txtkpi1, txtkpi2, txtkpi3, txtkpi4, txtkpi5, txtkpi6); //Toastr KRA & KPI RESCTRICTION

		// auto change '&' to 'and' Author: Danilo M.
		$("textarea").keyup(function(e) {

			var text = $(this).val();
			var special = new RegExp('&');
			if (special.test(text)) {
				var result = text.replace("&", "and");
				$(this).val(result)
			}
		});

		// auto change '&' to 'and' Author: Danilo M.
		$("input").keyup(function() {
			var text = $(this).val();
			var special = new RegExp('&');
			if (special.test(text)) {
				var result = text.replace("&", "and");
				$(this).val(result)
			}
		});

		$('#emp-comments').keyup(function() {
			var emp_length = $(this).val();
			if (emp_length.length > 10) {
				$('#emp_message').attr('hidden', true);
			} else {
				$('#emp_message').attr('hidden', false);
			}
		})

		//POP UP NOTIFICATION
		general_performance_popup_notif();

		//OAP Rating
		$('.checkbox-oap :checkbox').prop('disabled', true);
		$('#btnSubmit').hide(); //hide the submit button
		$('#btnPrint').hide(); //hide the print button
		$('.kra-kpi4').hide();
		$('.btnRow2').hide();
		$('.kra-kpi5').hide();
		$('.btnRow3').hide();
		$('.kra-kpi6').hide();
		//user
		$('#btnUpdateUser').hide();
		$('#btnCancel').hide();
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

	//Adding fields BUTTON event handler
	//add 4th row for KRA & KPI
	$('#btnAdd1').on('click', function(e) {
		e.preventDefault();
		$('.kra-kpi4').fadeIn();
		$('.btnRow2').fadeIn();
		$('.btnRow1').hide();
	})
	//add 5th row for KRA & KPI
	$('#btnAdd2').on('click', function(e) {
		e.preventDefault();
		$('.kra-kpi5').fadeIn();
		$('.btnRow2').hide();
		$('.btnRow3').fadeIn();
	})
	//add 6th row for KRA & KPI
	$('#btnAdd3').on('click', function(e) {
		e.preventDefault();
		$('.kra-kpi6').fadeIn();
		$('.btnRow3').hide();
	})
	//confirmation checkbox event handler
	function valueChanged() {
		if ($('#show-submit').is(":checked")) {
			$("#btnSubmit").show(300);
			$("#btnDraft").hide();
		} else {
			$("#btnSubmit").hide(300);
			$("#btnDraft").show(300);
		}
	}
	//department when change
	$('#department').on('change', function() {
		var dept = $(this).val();
		var access = $('#rater').val();
		var myData = 'access=' + access + '&dept=' + dept;

		if (access == 4) {
			//get all senior manager/execom
			$.ajax({
				type: 'POST',
				url: 'controls/get_sr_manager.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (access == 2) {
			//display all the Approver 1 & 2
			$.ajax({
				type: 'POST',
				url: 'controls/get_sup.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (access == 3) {
			//display all the managers
			$.ajax({
				type: 'POST',
				url: 'controls/get_manager.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (access == 5) {
			//display the HR Admin Name
			$.ajax({
				type: 'POST',
				url: 'controls/get_admin.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
					$('#assignee').attr('disabled', true);
				}
			})
			$('#assignee').attr('disabled', false);
		} else {
			$('#assignee').attr('disabled', true);
		}
	})

	//rater when change
	$('#rater').on('change', function() {
		var id = 0;
		var val = $(this).val();
		var dept = $('#department').val();
		var myData = 'id=' + id + '&access=' + val + '&dept=' + dept;

		if (val == 4) {
			//display all the senior manager/execom
			$.ajax({
				type: 'POST',
				url: '../../controls/get_sr_manager.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (val == 2) {
			//display all the supervisor
			$.ajax({
				type: 'POST',
				url: '../../controls/get_sup.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (val == 3) {
			//display all the managers
			$.ajax({
				type: 'POST',
				url: '../../controls/get_manager.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
				}
			})
			$('#assignee').attr('disabled', false);
		} else if (val == 5) {
			//display the HR Admin Name
			$.ajax({
				type: 'POST',
				url: '../../controls/get_admin.php',
				data: myData,
				success: function(html) {
					$('#assignee').html(html);
					$('#assignee').attr('disabled', true);
				}
			})
			$('#assignee').attr('disabled', false);
		} else {
			$('#assignee').attr('disabled', true);
		}
	})

	//Print button event handler
	$('#btnPrint').on('click', function(e) {
		e.preventDefault();

		var id = '';
		var name = $('#name').val();
		var position = $('#position').val();
		var department = $('#department option:selected').text();
		var project = $('#project').val();
		var status = $('#status option:selected').text();
		var assessment = $('#assessment option:selected').text();
		var from = $('#review-from').val();
		var to = $('#review-to').val();
		var date_hire = $('#date-hire').val();
		var rater = $('#rater option:selected').text();
		var rater_name = $('#assignee option:selected').text();
		var rater_id = $('#assignee').val();
		//kra & kpi1
		var kra1 = $('#kra1').val();
		var kpi1 = $('#kpi1').val();
		var comments1 = $('#comments1').val();
		var kra_rating1 = [];
		$('#kra1-checkbox input:checked').each(function() {
			kra_rating1.push($(this).attr('value'));
		})
		//kra & kpi 2
		var kra2 = $('#kra2').val();
		var kpi2 = $('#kpi2').val();
		var comments2 = $('#comments2').val();
		var kra_rating2 = [];
		$('#kra2-checkbox input:checked').each(function() {
			kra_rating2.push($(this).attr('value'));
		})
		//kra & kpi 3
		var kra3 = $('#kra3').val();
		var kpi3 = $('#kpi3').val();
		var comments3 = $('#comments3').val();
		var kra_rating3 = [];
		$('#kra3-checkbox input:checked').each(function() {
			kra_rating3.push($(this).attr('value'));
		})
		//kra & kpi 4
		var kra4 = $('#kra4').val();
		var kpi4 = $('#kpi4').val();
		var comments4 = $('#comments4').val();
		var kra_rating4 = [];
		$('#kra4-checkbox input:checked').each(function() {
			kra_rating4.push($(this).attr('value'));
		})
		//kra & kpi 5
		var kra5 = $('#kra5').val();
		var kpi5 = $('#kpi5').val();
		var comments5 = $('#comments5').val();
		var kra_rating5 = [];
		$('#kra5-checkbox input:checked').each(function() {
			kra_rating5.push($(this).attr('value'));
		})
		//kra & kpi 6
		var kra6 = $('#kra6').val();
		var kpi6 = $('#kpi6').val();
		var comments6 = $('#comments6').val();
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

		var myData = 'id=' + id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&kra_rating6=' + kra_rating6 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&rater_id=' + rater_id;
		//open the print page
		window.open('../../print/form/printUnEvalPAR.php?' + myData, '_blank');
	})



	//save the PAR
	var count = 0;
	$('#btnSubmit').on('click', function(e) {
		e.preventDefault();
		// if ($('textarea').val('')) {
		// 	toastr.error("You missed out on any boxes.");
		// }
		var emp_id = $('#id').val();
		var name = $('#name').val();
		var position = $('#position').val();
		var department = $('#department').val();
		var project = $('#project').val(); //UNIT
		var status = $('#status option:selected').text();
		var assessment = $('#assessment option:selected').text();
		var from = '';
		var to = '';
		const year = $('#year option:selected').text(); //selected year
		const re_to = 'December 31, '; //last month and day of the year ex. December 31, 2023
		const re_from = 'January 01, '; //first month and day of the year ex. January 01, 2023
		const middleOfMonth = 'June 01, '; //mid year ex. June 01, 2023
		if (assessment == 'Annual') {
			from = re_from + year;
			to = re_to + year;
		} else if (assessment == 'Mid Year') {
			from = re_from + year;
			to = middleOfMonth + year;
		} else {
			from = $('#review-from').val()
			to = $('#review-to').val();
		}

		var date_hire = $('#date-hire').val();
		var rater = $('#rater option:selected').text();
		var rater_name = $('#assignee').val();
		var emp_email = $('#emp_email').val();
		//kra & kpi1
		var kra1 = $('#kra1').val();
		var kpi1 = $('#kpi1').val();
		var comments1 = $('#comments1').val();
		var kra_rating1 = [];
		$('#kra1-checkbox input:checked').each(function() {
			kra_rating1.push($(this).attr('value'));
		})
		//kra & kpi 2
		var kra2 = $('#kra2').val();
		var kpi2 = $('#kpi2').val();
		var comments2 = $('#comments2').val();
		var kra_rating2 = [];
		$('#kra2-checkbox input:checked').each(function() {
			kra_rating2.push($(this).attr('value'));
		})
		//kra & kpi 3
		var kra3 = $('#kra3').val();
		var kpi3 = $('#kpi3').val();
		var comments3 = $('#comments3').val();
		var kra_rating3 = [];
		$('#kra3-checkbox input:checked').each(function() {
			kra_rating3.push($(this).attr('value'));
		})
		//kra & kpi 4
		var kra4 = $('#kra4').val();
		var kpi4 = $('#kpi4').val();
		var comments4 = $('#comments4').val();
		var kra_rating4 = [];
		$('#kra4-checkbox input:checked').each(function() {
			kra_rating4.push($(this).attr('value'));
		})
		//kra & kpi 5
		var kra5 = $('#kra5').val();
		var kpi5 = $('#kpi5').val();
		var comments5 = $('#comments5').val();
		var kra_rating5 = [];
		$('#kra5-checkbox input:checked').each(function() {
			kra_rating5.push($(this).attr('value'));
		})
		//kra & kpi 6
		var kra6 = $('#kra6').val();
		var kpi6 = $('#kpi6').val();
		var comments6 = $('#comments6').val();
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
		//check KRA Rating
		if (kra_rating4 == '') {
			kra_rating4 = 0;
		}

		if (kra_rating5 == '') {
			kra_rating5 = 0;
		}

		//determine the action(SUBMIT - 2)
		var action = 2;
		var myData = 'emp_id=' + emp_id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&emp_email=' + emp_email + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&kra_rating6=' + kra_rating6 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&action=' + action;


		//employee details section(Check if empty)
		if (name != '' && position != '' && department != '' && project != '' && status != '-Select Employment Status-' && assessment != null && from != '' && to != '' && date_hire != '' && rater != null && rater_name != null && emp_email != null) {
			//KRA & KPI section
			if ((kra_rating1 != '' && kra1 == '' && kpi1 == '') || (kra_rating2 != '' && kra2 == '' && kpi2 == '') || (kra_rating3 != '' && kra3 == '' && kpi3 == '')) {
				toastr.error('ERROR! Please fill out all the data needed in KRA & KPI section.');
			} else {
				if (kra1 != '' || kpi1 != '' || kra_rating1 != '' || kra2 != '' || kpi2 != '' || kra_rating2 != '' || kra3 != '' || kpi3 != '' || kra_rating3 != '' || kra4 != '' || kpi4 != '' || kra_rating4 != '' || kra5 != '' || kpi5 != '' || kra_rating5 != '' || kra6 != '' || kpi6 != '' || kra_rating6 != '') {
					if (gp1a_rate != '' || gp1b_rate != '' || gp1c_rate != '' || gp2a_rate != '' || gp2b_rate != '' || gp2c_rate != '' || gp3a_rate != '' || gp3b_rate != '' || gp3c_rate != '' || gp4a_rate != '' || gp4b_rate != '' || gp4c_rate != '' || gp5a_rate != '' || gp5b_rate != '' || gp5c_rate != '' || gp6a_rate != '' || gp6b_rate != '' || gp6c_rate != '' || gp7a_rate != '' || gp7b_rate != '' || gp7c_rate != '' || gp8a_rate != '' || gp8b_rate != '' || gp8c_rate != '' || gp9a_rate != '' || gp9b_rate != '' || gp9c_rate != '' || gp10a_rate != '' || gp10b_rate != '' || gp10c_rate != '') {
						if (emp_comment.length != 0) {
							$('#emp_message2').attr("hidden", true);
							if (emp_comment.length > 10) {
								// Author: Danilo M.
								var comments1_msg = $('#comments1_msg').is(':visible');
								var comments2_msg = $('#comments2_msg').is(':visible');
								var comments3_msg = $('#comments3_msg').is(':visible');
								var comments4_msg = $('#comments4_msg').is(':visible');
								var comments5_msg = $('#comments5_msg').is(':visible');
								var comments6_msg = $('#comments6_msg').is(':visible');
								var action_s = 2; //Submit
								// RESTRICTIONS For EMPTY RATING COMMENT WITH THE SUBMIT AJAX
								scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s);
							} else {
								$('#emp_message').attr('hidden', false).show().fadeOut(6000);
								$('#emp_message2').attr("hidden", true);
							}
						} else {
							$('#emp_message2').attr("hidden", false).show().fadeOut(6000);
							$('#emp_message').attr("hidden", true);
							// toastr.error("Your employee's comment must have at least a minimum of 10 characters.")
						}
					} else {
						toastr.error('ERROR! You skip some details or score in General Performance section. Please check it again.');
					}
				} else {
					toastr.error('ERROR! Please fill out all the data needed in KRA & KPI section.');
				}
			}
		} else {
			toastr.error('ERROR! Please fill out all the data needed in employee details section.');
		}


	})


	//save PAR as DRAFT
	$('#btnDraft').on('click', function(e) {
		e.preventDefault();

		var emp_id = $('#id').val();
		var name = $('#name').val();
		var position = $('#position').val();
		var department = $('#department').val();
		var project = $('#project').val();
		var status = $('#status option:selected').text();
		var assessment = $('#assessment option:selected').text();
		var from = '';
		var to = '';
		const year = $('#year option:selected').text(); //selected year
		const re_to = 'December 31, '; //last month and day of the year ex. December 31, 2023
		const re_from = 'January 01, '; //first month and day of the year ex. January 01, 2023
		const middleOfMonth = 'June 01, '; //mid year ex. June 01, 2023
		if (assessment == 'Annual') {
			from = re_from + year;
			to = re_to + year;
		} else if (assessment == 'Mid Year') {
			from = re_from + year;
			to = middleOfMonth + year;
		} else {
			from = $('#review-from').val()
			to = $('#review-to').val();
		}
		var date_hire = $('#date-hire').val();
		var rater = $('#rater option:selected').text();
		var emp_email = $('#emp_email').val();
		//check if rater is set
		var rater_name = $('#assignee').val();
		if (rater_name == '' || rater_name == null) {
			var rater_name = 0;
		} else {
			var rater_name = $('#assignee').val();
		}
		//kra & kpi1
		var kra1 = $('#kra1').val();
		var kpi1 = $('#kpi1').val();
		var comments1 = $('#comments1').val();
		var kra_rating1 = [];
		$('#kra1-checkbox input:checked').each(function() {
			kra_rating1.push($(this).attr('value'));
		})
		//kra & kpi 2
		var kra2 = $('#kra2').val();
		var kpi2 = $('#kpi2').val();
		var comments2 = $('#comments2').val();
		var kra_rating2 = [];
		$('#kra2-checkbox input:checked').each(function() {
			kra_rating2.push($(this).attr('value'));
		})
		//kra & kpi 3
		var kra3 = $('#kra3').val();
		var kpi3 = $('#kpi3').val();
		var comments3 = $('#comments3').val();
		var kra_rating3 = [];
		$('#kra3-checkbox input:checked').each(function() {
			kra_rating3.push($(this).attr('value'));
		})
		//kra & kpi 4
		var kra4 = $('#kra4').val();
		var kpi4 = $('#kpi4').val();
		var comments4 = $('#comments4').val();
		var kra_rating4 = [];
		$('#kra4-checkbox input:checked').each(function() {
			kra_rating4.push($(this).attr('value'));
		})
		//kra & kpi 5
		var kra5 = $('#kra5').val();
		var kpi5 = $('#kpi5').val();
		var comments5 = $('#comments5').val();
		var kra_rating5 = [];
		$('#kra5-checkbox input:checked').each(function() {
			kra_rating5.push($(this).attr('value'));
		})
		//kra & kpi 6
		var kra6 = $('#kra6').val();
		var kpi6 = $('#kpi6').val();
		var comments6 = $('#comments6').val();
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
		//check if rate is set/empty
		if (gp1a_rate == '' || gp1a_rate == null) {
			var gp1a_rate = 0;
		}
		if (gp1b_rate == '' || gp1b_rate == null) {
			var gp1b_rate = 0;
		}
		if (gp1c_rate == '' || gp1c_rate == null) {
			var gp1c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp2a_rate == '' || gp2a_rate == null) {
			var gp2a_rate = 0;
		}
		if (gp2b_rate == '' || gp2b_rate == null) {
			var gp2b_rate = 0;
		}
		if (gp2c_rate == '' || gp2c_rate == null) {
			var gp2c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp2a_rate == '' || gp2a_rate == null) {
			var gp2a_rate = 0;
		}
		if (gp2b_rate == '' || gp2b_rate == null) {
			var gp2b_rate = 0;
		}
		if (gp2c_rate == '' || gp2c_rate == null) {
			var gp2c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp4a_rate == '' || gp4a_rate == null) {
			var gp4a_rate = 0;
		}
		if (gp4b_rate == '' || gp4b_rate == null) {
			var gp4b_rate = 0;
		}
		if (gp4c_rate == '' || gp4c_rate == null) {
			var gp4c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp5a_rate == '' || gp5a_rate == null) {
			var gp5a_rate = 0;
		}
		if (gp5b_rate == '' || gp5b_rate == null) {
			var gp5b_rate = 0;
		}
		if (gp5c_rate == '' || gp5c_rate == null) {
			var gp5c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp6a_rate == '' || gp6a_rate == null) {
			var gp6a_rate = 0;
		}
		if (gp6b_rate == '' || gp6b_rate == null) {
			var gp6b_rate = 0;
		}
		if (gp6c_rate == '' || gp6c_rate == null) {
			var gp6c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp7a_rate == '' || gp7a_rate == null) {
			var gp7a_rate = 0;
		}
		if (gp7b_rate == '' || gp7b_rate == null) {
			var gp7b_rate = 0;
		}
		if (gp7c_rate == '' || gp7c_rate == null) {
			var gp7c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp8a_rate == '' || gp8a_rate == null) {
			var gp8a_rate = 0;
		}
		if (gp8b_rate == '' || gp8b_rate == null) {
			var gp8b_rate = 0;
		}
		if (gp8c_rate == '' || gp8c_rate == null) {
			var gp8c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp9a_rate == '' || gp9a_rate == null) {
			var gp9a_rate = 0;
		}
		if (gp9b_rate == '' || gp9b_rate == null) {
			var gp9b_rate = 0;
		}
		if (gp9c_rate == '' || gp9c_rate == null) {
			var gp9c_rate = 0;
		}
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
		//check if rate is set/empty
		if (gp10a_rate == '' || gp10a_rate == null) {
			var gp10a_rate = 0;
		}
		if (gp10b_rate == '' || gp10b_rate == null) {
			var gp10b_rate = 0;
		}
		if (gp10c_rate == '' || gp10c_rate == null) {
			var gp10c_rate = 0;
		}
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
		//check KRA Rating
		if (kra_rating4 == '') {
			kra_rating4 = 0;
		}
		if (kra_rating5 == '') {
			kra_rating5 = 0;
		}
		//action remark (SAVE AS DRAFT)
		var action = 1;

		var myData = 'emp_id=' + emp_id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&emp_email=' + emp_email + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&kra_rating6=' + kra_rating6 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&action=' + action;

		//employee details section(Check if empty)
		if (name != '' && position != '' && department != '' && project != '') {
			if (emp_comment.length != 0) {
				$('#emp_message2').attr("hidden", true);

				if (emp_comment.length > 10) {
					// Author: Danilo M.
					var comments1_msg = $('#comments1_msg').is(':visible');
					var comments2_msg = $('#comments2_msg').is(':visible');
					var comments3_msg = $('#comments3_msg').is(':visible');
					var comments4_msg = $('#comments4_msg').is(':visible');
					var comments5_msg = $('#comments5_msg').is(':visible');
					var comments6_msg = $('#comments6_msg').is(':visible');
					var action_s = 1; //Draft
					// RESTRICTIONS For EMPTY RATING COMMENT WITH THE SUBMIT AJAX
					scrollUpEmptyComments_WithAjax(comments1_msg, comments2_msg, comments3_msg, comments4_msg, comments5_msg, comments6_msg, myData, action_s);
				} else {
					$('#emp_message').attr('hidden', false).show().fadeOut(6000);
					$('#emp_message2').attr("hidden", true);
				}
			} else {
				$('#emp_message2').attr("hidden", false).show().fadeOut(6000);
				$('#emp_message').attr("hidden", true);
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



	//btnEdit event handler
	$('#btnEdit').on('click', function(e) {
		e.preventDefault();
		$('#btnLog-out').hide();
		$(this).hide();
		$('#btnUpdateUser').show();
		$('#btnCancel').show();
		//enable all fields
		$('#user-firstname').attr('disabled', false);
		$('#user-lastname').attr('disabled', false);
		$('#user-position').attr('disabled', false);
		$('#user-project').attr('disabled', false);
		$('#user-date-hire').attr('disabled', false);
		$('#user-email').attr('disabled', false);
		$('#password').attr('disabled', false);
	});
	//btnCancel event handler
	$('#btnCancel').on('click', function(e) {
		e.preventDefault();
		$('#btnLog-out').show();
		$('#btnEdit').show();
		$(this).hide();
		$('#btnUpdateUser').hide();
		$('#btnCancel').hide();
		//enable all fields
		$('#user-firstname').attr('disabled', true);
		$('#user-lastname').attr('disabled', true);
		$('#user-position').attr('disabled', true);
		$('#user-project').attr('disabled', true);
		$('#user-date-hire').attr('disabled', true);
		$('#user-email').attr('disabled', true);
		$('#password').attr('disabled', true);
	});
	//Update User details
	$('#btnUpdateUser').on('click', function(e) {
		e.preventDefault();

		var id = $('#id').val();
		var firstname = $('#user-firstname').val();
		var lastname = $('#user-lastname').val();
		var position = $('#user-position').val();
		var project = $('#user-project').val();
		var date_hire = $('#user-date-hire').val();
		var email = $('#user-email').val();
		var dept = $('#dept').val();
		var username = $('#user-username').val();
		var password = $('#password').val();
		var access = $('#access').val();
		var role = $('#role').val();
		if (password != "" || password != null || password != '') {
			var action = 2;
		} else {
			var action = 3;
		}

		var myData = 'id=' + id + '&firstname=' + firstname + '&lastname=' + lastname + '&position=' + position + '&project=' + project + '&date_hire=' + date_hire + '&username=' + username + '&password=' + password + '&email=' + email + '&dept=' + dept + '&access=' + access + '&role=' + role + '&action=' + action;

		if (firstname != '' && lastname != '') {
			$.ajax({
				type: 'POST',
				url: '../../controls/update_user.php',
				data: myData,
				beforeSend: function() {
					showToast();
				},
				success: function(response) {
					if (response > 0) {
						$('#notificationModal').modal({
							backdrop: 'static',
							keyboard: false
						});
						$('#notificationModal').modal('show');
					} else {
						toastr.error('ERROR! Update Failed. Please contact the system Administrator at local 124.');
					}
				}
			})
		} else {
			toastr.error('ERROR! Please fill out all the data needed.');
		}
	})
	//auto generate username
	$('#user-firstname').blur(function(e) {
		e.preventDefault();
		var str = $('#user-firstname').val();
		var fname = str.replace(/\s/g, '');
		var f = fname.toLowerCase();
		var str1 = $('#user-lastname').val();
		var lname = str1.replace(/\s/g, '');
		var l = lname.toLowerCase();
		var username = f.concat('.').concat(l);
		$('#user-username').val(username);
	})

	$('#user-lastname').blur(function(e) {
		e.preventDefault();
		var str = $('#user-firstname').val();
		var fname = str.replace(/\s/g, '');
		var f = fname.toLowerCase();
		var str1 = $('#user-lastname').val();
		var lname = str1.replace(/\s/g, '');
		var l = lname.toLowerCase();
		var username = f.concat('.').concat(l);
		$('#user-username').val(username);
	})
	//logout
	function logout() {
		showToast();
		location.href = '../../controls/logout.php';
	}

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
		$('#kra6').val('');
		$('#kpi6').val('');
		$('#comments6').val('');
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

	//KRA1 checkbox event handler
	$('#kra1-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments1').prop('enable', !this.checked).focus();
		}
	})

	//KRA1 checkbox event handler
	$('#kra1-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments1').prop('enable', !this.checked).focus();
		}
	})
	//KRA2 checkbox event handler
	$('#kra2-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments2').prop('enable', !this.checked).focus();
		}
	})
	//KRA3 checkbox event handler
	$('#kra3-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments3').prop('enable', !this.checked).focus();
		}
	})
	//KRA4 checkbox event handler
	$('#kra4-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments4').prop('enable', !this.checked).focus();
		}
	})
	//KRA5 checkbox event handler
	$('#kra5-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments5').prop('enable', !this.checked).focus();
		}
	})
	//KRA6 checkbox event handler
	$('#kra6-checkbox :checkbox').on('change', function() {
		var val = $(this).val();
		if (val > 3 || val < 3) {
			//select after the changes made
			$('#comments6').prop('enable', !this.checked).focus();
		}
	})

	//prevent user in adding a special character
	// $('textarea').keypress(function(e){
	// 	var k;  
	// 	k = event.charCode;  //         k = event.keyCode;  (Both can be used)
	// 	return((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57)); 
	// })

	// $('input').keypress(function(e){
	// 	var k;  
	// 	k = event.charCode;  //         k = event.keyCode;  (Both can be used)
	// 	return((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57)); 
	// })
</script>
<script src="../functions/function.js"></script>