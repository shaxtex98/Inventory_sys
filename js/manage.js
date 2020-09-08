$(document).ready(function()
{
	var DOMAIN = "http://localhost/inventory_sys/public_html";

	
//-----------------------------------Fetching Data to be used in Forms--------------------------
	//fetch categories
	fetch_category();
	function fetch_category(){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method : "post",
			data : {getCategory:1},
			success : function(data)
			{
				var root = "<option value='0'>Root</option>"; //adding registered categories in categories section (modal)
				var choose = "<option value=''>Choose Category</option>";
				$("#parent_cat").html(root+data); //for fetching categories in add category
				$("#select_cat").html(choose+data);
			}
		})
	}

	//fetch brands
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

	//fetch Expense Types
	fetch_expense_types();
	function fetch_expense_types(){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method : "post",
			data : {getExpense:1},
			success : function(data)
			{
				var choose = "<option value=''> Choose Expense Types</option>"; //adding Brands in products section (modal)
				$("#exp_type").html(choose+data); //for fetching categories in add products

			}
		})
	}
	
	
//-------------------------- Tables Edit Delete CATEGORIES-------------------------------
	//Managing -----------------------CATEGORIES-------------------------------------
	manageCategory(1);	
	function manageCategory(pn)
	{
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : {manageCategory:1,pageno:pn},
			success : function(data)
			{
				$("#get_category").html(data);
			}
		})
	}
	//for page no CATEGORIES
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageCategory(pn);
	})
	//for deleting records CATEGORIES
	$("body").delegate(".del_cat","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are You sure You want to Delete?")) 
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : {deleteCategory:1,id:did},
				success : function(data){	
					if (data == "DEPENDENT_CATEGORY") 
					{	
						alert("Sorry ! This category is dependent on other Sub-Categories."); 
					}
					else if(data == "CATEGORY_DELETED")
					{
						alert("Category Deleted Successfully!"); 
						manageCategory(1);
					}
					else if(data == "DELETED")
					{
						alert("Deleted Successfully"); 
					}
					else
					{
						alert(data);
					}
				}

			})
		}
		else
		{

		}
	})
	//Update CATEGORIES
	$("body").delegate(".edit_cat","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateCategory:1,id:eid},
			success: function(data){
				console.log(data);
				$("#cid").val(data["cid"]);
				$("#update_category").val(data["category_name"]);
				$("#parent_cat").val(data["parent_cat"]);
			}
		})
	})
	$("#update_category_form").on("submit",function(){
		if ($("#update_category").val() == "") 
		{
			$("#update_category").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter a Category Name</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "post",
				data : $("#update_category_form").serialize(),
				success : function(data)
				{
					window.location.href = "";

				}
			})
		}	
	})


// ----------------------------Tables Edit Delete BRANDS--------------------------------------
	manageBrand(1);	
	function manageBrand(pn)
	{
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : {manageBrand:1,pageno:pn},
			success : function(data)
			{
				$("#get_brand").html(data);
			}
		})
	}
	//for page no BRANDS
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageBrand(pn);
	})

	//for deleting records BRANDS
	$("body").delegate(".del_brand","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure You want to Delete?")) 
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : {deleteBrand:1,id:did},
				success : function(data){	
					if (data == "DELETED") 
					{	
						alert("Brand is Deleted Successfully..!"); 
						manageBrand(1);
					}
					else
					{
						alert(data);
					}
				}

			})
		}
	})

	//Update BRANDS
	$("body").delegate(".edit_brand","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateBrand:1,id:eid},
			success: function(data){
				console.log(data);
				$("#bid").val(data["bid"]);
				$("#update_brand").val(data["brand_name"]);
			}
		})
	})

	//---------------UPDATING BRAND FORM -----------------------------------------
	$("#update_brand_form").on("submit",function(){
		if ($("#update_brand").val() == "") 
		{
			$("#update_brand").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter a Brand Name</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "post",
				data : $("#update_brand_form").serialize(),
				success : function(data)
				{	
					console.log(data);
					window.location.href = "";
				}
			})
		}	
	})


//-------------------------------Managing Products------------------------------
	manageProduct(1);	
	function manageProduct(pn)
	{
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : {manageProduct:1,pageno:pn},
			success : function(data)
			{
				$("#get_product").html(data);
			}
		})
	}
	//for page no
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageProduct(pn);
	})
	//for deleting records
	$("body").delegate(".del_product","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure you want to Delete?")) 
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : {deleteProduct:1,id:did},
				success : function(data){	
					if (data == "DELETED") 
					{	
						alert("Product is Deleted Successfully..!"); 
						manageProduct(1);
					}
					else
					{
						alert(data);
					}
				}

			})
		}
	})
	//Update Product
	$("body").delegate(".edit_product","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateProduct:1,id:eid},
			success: function(data){
				console.log(data);
				$("#pid").val(data["pid"]);
				$("#update_product").val(data["product_name"]);
				$("#select_cat").val(data["cid"]);
				$("#select_brand").val(data["bid"]);
				$("#product_price").val(data["product_price"]);
				$("#product_qty").val(data["product_stock"]);
			}
		})
	})

	//---------------UPDATING Products FORM -----------------------------------------
	$("#update_product_form").on("submit",function(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : $("#update_product_form").serialize(),
			success : function(data)
			{
				if (data == "UPDATED") {
					alert("Product Updated Successfully.");
					window.location.href = "";
				}else{
					alert(data);
				}
			}
		})
	})


//-------------------------------Managing Expense------------------------------
	manageExpense(1);	
	function manageExpense(pn)
	{
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : {manageExpense:1,pageno:pn},
			success : function(data)
			{
				$("#get_expense").html(data);
			}
		})
	}

	//for page no
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageExpense(pn);
	})

	//for deleting records
	$("body").delegate(".del_Expense","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure you want to Delete?")) 
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : {deleteExpense:1,id:did},
				success : function(data){	
					if (data == "DELETED") 
					{	
						alert("Product is Deleted Successfully..!"); 
						manageExpense(1);
					}
					else
					{
						alert(data);
					}
				}

			})
		}
	})

	//Update Expense Showing
	$("body").delegate(".edit_Expense","click",function(){
		var eid = $(this).attr("uid");
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {update_Expense:1,id:eid},
			success: function(data){
				console.log(data);
				$("#eid").val(data["eid"]);
				$("#update_exp_des").val(data["exp_des"]);
				$("#update_exp_qty").val(data["exp_quantity"]);
				$("#update_exp_receipt").val(data["exp_receipt"]);
				$("#update_exp_amt").val(data["exp_amt"]);
				$("#exp_type").val(data["exp_t_id"]);
				$("#exp_date").val(data["expense_date"]);
			}
		})
	})

	//---------------UPDATING Expense FORM writing -----------------------------------------
	$("#update_Expense_form").on("submit",function(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : $("#update_Expense_form").serialize(),
			success : function(data)
			{
				if (data == "UPDATED") {
					alert("Product Updated Successfully.");
					window.location.href = "";
				}else{
					alert(data);
				}
			}
		})
	})


//-------------------------------Managing Expense Types------------------------------
	manageExpenseT(1);	
	function manageExpenseT(pn)
	{
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : {manageExpenseT:1,pageno:pn},
			success : function(data)
			{
				$("#get_expense_types").html(data);
			}
		})
	}
	//for page no
	$("body").delegate(".page-link","click",function(){
		var pn = $(this).attr("pn");
		manageExpenseT(pn);
	})
	//for deleting records
	$("body").delegate(".del_exp_type","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure you want to Delete?")) 
		{
			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method: "POST",
				data : {deleteExpenseT:1,id:did},
				success : function(data){	
					if (data == "DELETED") 
					{	
						alert("Product is Deleted Successfully..!"); 
						manageExpenseT(1);
					}
					else
					{
						alert(data);
					}
				}

			})
		}
	})
	//Update Expense Types Show
	$("body").delegate(".edit_exp_type","click",function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {update_Expense_Types:1,id:eid},
			success: function(data){
				console.log(data);
				$("#eid").val(data["exp_t_id"]);
				$("#exp_type_input_up").val(data["exp_type"]);
				$("#exp_tu_date").val(data["exp_type_added"]);
			}
		})
	})

	//---------------UPDATING Expenses Types FORM -----------------------------------------
	$("#update_exp_type_form").on("submit",function(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method: "POST",
			data : $("#update_exp_type_form").serialize(),
			success : function(data)
			{
				if (data == "UPDATED") {
					alert("Expense Type Updated Successfully.");
					window.location.href = "";
				}else{
					alert(data);
				}
			}
		})
	})


})