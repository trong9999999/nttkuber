<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once '../classes/category.php' ?>
<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');

?>


<?php

if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerid'];
}
$cs = new customer();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin khách hàng</h2>

        <div class="block copyblock">
            <?php
            // $id = Session::get('customer_id');
            $get_customer = $cs->show_customers($id);
            if ($get_customer) {
                while ($result = $get_customer->fetch()) {


            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>Tên:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>
                                    <input type="text" readonly="redonly" value="<?php echo $result['email'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['sodienthoai'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ:</td>
                                <td>
                                    <input type="text" readonly="redonly" value="<?php echo $result['diachi'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>

                        </table>
                    </form>
            <?php
                }
            }
            ?>


        </div>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>