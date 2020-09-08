$(document).ready(function()
{
	var DOMAIN = "http://localhost/inventory_sys/public_html";

//For registration page
	$("#register_form").on("submit",function(){
		var statusn = false;
		var statuse = false;
		var statusp1 = false;
		var statusp2 = false;
		var statust = false;
		var name = $("#username");
		var email = $("#email");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");

		/*verification of name pattern ^ will check the first part and $ will match the last part and between [A-za-z] will match the alphabets whether capital or small*/
		/*it will match the email with a given pattern */

		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

		/*for name*/
		if (name.val() == "" || name.val().length < 6) 
		{
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Enter full Name and length more than 6 characters.");
			statusn = false;
		}
		else
		{
			name.removeClass("border-danger");
			name.addClass("border-success");
			$("#u_error").html("");
			statusn = true;
		}

		/*for email*/
		if(!e_patt.test(email.val()))
		{
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Enter a valid email.</span>");
			statuse = false;
		}
		else
		{
			email.removeClass("border-danger");
			email.addClass("border-success");
			$("#e_error").html("");
			statuse = true;
		}
		
		/*for pass1*/
		if(pass1.val() == "" || pass1.val().length < 6)
		{
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Enter a valid password of more than 6 characters.</span>");
			statusp1 = false;
		}
		else
		{
			pass1.removeClass("border-danger");
			pass1.addClass("border-success");
			$("#p1_error").html("");
			statusp1 = true;
		}

		/*for pass2*/
		if(pass2.val() == "" || pass2.val().length < 6)
		{
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Enter a valid password of more than 6 characters.</span>");
			statusp2 = false;
		}
		else
		{
			pass2.removeClass("border-danger");
			pass2.addClass("border-success");
			$("#p2_error").html("");
			statusp2 = true;
		}

		/*For User Type*/
		if(type.val() == "")
		{
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Enter a valid User Type(DON'T LEAVE IT BLANK)</span>");
			statust = false;
		}
		else
		{
			type.removeClass("border-danger");
			type.addClass("border-success");
			$("#t_error").html("");
			statust = true;
		}

		/*for password checking technique if they match than this if not than this*/
		if ((pass1.val() == pass2.val()) && statusn == true && statuse == true && statusp1 == true && statusp2 == true && statust == true) 
		{
			$("p2_error").removeClass("border-danger");
			$("p2_error").addClass("border-success");
			$(".overlay").show();
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data : $("#register_form").serialize(),
				success : function(data)
				{
					if (data == "EMAIL_ALREADY_EXISTS") 
					{
						$(".overlay").hide();
						alert("It seems like the email is already been used");
					}
					else if(data == "SOME_ERROR")
					{
						$(".overlay").hide();
						alert("Something Wrong. Please try Again.");
					}
					else
					{
						$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN + "/index.php?msg=You are registered, Now you can sign in");
					}
				}
			})	
		}
		else
		{
			pass2.addClass("border-danger");
			$("p2_error").html("<span class='text-danger'>Please re-type a matching password.</span>");
			statusp2 = true;
		}
	})		


//for login page
	$("#form_login").on("submit",function(){

		var email = $("#log_email");
		var pass = $("#log_pass");
		var em_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		var status = false;

		//for email
		if ((email.val() == "") && !em_patt.test(email.val())) 
		{
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please type your email.</span>");
			status = false;
		}
		else
		{
			email.removeClass("border-danger");
			email.addClass("border-success");
			$("#e_error").html("");
			status = true;
		}

		//for password
		if (pass.val() == "" || pass.val().length < 6) 
		{
			pass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please write a correct password of more than 6 characters.</span>");
			status = false;
		}
		else
		{
			pass.removeClass("border-danger");
			pass.addClass("border-success");
			$("#p_error").html("");
			status = true;
		}
		if (status) 
		{
			$(".overlay").show();
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data : $("#form_login").serialize(),
				success : function(data){
					if (data == "NOT_REGISTERD") 
					{
						$(".overlay").hide();
						email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>It Seems like you are not registered.</span>");
					}
					else if(data == "PASSWORD_NOT_MATCHED")
					{
						$(".overlay").hide();
						pass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please write a correct password of more than 6 characters.</span>");
					}
					else
					{
						$(".overlay").hide();
						console.log(data);
						window.location.href = DOMAIN + "/dashboard.php";
					}
				}
			})	
		}
	})


//fetch categories (ALSO USED IN manage.js)
	fetch_category();
	function fetch_category(){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method : "post",
			data : {getCategory:1},
			success : function(data)
			{
				var root = "<option value='0'>Root</option>"; //adding registered categories in categories section (modal)
				var choose = "<option value=''>Choose Category</option>"; //adding categories in products section (modal)
				$("#parent_cat").html(root+data); //for fetching categories in add category
				$("#select_cat").html(choose+data); //for fetching categories in add products
			}
		})
	}


//fetch brands (ALSO USED IN manage.js)
	fetch_brand();
	function fetch_brand(){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method : "post",
			data : {getBrand:1},
			success : function(data)
			{
				var choose = "<option value=''>Choose Brands</option>"; //adding Brands in products section (modal)
				$("#select_brand").html(choose+data); //for fetching categories in add products
			}
		})
	}



//For Adding Categories
	$("#category_form").on("submit",function()
	{
		if ($("#category_name").val() == "") 
		{
			$("#category_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter a Category Name</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "post",
				data : $("#category_form").serialize(),
				success : function(data)
				{
					if (data == "CATEGORY_ADDED")
					{
						$("#category_name").removeClass("border-danger");
						$("#category_name").addClass("border-success");
						$("#cat_error").html("<span class='text-success'>New Category Added Successfully..</span>");
						$("#category_name").val("");
						fetch_category();
					}
					else
					{
						alert(data);
					}
				}
			})
		}		
	})


//For Adding Brands
	$("#brand_form").on("submit",function()
	{
		if ($("#brand_name").val() == "") 
		{
			$("#brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter a Brand Name</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : $("#brand_form").serialize(),
				success : function(data)
				{
					if (data == "BRAND_ADDED") 
					{
						$("#brand_name").removeClass("border-danger");
						$("#brand_name").addClass("border-success");
						$("#brand_error").html("<span class='text-success'>New Brand Added.</span>");
						$("#brand_name").val("");
						fetch_brand();
					}
					else
					{
						alert(data);
					}
				}
			})
		}
	})
	$("#product_name").on("input",function(){
		})


//For Adding Products
	$("#product_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : $("#product_form").serialize(),
				success : function(data)
				{
					if (data == "NEW_PRODUCT_ADDED") 
					{
						$("#product_name").addClass("border-success");
						$("#product_name").val("");
						$("#product_price").val("");
						$("#product_qty").val("");
						$("#select_brand").val("");
						$("#select_cat").val("");
						alert("New Product Added Successfully");
					}
					else
					{
						console.log(data);
						alert(data);
					}
				}
			})
	})


// For Adding Expenses
	$("#expense_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : $("#expense_form").serialize(),
				success : function(data)
				{
					if (data == "NEW_EXPENSE_ADDED") 
					{
						$("#exp_des").addClass("border-success");
						$("#exp_des").val("");
						$("#exp_amt").val("");
						$("#exp_quantity").val("");
						$("#exp_receipt").val("");
						$("#exp_type").val("");
						alert("New Expense Added Successfully");
					}
					else
					{
						console.log(data);
						alert(data);
					}
				}
			})
	})


// For Adding Expenses Types
	$("#exp_type_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : $("#exp_type_form").serialize(),
				success : function(data)
				{
					if (data == "NEW_EXPENSE_TYPE_ADDED") 
					{
						$("#exp_t_date").addClass("border-success");
						$("#exp_type_input").addClass("border-success");
						$("#exp_type_input").val("");
						alert("New Expense Type Added Successfully");
					}
					else
					{
						console.log(data);
						alert(data);
					}
				}
			})
	})
	
})