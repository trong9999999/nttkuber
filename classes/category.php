<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


<?php



class category extends Database
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $sql = "INSERT INTO pet.tbl_category(catName) values(?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$catName]);
            $count = $stmt->rowCount();
            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $sql = "SELECT * FROM pet.tbl_category order by catId desc";
        $stmt = $this->connect()->query($sql);
        return $stmt;
    }
    public function getcatbyId($id)
    {
        $sql = "SELECT * FROM pet.tbl_category WHERE catId = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }


    public function update_category($catName, $id)
    {

        if (empty($catName)) {
            $alert = "<span class='error'>Category must be not empty</span>";
            return $alert;
        } else {
            $sql = "UPDATE pet.tbl_category SET  catName = ? where catId= ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$catName, $id]);
            $count = $stmt->rowCount();
            if ($count) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }


    public function del_category($id)
    {
        $sql = "DELETE FROM pet.tbl_category WHERE catId = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $count = $stmt->rowCount();
        if ($count) {
            $alert = "<span class='success'>Deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Deleted Not Successfully</span>";
            return $alert;
        }
    }

    //show san pham ra màn hình
    public function show_category_fontend()
    {
        $sql = "SELECT * FROM pet.tbl_category order by catId desc";
        $stmt = $this->connect()->query($sql);
        return $stmt;
    }

    // lay san pham theo danh muc 
    public function get_product_by_cat($id)
    {
        $sql = "SELECT * FROM pet.tbl_product WHERE catId = ? order by catId desc LIMIT 8";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }
    // lấy ten danh muc cua cac san pham thuoc danh muc do

    public function get_name_by_cat($id)
    {
        $sql = "SELECT pet.tbl_product.*, pet.tbl_category.*
            FROM pet.tbl_product INNER JOIN pet.tbl_category ON pet.tbl_product.catId = pet.tbl_category.catId AND pet.tbl_product.catId = ? LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }
}

?>

