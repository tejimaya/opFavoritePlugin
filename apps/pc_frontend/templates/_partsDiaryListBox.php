<?php use_helper('opDiary') ?>

<?php
$options->setDefault('showName', true);
?>

<ul class="articleList">
<?php foreach ($options['list'] as $diary): ?>
<li><span class="date"><?php echo op_format_date($diary->created_at, 'XShortDateJa') ?></span><?php echo op_diary_link_to_show($diary) ?></li>
<?php endforeach; ?>
</ul>
