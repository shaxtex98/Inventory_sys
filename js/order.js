$(document).ready(function()
{
	var DOMAIN = "http://localhost/inventory_sys/public_html";
//Adding a New Row in Invoice Generation Sheet for Adding More Products
	addNewRow();

	$("#add").click(function(){
		addNewRow();
	})


	function addNewRow(){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method: "POST",
			data : {getNewOrderItem:1},
			success:function(data)
			{
				$("#invoice_item").append(data);	
				var n = 0;
				$(".number").each(function(){
					$(this).html(++n);
				})		
			}
		})
	}

	
//Deleting a Last Row in the Invoice Generation Sheet
	$("#remove").click(function(){
		$("#invoice_item").children("tr:last").remove();
		calculate(0,0);
	})


//Fetching Stored Information of a Product and in Backend
	$("#invoice_item").delegate(".pid","change",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();
		$(".overlay").show();
		$.ajax({
			url: DOMAIN+"/includes/process.php",
			method:"POST",
			dataType: "json",
			data:{getPriceAndQty:1,id:pid},
			success:function(data){
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(1);
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
				calculate(0,0);
			}
		})
	})


//Check required to see the Quantity Measurements
	$("#invoice_item").delegate(".qty","keyup",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please Write a Valid Quantity.");
			qty.val(1);
		}
		else{
			if ((qty.val() - 0) > (tr.find(".tqty").val() - 0)) {
				alert("Sorry this much quantity isn't available in Datatables.");
				qty.val(1);
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0,0);
			}
			else{
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0,0);
			}
		}
	})


//FOR CALCULATION
	function calculate(dis,paid){
		var sub_total = 0;
		var gst = 0;
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;
		$(".amt").each(function(){
			sub_total = sub_total + ($(this).html() * 1);     //$(this).html() worked like a string, * with 1 behaves like a number now.
		})
		gst = 0.17 * sub_total;    //calculating the gst with sub total
		net_total = gst + sub_total;    //calculating the net total
		net_total = net_total - discount;
		due = net_total - paid;
		$("#gst").val(gst);
		$("#sub_total").val(sub_total);
		$("#discount").val(discount);
		$("#net_total").val(net_total);
		//$("#paid").val(paid_amt);
		$("#due").val(due);
	}
	$("#discount").keyup(function(){
		var discount = $(this).val();
		calculate(discount,0);
	})
	$("#paid").keyup(function(){
		var paid = $(this).val();
		var discount = $("#discount").val();
		calculate(discount,paid);
	})


/* Order Accepting Process*/
	$("#order_form").click(function(){

		var invoice = $("#get_order_data").serialize();
		if ($("#cust_name").val() === "") {
			alert("Please Enter Customer's Name");
		}
		else if ($("#paid").val() === "") {
			alert("Please Enter The Paid Ammount.");
		}
		else
		{
			$.ajax({
			 url: DOMAIN + "/includes/process.php",
			 method: "POST",
			 data: $("#get_order_data").serialize(),
			 success: function(data)
			 {
			 	if (data < 0) {
			 		alert(data)
			 	}
			 	else
			 	{
			 		$("#get_order_data").trigger("reset");
			 		if (confirm("Do you want to Print Inoice?")) 
			 		{
			 			window.location.href = DOMAIN + "/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
			 		}

			 	}
			 	
			 }
		})
		}
	})

})