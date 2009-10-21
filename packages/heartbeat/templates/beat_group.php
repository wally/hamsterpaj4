<?php $counter = new Counter('n1', 'n2'); ?>
<h4>Dina gruppnotiser <?php echo (count($groups) > 0) ? sprintf('(%d)', count($groups)) : ''; ?></h4>

<ul>
    <?php foreach ($groups as $id => $group): ?>
    <li class="<?php echo $counter; ?>"><a href="/traffa/groups.php?action=goto&amp;groupid=<?php echo $id; ?>"><?php echo $group['title']; ?> - <?php echo $group['unread_messages']; ?> nya inl&auml;gg</a></li>
    <?php endforeach; ?>
</ul>
<div id="footer" />
