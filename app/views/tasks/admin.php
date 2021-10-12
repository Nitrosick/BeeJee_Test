<!doctype html>
<html lang="en" class="h-100">

    <?php include ROOT . '/app/views/components/head.php' ?>

    <body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Taskbook</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">

            <a class="nav-link active" aria-current="page" href="#">Admin</a>
            <a class="nav-link" href="/tasks">Tasks</a>
            <a class="nav-link" href="/tasks/add">Add Task</a>
            <a class="nav-link" href="/user/logout">Logout</a>

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
                <form method="post" enctype="multipart/form-data" action="/tasks/edit">
                <tr>
                    <th scope="row"><?php echo $task['id']; ?></th>
                    <td><?php echo $task['username']; ?></td>
                    <td><?php echo $task['email']; ?></td>

                    <td>
                        <div class="input-group">
                        <textarea class="form-control" name="text"><?php echo $task['text']; ?></textarea>
                        </div>
                    </td>

                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_done"

                            <?php if ($task['is_done']): ?>
                                value="true" id="flexCheckChecked" checked
                            <?php else: ?>
                                value="false" id="flexCheckDefault"
                            <?php endif; ?>

                            >
                        </div>
                    </td>

                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <td><button type="submit" name="submit" class="btn btn-primary">Save</button></td>
                </tr>
                </form>
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
                        echo "<li class='page-item'><a class='page-link' href='/tasks/admin/{$i}'>{$i}</a></li>";
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
