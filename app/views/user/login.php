<!doctype html>
<html lang="en" class="h-100">

    <?php include ROOT . '/app/views/components/head.php' ?>

    <body class="d-flex h-100 text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Taskbook</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">

            <a class="nav-link" href="/tasks">Back</a>
            <a class="nav-link" href="/user/register">Registration</a>
            <a class="nav-link active" aria-current="page" href="#">Login</a>

        </nav>
        </div>
    </header>

    <main class="px-3">
        <form method="post" action="#">
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
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
