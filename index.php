<?php
if (!file_exists("install.lock")) {
    header("Refresh:0;url=\"./install.php\"");
    exit("正在跳转到安装界面...");
}
//检测是否已经安装
require_once "header.php";
require_once "config.php";
require_once "./app/delete.php";
if (date("i")%20 == 0) {
    del("./qrcode/");
}
//清除二维码缓存
//开始判断处理
if ($status == "undefind" || empty($status)) {
    echo("<br / ><center><br / ><img src=\"https://3gimg.qq.com/tele_safe/safeurl/img/notice.png\" widht=\"85\"  height=\"85\" alt=\"错误\"></center>");
    echo('<center><h2>404 Not Found</h2></center>');
    require_once "footer.php";
    exit();
}
if ($status == "passmessage") {
    //如果数据库type读取为密语
    if ($access == 'on') {
        access($id,$information,'passmessage');
    }
    echo "
      <br />
      <div class=\"mdui-card.mdui-card-media-covered-transparent\">
        <div class=\"mdui-card-primary\">
          <div class=\"mdui-card-primary-subtitle\">$timemessage</div>
            <center class=\"mdui-typo\">
              <pre style=\"user-select:all;max-width:900px;\">" . htmlspecialchars($information) . "</pre>
              <h5>你收到了一条悄悄话！ <a class=\"mdui-text-color-grey-400\" href=\"$url\">我也要写</a></h5>
            </center>
          </div>
        </div>
      </div>
    <br/>
      ";
      require_once "footer.php";
      exit();
    }
    //至此显示密语结束
    //因为为了解决速度问题，所以url的跳转放置显示css直之前，即header.php开头部分  
?>
<br/>
<div class="mdui-container doc-container">
    <div class="mdui-typo">
    	<h2>悄悄话</h2>
        <div class="mdui-textfield mdui-textfield-floating-label">
        	<i class="mdui-icon material-icons">&#xe0b9;</i>
        	<label class="mdui-textfield-label">请输入悄悄话</label>
            <textarea id="wordcontent" time="content" class="mdui-textfield-input" type="text"></textarea>
        </div>
        <br />
        <button onClick="wordSubmit();" id="wordSubmit" class="mdui-btn mdui-btn-dense mdui-color-indigo mdui-ripple">
          <i class="mdui-icon material-icons">&#xe163;</i> 发送
        </button>
        <br />
        <br />
        <hr/>
        <h2>网址缩短</h2>
        <div class="mdui-textfield mdui-textfield-floating-label">
        	<i class="mdui-icon material-icons">&#xe226;</i>
        	<label class="mdui-textfield-label">请输入链接</label>
            <input id="content" time="content" class="mdui-textfield-input" type="url" />
            <div class="mdui-textfield-error">请输入正确的链接</div>
        </div>
        <button onClick="Submit();" id="Submit" class="mdui-btn mdui-btn-dense mdui-color-indigo mdui-ripple">
          <i class="mdui-icon material-icons">&#xe163;</i> 缩短
        </button>
    </div>
</div>
<script>
  function  getRadioBoxValue(radioName) 
  {   
    var obj = document.getElementsByName(radioName);
      for(i=0; i<obj.length;i++)  {
       if(obj[i].checked)  { 
         return  obj[i].value; 
       } 
      }     
  }
  function Submit() {
    document.getElementById("progressbar").setAttribute("style","display:block;");
    var content = document.getElementById("content").value;
    var type = 'shorturl';
    var content = escape(content);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./submit.php");
    xhr.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
    xhr.send("content=" + content + "&type=" + type);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("progressbar").setAttribute("style","display:none;");
            if (xhr.responseText == 200) {
                window.location.href="shorturl.php";
            } else {
                mdui.snackbar(xhr.responseText);
            }
        }
    }
  }
  function wordSubmit() {
    document.getElementById("progressbar").setAttribute("style","display:block;");
    var content = document.getElementById("wordcontent").value;
    var type = 'passmessage';
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./submit.php");
    xhr.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
    xhr.send("content=" + content + "&type=" + type);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("progressbar").setAttribute("style","display:none;");
            if (xhr.responseText == 200) {
                window.location.href="shorturl.php";
            } else {
                mdui.snackbar(xhr.responseText);
            }
        }
    }
  }
</script>
<div class="mdui-container doc-container">
    <div class="mdui-typo">
         <h2>使用须知</h2>
         <ol>
         	<li>使用时请遵守您所在国家/地区法律。</li>
         	<li>禁止将本网站api用于牟利。</li>
         	<li>欢迎各位捐助。</li>
         </ol>
    </div>
</div>
<br><br>
<?php require_once "footer.php"; ?>
