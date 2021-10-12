<!doctype html>
<html lang="en" class="h-100">

    <?php include ROOT . '/app/views/components/head.php' ?>

    <body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Taskbook</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">

            <?php if (User::isAdmin()): ?>
                <a class="nav-link" href="/tasks/admin/1">Admin</a>
            <?php endif; ?>

            <a class="nav-link active" aria-current="page" href="#">Tasks</a>
            <a class="nav-link" href="/tasks/add">Add Task</a>

            <?php if (User::isGuest()): ?>
                <a class="nav-link" href="/user/login">Authorization</a>
            <?php else: ?>
                <a class="nav-link" href="/user/logout">Logout</a>
            <?php endif; ?>

        </nav>
        </div>
    </header>

    <main class="px-3">

        <table class="table table-dark" id="tasks-table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Task text</th>
            <th scope="col">Done</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($tasksList as $task) :?>
                <tr>
                    <th scope="row"><?php echo $task['id']; ?></th>
                    <td><?php echo $task['username']; ?></td>
                    <td><?php echo $task['email']; ?></td>
                    <td><?php echo $task['text']; ?></td>
                    <td><?php echo $task['is_done'] ? '&#10004;' : 'x'; ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
        </table>

        <nav aria-label="...">
        <ul class="pagination pagination-sm justify-content-center">
            <?php
                for ($i = 1; $i <= $pagesCount; $i++) {
                    if ($page == $i) {
                        echo "<li class='page-item active' aria-current='page'><span class='page-link'>{$i}</span></li>
                        ";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='/tasks/{$i}'>{$i}</a></li>";
                    }
                }
            ?>
        </ul>
        </nav>

    </main>

    <?php include ROOT . '/app/views/components/footer.php' ?>

    </div>

    <script src='/app/assets/js/tablesort/tablesort.js'></script>

    <script>
        new Tablesort(document.getElementById('tasks-table'));
    </script>

    </body>
</html>
