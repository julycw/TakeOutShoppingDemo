$(function(){
	$("#btn-add-submit").on("click",function(){
		$("#add-form").submit();
	});

	$(".btn-delete").on("click",function(){
		$("#delete-form input[name=id]").val($(this).attr("data-id"));
	});
	
	$("#btn-delete-submit").on("click",function(){
		$("#delete-form").submit();
	});

	$(".btn-cart-in").on("click",function(){
		var productId = $(this).parent().attr("data-id");
		addProductToCart(productId);
	});

	function addProductToCart(productId,quantity){
		if(quantity == undefined){
			quantity = 1;
		}
		$.post(APP_URL+"/Cart/putIn",{productId:productId,quantity:quantity},function(data){
			console.info(data);
		});
	}

	function removeProductFromCart(productId,quantity){
		if(quantity == undefined){
			quantity = 1;
		}
		$.post(APP_URL+"/Cart/putIn",{productId:productId,quantity:quantity},function(data){

		});
	}
});