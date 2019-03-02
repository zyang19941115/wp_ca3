<?php include '../view/header.php'; ?>
    <main>
        <aside>
            <h1>Categories</h1>
            <?php include '../view/category_nav.php'; ?>
        </aside>
        <section>
            <h1><?php echo $name; ?></h1>
            <div id="left_column">
                <p>
                    <img src="<?php echo $image_filename; ?>"
                         alt="<?php echo $image_alt; ?>">
                </p>
            </div>
            <br>
            <div id="right_column">
                <p><b>List Price:</b> $<?php echo $list_price; ?></p>
                <p><b>Discount:</b> <?php echo $discount_percent; ?>%</p>
                <p><b>Your Price:</b> $<?php echo $unit_price_f; ?>
                    (You save $<?php echo $discount_amount_f; ?>)</p>
                <?php if ($has_buy_game) {?>
                    <p>You've already bought this game.</p>
                <?php } else {?>
                    <form id="bug_game"
                          action="index.php" method="post">
                        <input type="hidden" name="action" value="bug_game">
                        <input type="hidden" name="game_id" value="<?=$game_id?>">
                        <input type="submit" value="Buy It">
                    </form>
                <?php }?>

            </div>
        </section>
    </main>
<?php include '../view/footer.php'; ?>