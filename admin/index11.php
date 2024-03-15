<?php
include_once '../lib/session.php';
Session::checkSession();
?>
<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<div class="grid_10">
  <div class="box round first grid">
    <h2> Dashbord</h2>
    <div class="block">
      Chào mừng bạn đến với trang chủ admin!
    </div>
  </div>
</div>
<?php include_once 'inc/footer.php'; ?>