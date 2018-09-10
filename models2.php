<?php
session_start();

class ModelsTwo
{
    public $pdo;
    private $dsn = "mysql:host=localhost;dbname=vp2;charset=utf8";

    public function GetFileUrl()
    {
        $this->pdo();
        $sql = "SELECT `image` FROM posts ORDER BY `id` desc; ";
        $sth = $this->pdo->prepare($sql); // подготавливает
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC); //извлекает. фетч - одномерный массив
        if ($result === false) {
            echo 'не добавлено изображений';
        } else {
            echo '<pre>';
            // var_dump($result);
            foreach ($result as $value => $key) {
                foreach ($key as $v => $k) {
                    echo " <img src ='uploads/" . $k . '/>';
                }
            }

        }
    }

    function pdo()
    {
        $this->pdo = new \PDO($this->dsn, 'root', '');
    }

    public function GetUsers()
    {
        $this->pdo();
        $sql = "SELECT `name`, `age` FROM users ORDER BY `age` desc";
        $sth = $this->pdo->prepare($sql); // подготавливает
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC); //извлекает. фетч - одномерный массив
        echo '<pre>';
        if ($result === false) {
            echo 'не добавлено изображений';
        } else {
            foreach ($result as $value => $key) {
                if ($key[age] >= 18) {
                    $key[age] .= 'лет, совершеннолетний';
                }else{
                    $key[age] .= 'лет, несовершеннолетний';
                }
                echo 'Имя ' . $key[name] . ' - ' . $key[age] . '<br>';

            }
        }

    }
}