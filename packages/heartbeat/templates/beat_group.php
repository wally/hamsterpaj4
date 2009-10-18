<h4>Dina gruppnotiser</h4>

<ul>
    <?php foreach ($groups as $id => $group): ?>
    <li><a href="/traffa/groups.php?action=goto&amp;groupid=<?php echo $id; ?>"><?php echo $group['name']; ?> - <?php echo $group['unread']; ?> nya inl&auml;gg</a></li>
    <?php endforeach; ?>
</ul>