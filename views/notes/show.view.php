<?php view('partials/header.php'); ?>
<?php view('partials/nav.php'); ?>
<?php view('partials/banner.php', ['head' => $head]); ?>


    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8  ">
            Welcome to the Hotel
            <br>
            <a href="/notes" class="text-blue-500 hover:underline"> Go Back</a>
            <p class="m-6">
                <?= $note['body'] ?>
            </p>

            <form  method="post">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button type="text" class="text-sm text-red-500">Delete</button>
            </form>
            <a href="/note/edit?id=<?= $note['id'] ?>" class="text-sm text-blue-500">Update</a>

        </div>
    </main>

<?php view('partials/footer.php'); ?>
