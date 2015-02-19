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
});