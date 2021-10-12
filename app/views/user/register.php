<!doctype html>
<html lang="en" class="h-100">

    <?php include ROOT . '/app/views/components/head.php' ?>

    <body class="d-flex h-100 text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Taskbook</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link" href="/tasks/1">Back</a>
            <a class="nav-link active" aria-current="page" href="#">Registration</a>
            <a class="nav-link" href="/user/login">Login</a>
        </nav>
        </div>
    </header>

    <main class="px-3">

        <?php if ($result): ?>
            <div class="text-center">You are registered</div>
        <?php else: ?>

            <form method="post" action="#">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </form>

            <?php
                if (isset($errors) && is_array($errors)) {

                    foreach ($errors as $error) {
                        echo "<span>{$error}</span><br>";
                    }
                }
            ?>
        <?php endif; ?>

    </main>

    <?php include ROOT . '/app/views/components/footer.php' ?>

    </div>

    </body>
</html>
