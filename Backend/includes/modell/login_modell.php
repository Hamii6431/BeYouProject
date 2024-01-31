<?php
// login_model.php
class LoginModel {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function processLogin($login_username, $login_password) {
        // Login logika...

        // Ellenőrizzük az user_table-ban
        $select_user_query = "SELECT * FROM user_table WHERE username = '$login_username'";
        $result_user_select = mysqli_query($this->con, $select_user_query);

        if ($result_user_select && mysqli_num_rows($result_user_select) == 1) {
            $row_user = mysqli_fetch_assoc($result_user_select);
            $hashed_password_user = $row_user['password'];

            if (password_verify($login_password, $hashed_password_user)) {
                // Sikeres bejelentkezés az user_table-ból
                $_SESSION['user_id'] = $row_user['user_ID'];
                $_SESSION['user_username'] = $row_user['username'];
                $_SESSION['user_email'] = $row_user['email'];
                header("location: /BeYou_web/Beyouproject/Frontend/user_area/profilepage.php");
                exit();
            }
        }

        // Ellenőrizzük a table_admin-ban, ha az user_table-ben nem található
        $select_admin_query = "SELECT * FROM table_admin WHERE admin_username = '$login_username'";
        $result_admin_select = mysqli_query($this->con, $select_admin_query);

        if ($result_admin_select && mysqli_num_rows($result_admin_select) == 1) {
            $row_admin = mysqli_fetch_assoc($result_admin_select);
            $hashed_password_admin = $row_admin['admin_password'];

            if (password_verify($login_password, $hashed_password_admin)) {
                // Sikeres bejelentkezés a table_admin-ból
                $_SESSION['admin_id'] = $row_admin['admin_ID'];
                $_SESSION['admin_username'] = $row_admin['admin_username'];
                $_SESSION['user_type'] = 'admin'; // Hozzáadva az admin típusa
                header("location: /BeYou_web/Beyouproject/admin_area/index.php");
                exit();
            }
        }

        // Ha mindkét ellenőrzés sikertelen (User,Admin bejelentkezés) akkor hibás a felhasználónév vagy jelszó
        echo "<script>alert('Invalid username or password. Please try again.')</script>";
    }

    // További model funkciók...

    // Példa: felhasználó adatainak lekérése ID alapján
    public function getUserById($userId) {
        $select_user_query = "SELECT * FROM user_table WHERE user_ID = '$userId'";
        $result_user_select = mysqli_query($this->con, $select_user_query);

        return ($result_user_select && mysqli_num_rows($result_user_select) == 1) ? mysqli_fetch_assoc($result_user_select) : null;
    }
}
?>
