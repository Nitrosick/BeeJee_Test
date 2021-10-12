<?php

class User
{
    public static function register($name, $email, $password)
    {
        $db = DB::getConnection();

        $select = "INSERT INTO users (`username`, `email`, `password`) VALUES (:name, :email, :password);";

        $result = $db->prepare($select);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name)
    {
        return strlen($name) >= 3 ? true : false;
    }

    public static function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public static function checkEmailExists($email)
    {
        $db = DB::getConnection();

        $select = "SELECT COUNT(*) FROM users WHERE email = :email";

        $result = $db->prepare($select);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) return true;
        return false;
    }

    public static function checkPassword($password)
    {
        return strlen($password) >= 5 ? true : false;
    }

    public static function checkUserData($email, $password)
    {
        $db = DB::getConnection();

        $select = "SELECT * FROM users WHERE email = :email AND password = :password";

        $result = $db->prepare($select);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return [$user['id'], $user['is_admin']];
        }

        return false;
    }

    public static function auth($userData)
    {
        $_SESSION['user'] = $userData[0];
        $_SESSION['is_admin'] = $userData[1];
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return [
                'id' => $_SESSION['user'],
                'is_admin' => $_SESSION['is_admin']
            ];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }

        return true;
    }

    public static function isAdmin()
    {
        if (!self::isGuest() && $_SESSION['is_admin']) {
            return true;
        }

        return false;
    }
}
