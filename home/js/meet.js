$(document).ready(function(){
	$.ajax({
		url: "admin/country-detail.php?country_name=all",
		type: "GET",
		dataType: "json",
		success:function(data){
			if(data.success){
				if(data.num <=3 ){
					for(var i = 0; i < data.num; i++){

						$("#first").append('<a href="../2.1/2.1.html?country_name='+data.msg[i].name+'"><div id="rank-1" class="rank-1" style="background: url(img/2.0/rank-bg1.png) no-repeat;"><div id="rank-title" class="rank-title">'+(i+1)+'.'+data.msg[i].name+'</div><img src="img/2.0/rank-border.png"><div id="rank-info"><p style="font-size: 14px;">'+data.msg[i].name+'</p><p>电话：'+data.msg[i].phone+'</p><p>开放时间：'+data.msg[i].opening_time+'</p><p>门票:'+data.msg[i].ticket+'元人民币</p></div></div></a>')	
					}
				}
				else if(data.num <=6 ){
					for(var i = 0; i < 3; i++){

						$("#first").append('<div id="rank-1" class="rank-1" style="background: url(img/2.0/rank-bg1.png) no-repeat;"><div id="rank-title" class="rank-title">'+(i+1)+'.'+data.msg[i].name+'</div><img src="2.0/rank-border.png"><div id="rank-info"><p style="font-size: 14px;">'+data.msg[i].name+'</p><p>电话：'+data.msg[i].phone+'</p><p>开放时间：'+data.msg[i].opening_time+'</p><p>门票:'+data.msg[i].ticket+'元人民币</p></div></div>')	
					}

					for(var i = 0 ; i < data.num; i++){
						$("second").append('<div id="rank-1" class="rank-1" style="background: url(img/2.0/rank-bg1.png) no-repeat;"><div id="rank-title1" class="rank-title">'+(i+1)+'.'+data.msg[i].name+'</div><img src="2.0/rank-border.png"><div id="rank-info"><p style="font-size: 14px;">'+data.msg[i].name+'</p><p>电话：'+data.msg[i].phone+'</p><p>开放时间：'+data.msg[i].opening_time+'</p><p>门票:'+data.msg[i].ticket+'元人民币</p></div></div>')
					}
				}
				else{
					for(var i = 0; i < 3; i++){

						$("#first").append('<div id="rank-1" class="rank-1" style="background: url(img/2.0/rank-bg1.png) no-repeat;"><div id="rank-title" class="rank-title">'+(i+1)+'.'+data.msg[i].name+'</div><img src="2.0/rank-border.png"><div id="rank-info"><p style="font-size: 14px;">'+data.msg[i].name+'</p><p>电话：'+data.msg[i].phone+'</p><p>开放时间：'+data.msg[i].opening_time+'</p><p>门票:'+data.msg[i].ticket+'元人民币</p></div></div>')	
					}

					for(var i = 3 ; i < 6; i++){
						$("#second").append('<div id="rank-1" class="rank-1" style="background: url(img/2.0/rank-bg1.png) no-repeat;"><div id="rank-title1" class="rank-title">'+(i+1)+'.'+data.msg[i].name+'</div><img src="2.0/rank-border.png"><div id="rank-info"><p style="font-size: 14px;">'+data.msg[i].name+'</p><p>电话：'+data.msg[i].phone+'</p><p>开放时间：'+data.msg[i].opening_time+'</p><p>门票:'+data.msg[i].ticket+'元人民币</p></div></div>')
					}
				}

				var j = 1;

				$("#img-1").click(function() {
							/* Act on the event */
					$("#banner").css("background","url(img/2.0/banner1.png)");
					j = 1;
				});

				$("#img-2").click(function() {
							/* Act on the event */
					$("#banner").css("background","url(img/2.0/banner2.png)");
					j = 2;
				});

				$("#img-3").click(function() {
					/* Act on the event */
					$("#banner").css("background","url(img/2.0/banner3.png)");
					j = 3;
				})

				setInterval(function(){
					if(j < 3){
						j++;
						$("#banner").css("background","url(img/2.0/banner"+j+".png)");
					}else{
						$("#banner").css("background","url(img/2.0/banner1.png)");
						j = 1;
					}

				},2000);

				// $("#rank-1").hover(function() {
				// 	/* Act on the event */
				// 	$(this).children().css("display","");
				// },
				// funtion(){
				// });

				$(".rank-1").hover(function(){
						  $(this).children().css("display","block");
						  $(".rank-title").css("display","block");
				},
				function(){
					$(this).children().css("display","none");
					$(".rank-title").css("display","block");
					 }); 
	
			}


		}
	});

});	