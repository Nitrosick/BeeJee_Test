<?php

class TaskController
{
    public function actionIndex($page)
    {
        $tasks = Task::getTasksList($page);
        $tasksList = $tasks['list'];
        $pagesCount = $tasks['pages'];

        require_once ROOT . '/app/views/tasks/index.php';

        return true;
    }

    public function actionCreate()
    {
        $name = '';
        $email = '';
        $text = '';
        $result = false;

        if (isset($_POST['submit']))
        {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $text = $_POST['text'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'The name cannot be shorter than 3 characters';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Invalid e-mail format';
            }

            if (!$errors) {
                $result = Task::add($name, $email, $text);

                $name = '';
                $email = '';
                $text = '';
            }
        }

        require_once ROOT . '/app/views/tasks/create.php';

        return true;
    }

    public function actionAdmin($page)
    {
        $userData = User::checkLogged();
        $userAdmin = $userData['is_admin'];

        if ($userAdmin) {

            $tasks = Task::getTasksList($page);
            $tasksList = $tasks['list'];
            $pagesCount = $tasks['pages'];

            require_once ROOT . '/app/views/tasks/admin.php';

        } else {
            require_once ROOT . '/app/views/tasks/index.php';
        }

        return true;
    }

    public function actionEdit()
    {
        if (isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $text = $_POST['text'];
            $isDone = (!empty($_POST['is_done'])) ? 1 : 0;

            Task::edit($id, $text, $isDone);

            $this->actionAdmin(1);
        }

        require_once ROOT . '/app/views/tasks/admin.php';

        return true;
    }
}
