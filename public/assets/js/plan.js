$(document).ready(function() {
				$('#plansform').bootstrapValidator({
					fields: {
						plan_code: {
							validators: {
								notEmpty: {
									message: 'The id is required and can\'t be empty'
								},
								stringLength: {
			                        max: 50,
			                        message: 'It must be less than 50 characters'
			                    }
							}
						},
						plan_name: {
							validators: {
								notEmpty: {
									message: 'The name is required and can\'t be empty'
								},
								stringLength: {
			                        max: 50,
			                        message: 'It must be less than 50 characters'
			                    }
							}
						},
						status:{
							validators: {
								notEmpty: {
									message: 'The status is required and can\'t be empty'
								}
							}
						},
						plan_details:{
							validators: {
								notEmpty: {
									message: 'The details are required and can\'t be empty'
								},
								stringLength: {
			                        max: 50,
			                        message: 'It must be less than 50 characters'
			                    }
							}
						},
						days:{
							validators: {
								notEmpty: {
									message: 'The number of days are required and can\'t be empty'
								},
							
							regexp: {
									regexp: /^[0-9]+$/,
									message: 'Enter valid number of days'
								}
							}
						},
						amount:{
							validators: {
								notEmpty: {
									message: 'The amount is required and can\'t be empty'
								},
							
							regexp: {
									regexp: /^[0-9\.]+$/,
									message: 'Enter valid amount'
								}
							}
						}
					
				}
			});


			$(".selectpicker").selectpicker();
      var all = $("option[value=all]");
      $(".selectpicker").change(function () {
        var all = $("option[value=all]");
        var thisVal = all.html();
        if (all.is(":selected")) {
          $(".selectpicker").selectpicker("deselectAll");
          $("ul.dropdown-menu > li[rel=0]").addClass("selected");
          $("span.filter-option").html(thisVal);
        } else {
          $("ul.dropdown-menu > li[rel=0]").removeClass("selected");
        }
      });
	});

