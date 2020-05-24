# 悄悄话
## 简介
![image.png](https://i.loli.net/2020/05/24/msMT7ztKZOdJn85.png)

演示站： [悄悄话](https://url.v-gov.net)

原项目： [星辰短域](https://github.com/soxft/UrlShorting)
## 安装方法
1.下载源码.<br/>
2.上传至你的网站根目录.<br/>
3.访问网站域名填写mysql等信息进行安装<br/>
4.修改网站伪静态配置:<br/>
Nginx:  
```
if (!-e $request_filename) {
rewrite ^/(.*)$ /index.php?id=$1 last;
}
```
Apache:
```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /index.php?id=$1 [L]
</IfModule>
```

## 版权

GPLv3<br/>
[CMNIC](https://github.com/cmnic) 版权所有。

## 原项目版权
[星辰短域](https://github.com/soxft/UrlShorting)<br />
[XCSOFT](https://xsot.cn/) 版权所有。

