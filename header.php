<!--
版权归属:XCSOFT
修改：CMNIC
修改时间:2020/05/23
v1.7.0
邮箱:contact#xcsoft.top(用@替换#)
如有任何问题欢迎联系!
-->
<!DOCTYPE html>
<?php
require_once "config.php";
require_once "app/record.php";
require_once "app/code.php";
$id = $_GET['id'];
//获取id
if (empty($id)) {
  $status = "ok";
  //如果没有id就跳过判断
} else {
  //如果有id则搜索数据库
  $check1 = "SELECT *FROM `ban` where `content`='$ip' or `content`='$id';";
  $count1 = mysqli_query($conn,$check1);
  $arr1 = mysqli_fetch_assoc($count1);
  $type = $arr1['type'];
  if (!empty($type)) {
    echo("<br / ><br / ><center><img src=\"https://3gimg.qq.com/tele_safe/safeurl/img/notice.png\" widht=\"85\"  height=\"85\" alt=\"错误\"></center>");
    echo('<center><h1>该短域已被管理员封禁</h1></center></div>');
    exit();
  }
  @$comd = "SELECT * FROM `information` WHERE binary `shorturl`='$id'";
  @$count = mysqli_query($conn,$comd);
  @$arr1 = mysqli_fetch_array($count);
  @$type = $arr1['type'];
  @$information = $arr1['information'];
  @$timemessage = $arr1['time'];
  if (empty($type)) {
    $status = "undefind";
    //无数据
  } else {
    if ($type == 'shorturl') {
      //如果数据库type读取为短域
      if (strpos($_SERVER['HTTP_USER_AGENT'],'QQ/') !== false or strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        //判断打开浏览器UA是否为微信或者QQ
        echo '<html>
                <head>
                  <meta charset="UTF-8">
                  <title>请使用浏览器打开</title>
                  <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.ico" media="screen" />
                  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
                  <meta content="yes" name="apple-mobile-web-app-capable">
                  <meta content="black" name="apple-mobile-web-app-status-bar-style">
                  <meta name="format-detection" content="telephone=no">
                  <meta content="false" name="twcClient" id="twcClient">
                  <meta name="aplus-touch" content="1">
                  <style>                         
                    body,html{width:100%;height:100%}
                    *{margin:0;padding:0}
                    body{background-color:#fff}
                    .top-bar-guidance{font-size:15px;color:#fff;height:70%;line-height:1.8;padding-left:20px;padding-top:20px;background:url(//gw.alicdn.com/tfs/TB1eSZaNFXXXXb.XXXXXXXXXXXX-750-234.png) center top/contain no-repeat}
                    .top-bar-guidance .icon-safari{width:25px;height:25px;vertical-align:middle;margin:0 .2em}
                    .app-download-tip{margin:0 auto;width:290px;text-align:center;font-size:15px;color:#2466f4;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAcAQMAAACak0ePAAAABlBMVEUAAAAdYfh+GakkAAAAAXRSTlMAQObYZgAAAA5JREFUCNdjwA8acEkAAAy4AIE4hQq/AAAAAElFTkSuQmCC) left center/auto 15px repeat-x}
                    .app-download-tip .guidance-desc{background-color:#fff;padding:0 5px}
                    .app-download-btn{display:block;width:214px;height:40px;line-height:40px;margin:18px auto 0 auto;text-align:center;font-size:18px;color:#2466f4;border-radius:20px;border:.5px #2466f4 solid;text-decoration:none}
                  </style>
                </head>
                <body>
                  <div class="top-bar-guidance">
                    <p>点击右上角<img src="//gw.alicdn.com/tfs/TB1xwiUNpXXXXaIXXXXXXXXXXXX-55-55.png" class="icon-safari"> <span id="openm">浏览器打开</span></p>
                    <p>可以继续浏览本站哦~</p>
                  </div>
                  <div class="app-download-tip">
                    <span class="guidance-desc">或者复制本站网址自行打开</span>
                  </div>
                  <script src="./assets/js/jquery.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
                  <script src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
                  <a data-clipboard-text="'.$url . $id.'" class="app-download-btn">点此复制本站网址</a>
                  <script type="text/javascript">
                    new ClipboardJS(".app-download-btn");
                    $(".app-download-btn").click(function() {
                      layer.tips("复制成功!", ".app-download-btn", {
                      tips: [3, "rgb(38,111,250)"],
                      time:500  
                    });})
                  </script>
                </html>';
        exit;
      }else {
      if (preg_match('/[\x{4e00}-\x{9fa5}]/u',$information) > 0) {
        $informations = parseurl($information);
        //转换url格式（endecode）
      } else {
        $informations = $information;
      }
      if ($access == 'on') {
        access($id,$information,'shorturl');
      }
      //access记录
      header("Refresh:0;url=\"$informations\"");
      exit();
    }
  }
  if ($type == 'passmessage') {
    $status = "passmessage";
    //passmessage
  }
}
}
//初始判断结束,进入增加url界面
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <title>
    <?php echo($title);?>
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.ico" media="screen" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zdhxiong/mdui@0.4.3/dist/css/mdui.min.css">
<script src="https://cdn.jsdelivr.net/gh/zdhxiong/mdui@0.4.3/dist/js/mdui.min.js"></script>
  <script src="//instant.page/1.2.2" type="module" integrity="sha384-2xV8M5griQmzyiY3CDqh1dn4z3llDVqZDqzjzcY+jCBCk/a5fXJmuZ/40JJAPeoU"></script>
  </head>
  <header class="mdui-appbar mdui-appbar-fixed">
  <style>
    a {
      text-decoration:none
    }
    a:hover {
      text-decoration:none
    }
  </style>
  <body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-color-grey-100">
    <div class="mdui-toolbar mdui-color-theme mdui-color-indigo">
      <span class="mdui-btn mdui-btn-icon mdui-ripple" mdui-drawer="{target: '#main-drawer'}">
        <i class="mdui-icon material-icons">&#xe5d2;</i>
      </span>
      <a href="/" class="mdui-typo-title">悄悄话</a>
      <div class="mdui-toolbar-spacer"></div>
      <a href="./help.php" class="mdui-btn mdui-btn-icon">
          <i class="mdui-icon material-icons">&#xe8fd;</i>
        </a>
    </header>
    <div class="mdui-progress" id="progressbar" style="display:none;">
		<div class="mdui-progress-indeterminate"></div>
	</div>
    <div class="mdui-drawer mdui-color-grey-50" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
          <a href="/" class="mdui-list-item">
            <i class="mdui-icon material-icons">&#xe3e0;</i>
            &emsp;主页
          </a>
        </div>
        <a href="./about.php" class="mdui-list-item">
          <i class="mdui-icon material-icons">&#xe88f;</i>
          &emsp;关于
        </a>
        <div class="mdui-collapse-item ">
          <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">&#xe80d;</i>
            &emsp;友链
            <i class="mdui-icon material-icons">&#xe313;</i>
          </div>
          <div class="mdui-collapse-item-body mdui-list">
            <a href="//www.v-gov.net" class="mdui-list-item mdui-ripple ">信息中心</a>
          </div>
          <div class="mdui-collapse-item-body mdui-list">
            <a href="//icp.cmnic.org" class="mdui-list-item mdui-ripple ">备案中心</a>
          </div>
        </div>
      </div>
    </div>
  </div>
