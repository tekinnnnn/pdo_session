<?php
session_start();

class session
{

    public $table;

    public $pdo;

    public $webmaster_only = array();

    public $reg_user_only = array();

    public function __construct($host, $db, $table, $user, $pass, $charset = "utf-8")
    {
        $this->table = $table;
        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset;";
            $this->pdo = new PDO($dsn, $user, $pass);
        } catch (Exception $e) {
            echo "PDO Bağlantı Hatası : " . $e->getMessage();
        }
    }

    public function login_check()
    {
        if (! $_SESSION["u_id"]) {
            if ($_COOKIE["u_id"]) {
                $_SESSION["u_id"] = $_COOKIE["u_id"];
                $_SESSION["u_name"] = $_COOKIE["u_name"];
                $_SESSION["u_sname"] = $_COOKIE["u_sname"];
                $_SESSION["u_mail"] = $_COOKIE["u_mail"];
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function pass_updatable_check()
    {
        return isset($_SESSION["reset"]) && $_SESSION["reset"]["1"] >= time() ? true : false;
    }

    public function login($buttonname = "giris", $inputmail = "email", $inputpass = "password", $remember = "hatirla")
    {
        $mail = trim($_POST[$inputmail]);
        $pass = md5($_POST[$inputpass]);
        $rm = $_POST[$remember] == on ? true : false;
        
        $check = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE mail = '$mail' and sifre = '$pass' LIMIT 0,1");
        $numcheck = $check->rowCount();
        if ($numcheck == 1) {
            $row = $check->fetch();
            $_SESSION["u_id"] = $row["id"];
            $_SESSION["u_name"] = $row["adi"];
            $_SESSION["u_sname"] = $row["soyadi"];
            $_SESSION["u_mail"] = $row["mail"];
            
            if ($rm) {
                setcookie("u_id", $row["id"], time() + (60 * 60 * 24));
                setcookie("u_name", $row["adi"], time() + (60 * 60 * 24));
                setcookie("u_sname", $row["soyadi"], time() + (60 * 60 * 24));
                setcookie("u_mail", $row["mail"], time() + (60 * 60 * 24));
            }
            if (isset($_SESSION["reset"])) {
                unset($_SESSION["reset"]);
            }
            echo "<script>window.location.href = 'admin.php';</script>";
        } else {
            echo $numcheck;
            echo "<script>alert('Mail ya da Şifre hatalı!');</script>";
            echo "<script>window.location.href = 'giris.php';</script>";
        }
    }

    public function register($buttonname = "kayit", $inputmail = "email", $inputpass = "sifre", $inputname = "adi", $inputsname = "soyadi", $inputgsoru = "gsoru")
    {
        $mail = trim($_POST[$inputmail]);
        $pass = md5($_POST[$inputpass]);
        $name = trim($_POST[$inputname]);
        $sname = trim($_POST[$inputsname]);
        $gsoru = trim($_POST[$inputgsoru]);
        
        $check = $this->pdo->query("SELECT COUNT(*) FROM " . $this->table . " WHERE mail = '$mail'");
        $numcheck = $check->fetchColumn();
        if ($numcheck > 0) {
            echo $numcheck;
            echo "<script>alert('Bu mail adresi ile daha önceden kayıt yapılmış');</script>";
            echo "<script>window.location.href = 'kayit.php';</script>";
        } else {
            $register = $this->pdo->prepare("INSERT INTO " . $this->table . " VALUES (?,?,?,?,?,now(),?)");
            if ($register->execute(array(
                null,
                $mail,
                $pass,
                $name,
                $sname,
                $gsoru
            ))) {
                $u_id = $this->pdo->lastInsertId();
                $user = $this->pdo->query("SELECT * FROM ".$this->table." WHERE id = '$u_id'");
                $user = $user->fetch();
                $_SESSION["u_id"] = $user["id"];
                $_SESSION["u_name"] = $user["adi"];
                $_SESSION["u_sname"] = $user["soyadi"];
                $_SESSION["u_mail"] = $user["mail"];
                if (isset($_SESSION["reset"])) {
                    unset($_SESSION["reset"]);
                }
                echo "<script>window.location.href = 'admin.php';</script>";
            } else {
                echo "<script>alert('Kayıt işlemi hatalı!');</script>";
                echo "<script>window.location.href = 'kayit.php';</script>";
            }
        }
    }

    public function update_open($buttonname = "sifirla", $buttonquest = "gsoru", $buttonmail = "email")
    {
        $gsoru = $_POST[$buttonquest];
        $email = $_POST[$buttonmail];
        $check = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE mail = '$email' and gsoru = '$gsoru'");
        $check->execute();
        $numcheck = $check->columnCount();
        $data = $check->fetch();
        if ($numcheck > 0) {
            $_SESSION["reset"][0] = $data["id"];
            $_SESSION["reset"][1] = time() + (60 * 3);
            echo "<script>window.location.href = 'sreset.php';</script>";
        } else {
            echo "<script>alert('E-Mail ve gizli cevap uyuşmuyor!');</script>";
            echo "<script>window.location.href = 'sifirla.php';</script>";
        }
    }

    public function update($buttonname = "ssifirla", $buttonpass1 = "password", $buttonpass2 = "repassword")
    {
        if ($this->pass_updatable_check()) {
            if ($_POST[$buttonpass1] == $_POST[$buttonpass2]) {
                $pass = md5($_POST[$buttonpass1]);
                if ($this->pdo->exec("UPDATE " . $this->table . " SET `sifre`='" . $pass . "' WHERE `id` = '" . $_SESSION["reset"]["0"] . "'")) {
                    session_unset();
                    session_destroy();
                    echo "<script>alert('Tebrikler, şifreniz sıfırlandı! Yeni şifrenizle giriş yapabilirsiniz..');</script>";
                    echo "<script>window.location.href = 'giris.php';</script>";
                } else {
                    echo "<script>alert('Hata!');</script>";
                }
            } else {
                echo "<script>alert('Girilen şifreler uyuşmuyor!');</script>";
                echo "<script>window.location.href = 'sreset.php';</script>";
            }
        } else {
            session_unset();
            session_destroy();
            echo "<script>alert('3 dakika içerisinde işlem yapmadınız. Tekrar gizli soru doğrulama sayfasına yönlendiriliyorsunuz...');</script>";
            echo "<script>window.location.href = 'sifirla.php';</script>";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie("u_id", "", time() - 1);
        setcookie("u_name", "", time() - 1);
        setcookie("u_sname", "", time() - 1);
        setcookie("u_mail", "", time() - 1);
        echo "<script>window.location.href='./';</script>";
    }
}
?>