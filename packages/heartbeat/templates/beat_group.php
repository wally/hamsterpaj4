<?php $counter = new Counter('n1', 'n2'); ?>
<h4><a href="/traffa/groupnotices.php">Dina gruppnotiser <?php echo (count($groups) > 0) ? sprintf('(%d)', $unread) : ''; ?></a></h4>

<ul value="<?php echo $unread; ?>">
    <?php foreach ($groups as $id => $group): ?>
    <li class="<?php echo $counter; ?> <?php echo $group['unread_messages'] > 0 ? 'unread' : ''; ?>"><a href="/traffa/groups.php?action=goto&amp;groupid=<?php echo $id; ?>"><?php echo $group['title']; ?> - <?php echo $group['unread_messages']; ?> nya inl&auml;gg</a></li>
    <?php endforeach; ?>
</ul>
