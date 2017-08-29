$(document).ready(function(){
	$.ajax({
		type: "get",
		url: "admin/checkLogin.php",
		dataType: "json",
		success: function(data){
			if(data.success){
				// alert(data.msg.avatar)
				src = "img/upload/"+data.msg.avatar;
				$(".userHead img").attr("src", src);
				$(".username").html(data.msg.nickname);
				$(".onLogin").show();
			}else{
				$(".offLogin").show();
			}
		},
		error: function(jqXHR){
			alert(jqXHR.status);
		}
	})
});
