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
                <!-- display links for products in selected category -->
                <?php foreach ($products as $product) : ?>
                    <li>
                        <a href="?action=view_product&product_id=<?=$product['gameID']; ?>">
                            <?php echo $product['gameName']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
<?php include '../view/footer.php'; ?>