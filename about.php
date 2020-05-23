<?php
if(!file_exists("install.lock")){
header("Refresh:0;url=\"./install.php\"");
exit("正在跳转到安装界面...");
}else{
}
require_once('header.php');
echo <<<EOF
<br />
<div class="mdui">
    <!--<div class="mdui-col-sm-6 mdui-col-md-4">-->
      <div class="mdui-card" style="max-width:800px;margin:20px 20px 30px;">
      <div class="mdui-card-header">
    <img class="mdui-card-header-avatar" src="https://www.v-gov.net/logo-r.svg"/>
    <div class="mdui-card-header-title">CMNIC 悄悄话程序</div>
    <div class="mdui-card-header-subtitle">Powered by <a class="mdui-ripple mdui-text-color-black-text" href="//github.com/soxft/URLshorting">星辰短域|密语</a></div>
  </div>
  <div class="mdui-card-content">
<h3>星辰短域|密语 版权信息</h3>
版本：$version<br/>
<br/>
作者：XCSOFT(XSOT.CN)<br/>
<br/>
使用语言(框架)：PHP HTML MDUI MYSQL<br/>
<br/>
协议：Apache
<br/><hr/><br/>
<h3>悄悄话 版权信息</h3>
版本：1.0<br/>
<br/>
作者：Li Yan<br/>
<br/>
基于：星辰短域|密语<br/>
<br/>
协议：GPLv3
  </div>
  <div class="mdui-card-actions">
<a class="mdui-btn mdui-ripple" href="/">官网</a>
<a class="mdui-btn mdui-ripple" href="https://github.com/cmnic/UrlShorting">Github</a>
<a class="mdui-btn mdui-ripple" href="//github.com/soxft/URLshorting">星辰短域</a>
  </div>
</div>
EOF;
require_once('footer.php');
?>
