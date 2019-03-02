
<nav>
    <ul>
        <!-- display links for all categories -->
        <?php foreach($categories as $category) : ?>
            <li>
                <a href="?category_id=<?=$category['categoryID']; ?>">
                    <?=$category['categoryName']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

