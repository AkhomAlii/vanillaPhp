<?php view('partials/header.php'); ?>
<?php view('partials/nav.php'); ?>
<?php view('partials/banner.php', ['head' => $head]); ?>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            Welcome to the Hotel

            <?php foreach ($notes as $note): ?>
                <li>
                    <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <?= $note['body']  ?>
                    </a>
                </li>
            <?php endforeach; ?>
                <br>
                <a href="/notes-create" class="m-8   hover:underline text-blue-500"> Create One!</a>
        </div>
    </main>

<?php view('partials/footer.php'); ?>