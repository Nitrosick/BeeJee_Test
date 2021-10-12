<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit']))
        {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'The name cannot be shorter than 3 characters';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Invalid e-mail format';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'E-mail already exists';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'The password cannot be shorter than 5 characters';
            }

            if (!$errors) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once ROOT . '/app/views/user/register.php';

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Incorrect e-mail';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'The password cannot be shorter than 5 characters';
            }

            $userData = User::checkUserData($email, $password);

            if (!$userData) {
                $errors[] = 'Incorrect data';
            } else {
                User::auth($userData);

                header("Location: /tasks/1");
            }
        }

        require_once ROOT . '/app/views/user/login.php';

        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['is_admin']);
        header("Location: /tasks/1");
    }
}
