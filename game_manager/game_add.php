<?php include '../view/header.php'; ?>
    <main>
        <h1>Add game</h1>
        <form action="index.php" method="post" id="add_game_form">
            <input type="hidden" name="action" value="add_game">

            <label>Category:</label>
            <select name="category_id">
                <?php foreach ( $categories as $category ) : ?>
                    <option value="<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <label>Code:</label>
            <input type="input" name="code">
            <br>

            <label>Name:</label>
            <input type="input" name="name">
            <br>

            <label>List Price:</label>
            <input type="input" name="price">
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Add game">
            <br>
        </form>
        <p class="last_paragraph">
            <a href="index.php?action=list_games">View game List</a>
        </p>

    </main>
<?php include '../view/footer.php'; ?>