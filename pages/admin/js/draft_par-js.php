<script>
	$(document).ready(function() {
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

		//rater when change
		var id = $('#id').val();
		var val = $('#rater').val();
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
	//logout
	function logout() {
		showToast();
		location.href = '../../controls/logout.php';
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
	//event handler bntLogin
	$('#password').keyup(function(event) {
		if (event.keyCode === 13) {
			$('#btnLogin').click();
		}
	});

	//rater when change
	$('#rater').on('change', function() {
		var val = $(this).val();
		var dept = $('#department').val();
		var myData = 'access=' + val + '&dept=' + dept;

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

		var id = $('#id').val();
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
		var kra5 = $('#kra6').val();
		var kpi5 = $('#kpi6').val();
		var comments5 = $('#comments6').val();
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

		var myData = 'id=' + id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&rater_id=' + rater_id;
		//open the print page
		window.open('../../print/form/printUnEvalPAR.php?' + myData, '_blank');
	})

	//save the PAR
	$('#btnSubmit').on('click', function(e) {
		e.preventDefault();

		var id = $('#id').val();
		var kra_id = $('#kra-id').val();
		var gp_id = $('#gp-id').val();
		var pip_id = $('#pip-id').val();
		var emp_id = $('#emp-id').val();
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
		if (kra_rating6 == '') {
			kra_rating6 = 0;
		}
		//action indicator (1 = SUBMIT PAR)
		var action = 1;

		var myData = 'id=' + id + '&kra_id=' + kra_id + '&gp_id=' + gp_id + '&pip_id=' + pip_id + '&emp_id=' + emp_id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&emp_email=' + emp_email + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&kra_rating6=' + kra_rating6 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&action=' + action;

		//employee details section(Check if empty)
		if (name != '' && position != '' && department != '' && project != '' && status != null && assessment != null && from != '' && to != '' && date_hire != '' && rater != '' && emp_email != '') {
			//KRA & KPI section
			if ((kra_rating1 != '' && kra1 == '' && kpi1 == '') || (kra_rating2 != '' && kra2 == '' && kpi2 == '') || (kra_rating3 != '' && kra3 == '' && kpi3 == '')) {
				toastr.error('ERROR! Please fill out all the data needed in KRA & KPI section.');
			} else {
				//KRA & KPI sectionw
				if (kra1 != '' || kpi1 != '' || kra_rating1 != '' || kra2 != '' || kpi2 != '' || kra_rating2 != '' || kra3 != '' || kpi3 != '' || kra_rating3 != '') {
					if (gp1a_rate != '' || gp1b_rate != '' || gp1c_rate != '' || gp2a_rate != '' || gp2b_rate != '' || gp2c_rate != '' || gp3a_rate != '' || gp3b_rate != '' || gp3c_rate != '' || gp4a_rate != '' || gp4b_rate != '' || gp4c_rate != '' || gp5a_rate != '' || gp5b_rate != '' || gp5c_rate != '' || gp6a_rate != '' || gp6b_rate != '' || gp6c_rate != '' || gp7a_rate != '' || gp7b_rate != '' || gp7c_rate != '' || gp8a_rate != '' || gp8b_rate != '' || gp8c_rate != '' || gp9a_rate != '' || gp9b_rate != '' || gp9c_rate != '' || gp10a_rate != '' || gp10b_rate != '' || gp10c_rate != '') {
						$.ajax({
							type: 'POST',
							url: '../../controls/update_draft_par.php',
							data: myData,
							beforeSend: function() {
								showToast();
							},
							success: function(response) {
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

		var id = $('#id').val();
		var kra_id = $('#kra-id').val();
		var gp_id = $('#gp-id').val();
		var pip_id = $('#pip-id').val();
		var name = $('#name').val();
		var position = $('#position').val();
		var department = $('#department').val();
		var project = $('#project').val();
		var status = $('#status option:selected').text();
		var assessment = $('#assessment option:selected').text();
		var from = $('#review-from').val();
		var to = $('#review-to').val();
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
		//action remark
		var action = 2;

		var myData = 'id=' + id + '&kra_id=' + kra_id + '&gp_id=' + gp_id + '&pip_id=' + pip_id + '&name=' + name + '&position=' + position + '&department=' + department + '&project=' + project + '&emp_status=' + status + '&assessment=' + assessment + '&from=' + from + '&to=' + to + '&date_hire=' + date_hire + '&rater=' + rater + '&rater_name=' + rater_name + '&emp_email=' + emp_email + '&kra1=' + kra1 + '&kpi1=' + kpi1 + '&comments1=' + comments1 + '&kra_rating1=' + kra_rating1 + '&kra2=' + kra2 + '&kpi2=' + kpi2 + '&comments2=' + comments2 + '&kra_rating2=' + kra_rating2 + '&kra3=' + kra3 + '&kpi3=' + kpi3 + '&comments3=' + comments3 + '&kra_rating3=' + kra_rating3 + '&kra4=' + kra4 + '&kpi4=' + kpi4 + '&comments4=' + comments4 + '&kra_rating4=' + kra_rating4 + '&kra5=' + kra5 + '&kpi5=' + kpi5 + '&comments5=' + comments5 + '&kra_rating5=' + kra_rating5 + '&kra6=' + kra6 + '&kpi6=' + kpi6 + '&comments6=' + comments6 + '&kra_rating6=' + kra_rating6 + '&gp1a_rate=' + gp1a_rate + '&gp1a_comment=' + gp1a_comment + '&gp1b_rate=' + gp1b_rate + '&gp1b_comment=' + gp1b_comment + '&gp1c_rate=' + gp1c_rate + '&gp1c_comment=' + gp1c_comment + '&gp2a_rate=' + gp2a_rate + '&gp2a_comment=' + gp2a_comment + '&gp2b_rate=' + gp2b_rate + '&gp2b_comment=' + gp2b_comment + '&gp2c_rate=' + gp2c_rate + '&gp2c_comment=' + gp2c_comment + '&gp3a_rate=' + gp3a_rate + '&gp3a_comment=' + gp3a_comment + '&gp3b_rate=' + gp3b_rate + '&gp3b_comment=' + gp3b_comment + '&gp3c_rate=' + gp3c_rate + '&gp3c_comment=' + gp3c_comment + '&gp4a_rate=' + gp4a_rate + '&gp4a_comment=' + gp4a_comment + '&gp4b_rate=' + gp4b_rate + '&gp4b_comment=' + gp4b_comment + '&gp4c_rate=' + gp4c_rate + '&gp4c_comment=' + gp4c_comment + '&gp5a_rate=' + gp5a_rate + '&gp5a_comment=' + gp5a_comment + '&gp5b_rate=' + gp5b_rate + '&gp5b_comment=' + gp5b_comment + '&gp5c_rate=' + gp5c_rate + '&gp5c_comment=' + gp5c_comment + '&gp6a_rate=' + gp6a_rate + '&gp6a_comment=' + gp6a_comment + '&gp6b_rate=' + gp6b_rate + '&gp6b_comment=' + gp6b_comment + '&gp6c_rate=' + gp6c_rate + '&gp6c_comment=' + gp6c_comment + '&gp7a_rate=' + gp7a_rate + '&gp7a_comment=' + gp7a_comment + '&gp7b_rate=' + gp7b_rate + '&gp7b_comment=' + gp7b_comment + '&gp7c_rate=' + gp7c_rate + '&gp7c_comment=' + gp7c_comment + '&gp8a_rate=' + gp8a_rate + '&gp8a_comment=' + gp8a_comment + '&gp8b_rate=' + gp8b_rate + '&gp8b_comment=' + gp8b_comment + '&gp8c_rate=' + gp8c_rate + '&gp8c_comment=' + gp8c_comment + '&gp9a_rate=' + gp9a_rate + '&gp9a_comment=' + gp9a_comment + '&gp9b_rate=' + gp9b_rate + '&gp9b_comment=' + gp9b_comment + '&gp9c_rate=' + gp9c_rate + '&gp9c_comment=' + gp9c_comment + '&gp10a_rate=' + gp10a_rate + '&gp10a_comment=' + gp10a_comment + '&gp10b_rate=' + gp10b_rate + '&gp10b_comment=' + gp10b_comment + '&gp10c_rate=' + gp10c_rate + '&gp10c_comment=' + gp10c_comment + '&kra_total=' + kra_total + '&gp_total=' + gp_total + '&kra_average=' + kra_average + '&gp_average=' + gp_average + '&oap_total=' + oap_total + '&oap_scale=' + oap_scale + '&accomplishments=' + accomplishments + '&prof_dev=' + prof_dev + '&prof_others=' + prof_others + '&pin1=' + pin1 + '&at1=' + at1 + '&sn1=' + sn1 + '&timeline1=' + timeline1 + '&pin2=' + pin2 + '&at2=' + at2 + '&sn2=' + sn2 + '&timeline2=' + timeline2 + '&pin3=' + pin3 + '&at3=' + at3 + '&sn3=' + sn3 + '&timeline3=' + timeline3 + '&emp_comment=' + emp_comment + '&action=' + action;

		//employee details section(Check if empty)
		if (name != '' && position != '' && department != '' && project != '' && status != null && assessment != null && from != '' && to != '' && date_hire != '' && rater != '' && rater_name != null && emp_email != '') {
			$.ajax({
				type: 'POST',
				url: '../../controls/update_draft_par.php',
				data: myData,
				beforeSend: function() {
					showToast();
				},
				success: function(response) {
					if (response > 0) {
						toastr.success('PAR successfully save as draft.');
					} else {
						toastr.error('ERROR! Submit Failed. Please contact the system administrator at local 124 for assistance');
					}
				}
			})
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
		var kraAverage = 0;
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
		var kra_rating6 = [];
		$('#kra6-checkbox input:checked').each(function() {
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
		val.forEach(function(e) {
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
		var username = $('#username').val();
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
	//rater when change
	$('#rater').on('change', function() {
		var val = $(this).val();
		var dept = $('#department').val();
		var myData = 'access=' + val + '&dept=' + dept;

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
	//logout
	function logout() {
		showToast();
		location.href = '../../controls/logout.php';
	}

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