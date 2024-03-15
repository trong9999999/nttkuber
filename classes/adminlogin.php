<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkLogin();
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php
class adminlogin extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $sql = "SELECT * FROM pet.tbl_admin WHERE adminUser = ? AND adminPass = ? ";
        $stmt = $this->connect()->prepare($sql);
       
        if (empty($adminUser) || empty($adminPass)) {
            $alert = "Tài khoản và mật khẩu không thể bỏ trống!";
            return $alert;
        } else {
            $stmt->execute([$adminUser, md5($adminPass)]);
            $count = $stmt->rowCount();
            if ($count) {
                $admin_User = $stmt->fetch();
                // print_r($admin_User['adminID']);die;
                Session::set('adminlogin', true);
                Session::set('adminId', $admin_User['adminID']);
                Session::set('adminUser', $admin_User['adminUser']);
                Session::set('adminName', $admin_User['adminName']);
                // header('Location:index.php');
                echo '<script>document.location.href = "./index.php"</script>';
            } else {
                $alert = "Tài khoản và mật khẩu không khớp!";
                return $alert;
            }
        }
    }
    
    public function register_admin($adminUser, $adminPass, $adminName, $adminEmail, $adminAddress, $adminPhone)
{
    if (empty($adminUser) || empty($adminPass) || empty($adminName) || empty($adminEmail) || empty($adminAddress) || empty($adminPhone)) {
        $alert = "Bạn cần nhập các thông tin và không bỏ trống!";
        return $alert;
    } else {
        if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            $alert = "Email không hợp lệ!";
            return $alert;
        }

        $check_email = "SELECT * FROM pet.tbl_admin where adminEmail = ? LIMIT 1";
        $stmt = $this->connect()->prepare($check_email);
        $stmt->execute([$adminEmail]);
        $count = $stmt->rowCount();

        if ($count) {
            $alert = "<span class='error'>Email đã được đăng ký!</span>";
            return $alert;
        } else {
            $sql = "INSERT INTO pet.tbl_admin( `adminUser`, `adminPass`, `adminName`, `adminEmail`, `adminAddress`, `adminPhone`) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$adminUser, md5($adminPass), $adminName, $adminEmail, $adminAddress, $adminPhone]);

            if ($stmt) {
                $alert = "<span class='success'>Đăng ký thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Đã xảy ra lỗi!</span>";
                return $alert;
            }
        }
    }
}

}

?>