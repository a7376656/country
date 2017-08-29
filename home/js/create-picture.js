//////定义上传方法函数
var id=1;
num = 0;

function PreviewImage(imgFile) { 
    var pattern = /(\.*.jpg$)|(\.*.png$)|(\.*.jpeg$)|(\.*.gif$)|(\.*.bmp$)/;      
    if(!pattern.test(imgFile.value)) { 
      alert("系统仅支持jpg/jpeg/png/gif/bmp格式的照片！");  
      imgFile.focus(); 
    }else{
       //定义图片路径 
       var path;
       //添加显示图片的HTML元素
       if(num >= 5)
        {
          alert("一次最多只能上传5张！");
          return;
        }

       id += 1;
       num+=1;
       $(".img-add").before("<div><div id='"+id+"'><img src='' /></div><a class='hide delete-btn'>删除</a></div>");
       $(".imgs").css('display','none');

       var nData = '<input type="file" name="userfile[]"  class="imgs" id="i'+(id+1)+'" onchange="PreviewImage(this)" />';
       $(".img-add").after(nData);
       //判断浏览器类型
       if(document.all){ 
       //兼容IE
        imgFile.select(); 
        path = document.selection.createRange().text;
        document.getElementById(id).innerHTML=""; 
        document.getElementById(id).style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果 
       }else{
        //兼容其他浏览器 
        path = URL.createObjectURL(imgFile.files[0]);
        document.getElementById(id).innerHTML = "<img src='"+path+"' width='300' height='220' />"; 
       }
       //重置表单
       // resetForm(imgFile); 
    } 
}  

//重置表单,允许用户连续添加相同的图片
function resetForm(imgFile){
  $(imgFile).parent()[0].reset();
}

//控制"按钮"显示与隐藏
$(".img-cont").off("mouseenter","div").on("mouseenter","div",function(){
    var that=this;
    var dom=$(that).children("a");
    dom.removeClass("hide");
    //为点击事件解绑，防止重复执行
    dom.off("click");
    dom.on("click",function(){
    	//删除当前图片
     	dom.parent().remove();
      var tid = dom.parent().find("div").attr('id');
      $("#i"+tid).remove();
      num=num-1;
     });
}).off("mouseleave","div").on("mouseleave","div",function(){
    var that=this;
    $(that).children("a").addClass("hide");
})

function check(form){
  if($(".time").val()==''){
    alert("请填写时间");
    $(".time").focus();
    return false;
  }
  if($(".place").val()==''){
    alert("请填写地点");
    $(".place").focus();
    return false;
  }
  if($(".price").val()==''){
    alert("请填写花费");
    $(".price").focus();
    return false;
  }
  if($(".name").val()==''){
    alert("请填写标题");
    $(".name").focus();
    return false;
  }
  if($(".intro").val()==''){
    alert("请填写介绍");
    $(".intro").focus();
    return false;
  }

  form.submit();
}


