<?php
session_start();
if(!isset($_SESSION['shorturl']))
{
 header("Refresh:0;url=\"./index.php\"");
 exit();
}
require_once "header.php";
require_once "./app/qrcode.php";
$shorturl = $_SESSION['shorturl'];
?>
<div class="mdui-container doc-container">
    <div class="mdui-typo">
        <h2>创建成功!</h2>
        <center>
          <br />
          <?php qrcode($shorturl,"show"); ?>
          <h3>下方复制链接</h3>
          <br>
          <pre style="user-select:all;"><?php echo $shorturl ?></pre>
        </center>
    </div>
</div>
<?php
unset($_SESSION['shorturl']);
require_once "footer.php";
?>
