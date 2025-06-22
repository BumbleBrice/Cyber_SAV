<h2>Articles récents</h2>
<ul>
<?php foreach ($posts as $post): ?>
    <li>
        <a href="?page=post&id=<?= $post['id'] ?>">
            <?= htmlspecialchars($post['title']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
