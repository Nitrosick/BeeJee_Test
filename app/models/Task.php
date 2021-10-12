<?php

class Task
{
    public static function getTasksList($page)
    {
        $db = DB::getConnection();

        $tasksPerPage = 3;
        $startsWith = 0;
        $tasksList = array();

        $result_1 = $db->query('SELECT COUNT(*) AS `count` FROM tasks');

        $tasksCount = intval($result_1->fetch(PDO::FETCH_ASSOC)['count']);
        $pagesCount = ceil($tasksCount / $tasksPerPage);

        if (is_numeric($page)) {
            $startsWith = $page * $tasksPerPage - $tasksPerPage;
        }

        $result_2 = $db->query("SELECT `id`, `username`, `email`, `text`, `is_done` FROM tasks ORDER BY id LIMIT {$startsWith}, 3");

        $i = 0;
        while ($row = $result_2->fetch(PDO::FETCH_ASSOC))
        {
            $tasksList[$i]['id'] = $row['id'];
            $tasksList[$i]['username'] = $row['username'];
            $tasksList[$i]['email'] = $row['email'];
            $tasksList[$i]['text'] = $row['text'];
            $tasksList[$i]['is_done'] = $row['is_done'];
            $i++;
        }

        return [
            'list' => $tasksList,
            'pages' => $pagesCount
        ];
    }

    public static function add($name, $email, $text)
    {
        $db = DB::getConnection();

        $select = "INSERT INTO tasks (`username`, `email`, `text`) VALUES (:name, :email, :text);";

        $result = $db->prepare($select);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function edit($id, $text, $isDone)
    {
        $db = DB::getConnection();

        $select = "UPDATE tasks SET `text` = :text, `is_done` = :is_done WHERE `id` = {$id};";

        $result = $db->prepare($select);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':is_done', $isDone, PDO::PARAM_INT);
        $result->execute();

        return true;
    }
}
