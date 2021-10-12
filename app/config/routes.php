<?php

return array(
    'tasks/admin/([0-9]+)' => 'task/admin/$1',
    'tasks/admin' => 'task/admin/1',

    'tasks/([0-9]+)' => 'task/index/$1',
    'tasks/add' => 'task/create',
    'tasks/edit' => 'task/edit',
    'tasks' => 'task/index/1',

    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',

    '' => 'task/index/1'
);
