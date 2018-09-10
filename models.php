<?php
session_start();

//var_dump($_POST);
class Models
{
    public $age;
    public $comment;
    public $name;
    public $filename;
    public $password;
    private $dsn = "mysql:host=localhost;dbname=vp2;charset=utf8";
    public $pdo;

    function connect(){
        $dsn = "mysql:host=localhost;dbname=vp2;charset=utf8";
        return $pdo = new \PDO($dsn, 'root', '');
    }


    function checkGlobalArray()
    {
        $this->pdo = new \PDO($this->dsn, 'root', '');
        $this->age = $_POST['age'];
        $this->comment = $_POST['comment'];
        $this->name = $_SESSION['username'];
        if (!empty($_POST['name']) and !empty($_POST['password'])) {
            $this->name = $_POST['name'];
            $this->password = $_POST['password'];
        }
        if (!empty($_FILES['image'])) {
            $this->filename = $this->uploadImage($_FILES['image']);
        }
    }


    function addComment()
    {
        $this->checkGlobalArray();
        $sql = "INSERT INTO `posts`(`user_id`, `name`, `age`, `comment`, `image` ) VALUES ('1', '$this->name', '$this->age', '$this->comment', '$this->filename');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        header("Location: ./form.php");
    }

    function uploadImage($image)
    {
        $filename = uniqid() . '.' . pathinfo($image['name'], 4);
        move_uploaded_file($image['tmp_name'], "uploads/" . $filename);
        return $filename;
    }

    public function checkUsers()
    {
        $this->checkGlobalArray();
        $sql = "SELECT * FROM users WHERE `name` = '$this->name' and `password` = '$this->password'";
        $sth = $this->pdo->prepare($sql); // подготавливает
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC); //извлекает. фетч - одномерный массив
        if ($result === false) {
            echo 'такого пользователя не существует';
            echo 'form-singup.php';
            exit;
        } else {
            header("Location: ./form.php");
        }
    }

    public function addUsers()
    {
        $this->checkGlobalArray();
        $sql = "SELECT `id` FROM users WHERE `name` = '$this->name'";
        $sth = $this->pdo->prepare($sql); // подготавливает
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC); //извлекает. фетч - одномерный массив
        if ($result === false) {
            $sql = "INSERT INTO `users`(`name`, `password`, `age`) VALUES ('$this->name', '$this->password', $this->age);";
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            header("Location: ./form.php");
        } else {
            echo 'произошла ошибка, авторизируйтесь';
        }
    }
}
