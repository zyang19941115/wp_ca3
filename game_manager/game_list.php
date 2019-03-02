<?php include '../view/header.php'; ?>
    <main>

        <h1>game List</h1>

        <aside>
            <!-- display a list of categories -->
            <h2>Categories</h2>
            <?php include '../view/category_nav.php'; ?>
        </aside>

        <section>
            <!-- display a table of games -->
            <h2><?php echo $category_name; ?></h2>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th class="right">Price</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($games as $game) : ?>
                    <tr>
                        <td><?php echo $game['gameCode']; ?></td>
                        <td><?php echo $game['gameName']; ?></td>
                        <td class="right"><?php echo $game['listPrice']; ?></td>
                        <td><form action="." method="post">
                                <input type="hidden" name="action"
                                       value="show_edit_form">
                                <input type="hidden" name="game_id"
                                       value="<?php echo $game['gameID']; ?>">
                                <input type="hidden" name="category_id"
                                       value="<?php echo $game['categoryID']; ?>">
                                <input type="submit" value="Edit">
                            </form>

                            <form action="." method="post">
                                <input type="hidden" name="action"
                                       value="delete_game">
                                <input type="hidden" name="game_id"
                                       value="<?php echo $game['gameID']; ?>">
                                <input type="hidden" name="category_id"
                                       value="<?php echo $game['categoryID']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><a href="?action=show_add_form">Add game</a></p>
            <p><a href="?action=list_categories">List Categories</a></p>
        </section>

    </main>
<?php include '../view/footer.php'; ?>