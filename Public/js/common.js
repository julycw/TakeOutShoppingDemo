$(function(){
	$.post(APP_URL+"/Cart/getDetails",{},function(data){
		updateCart(data);
	});

	$("#btn-add-submit").on("click",function(){
		$("#add-form").submit();
	});

	$(".btn-delete").on("click",function(){
		$("#delete-form input[name=id]").val($(this).attr("data-id"));
	});
	
	$("#btn-delete-submit").on("click",function(){
		$("#delete-form").submit();
	});

	$(".btn-cart-in").on("click",function(e){
		e.stopPropagation();
		var productId = $(this).parent().attr("data-id");
		addProductToCart(productId);
	});

	$("#btn-cart-clear").on("click",function(){
		$.post(APP_URL+"/Cart/clear",{},function(){
			updateCart();
		});
	});

	$("#btn-cart-checkout").on("click",function(){
		$('#checkout-modal').modal('show');
	});

	function addProductToCart(productId,quantity){
		if(quantity == undefined){
			quantity = 1;
		}
		$.post(APP_URL+"/Cart/putIn",{productId:productId,quantity:quantity},function(data){
			updateCart(data);
		});
		if(!$(".dropdown-cart").parent().hasClass("open")){
			$(".dropdown-cart").dropdown('toggle');
		}
	}

	function updateCart(products){
		var totalPrice = 0;
		var count = 0;

		var $cartList = $(".dropdown-cart .list-group");
		var $checkoutList = $("#check-out-list");
		$cartList.empty();
		$checkoutList.empty();

		if(products != undefined){
			for (var i = 0; i < products.length;i++) {
				var price = parseFloat(products[i].product.unitPrice) * parseFloat(products[i].quantity); 
				var content = "<li class=\"list-group-item\"><strong>"+
					products[i].quantity+
					"</strong> 份 <span>"+
					products[i].product.productName+
					"</span><span class=\"pull-right\">￥"+
					price.toFixed(2)+
					"</span></li>";
				$cartList.append(content);
				$checkoutList.append(content);
				totalPrice += price;
				count++;
			};
		}

		$(".priceTotal").text(totalPrice.toFixed(2));
		$(".cartedProductQuantity").text(count);
	}
});