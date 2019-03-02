<?php include '../view/header.php'; ?>
    <main>
        <aside>
            <!-- display a list of categories -->
            <h2>Categories</h2>
            <?php include '../view/category_nav.php'; ?>
        </aside>
        <section>
            <h1><?php echo $category_name; ?></h1>
            <ul class="nav">
                <!-- display links for games in selected category -->
                <?php foreach ($games as $game) : ?>
                    <li>
                        <a href="?action=view_game&game_id=<?=$game['gameID']; ?>">
                            <?php echo $game['gameName']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
<?php include '../view/footer.php'; ?>