<?php include '../view/header.php'; ?>
    <main>

        <h1>Category List</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['categoryName']; ?></td>
                    <td><?php $status = $category['is_deleted'] ? "Is Deleted" : "In Use"; echo $status; ?></td>
                    <td>
                        <?php if (!$category['is_deleted']) {?>
                            <form id="delete_game_form"
                                  action="index.php" method="post">
                                <input type="hidden" name="action" value="delete_category">
                                <input type="hidden" name="category_id"
                                       value="<?php echo $category['categoryID']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        <?php }?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br />

        <h2>Add Category</h2>
        <form id="add_category_form"
              action="index.php" method="post">
            <input type="hidden" name="action" value="add_category">

            <label>Name:</label>
            <input type="input" name="name">
            <input type="submit" value="Add">
        </form>

        <p><a href="index.php?action=list_games">List games</a></p>

    </main>
<?php include '../view/footer.php'; ?>