<!doctype html>
<html lang="en" class="h-100">

    <?php include ROOT . '/app/views/components/head.php' ?>

    <body class="d-flex h-100 text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Taskbook</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">

            <?php if (User::isAdmin()): ?>
                <a class="nav-link" href="/tasks/admin/1">Admin</a>
            <?php endif; ?>

            <a class="nav-link" href="/tasks">Tasks</a>
            <a class="nav-link active" aria-current="page" href="#">Add Task</a>

            <?php if (User::isGuest()): ?>
                <a class="nav-link" href="/user/login">Authorization</a>
            <?php else: ?>
                <a class="nav-link" href="/user/logout">Logout</a>
            <?php endif; ?>

        </nav>
        </div>
    </header>

    <main class="px-3">

        <?php if ($result): ?>
            <div class="text-center">The task has been successfully added</div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" action="#">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $name; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Task Text</label>
            <input type="text" class="form-control" id="text" name="text" value="<?php echo $text; ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </form>

        <?php
            if (isset($errors) && is_array($errors)) {

                foreach ($errors as $error) {
                    echo "<span>{$error}</span><br>";
                }
            }
        ?>

    </main>

    <?php include ROOT . '/app/views/components/footer.php' ?>

    </div>

    </body>
</html>
