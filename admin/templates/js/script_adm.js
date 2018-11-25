$(document).ready(function() {
    $('.delete').click(function(){
		var res = confirm("Подтвердите удаление");
		if(!res) return false;
	});
	$('.delete-cat').click(function(){
		var res = confirm("Подтвердите удаление");
		if(!res) return false;
	});
	$('.del_comm, .delete_static').click(function(){
		var res = confirm("Подтвердите удаление");
		if(!res) return false;
	});
	
	$("#forums").click(function(){
		$("#toggle").slideToggle(500);
	});
	
	$(".delimg").on("click", function() {
		var res = confirm("Подтвердите удаление");
		if(!res) return false;
		var img = $(this).attr("alt");
		var product_id = $("#product_id").text();
		$.ajax({
			url: "./",
			type: "POST",
			data: {img: img, product_id: product_id},
			success: function(res) {
				$(".baseimg").fadeOut(500, function() {
					$(".baseimg").empty().fadeIn(500).html(res);	
				});
			},
			error: function() {
				alert("Error");
			}
		});
	});
});
