<?php use_helper('opDiary'); ?>

<?php $title = __('The favorite newest diary') ?>
<?php if ($pager->getNbResults()): ?>
<div class="dparts recentList"><div class="parts">
<div class="partsHeading"><h3><?php echo $title ?></h3></div>
<?php op_include_pager_navigation($pager, '@favorite_diary?page=%d'); ?>
<?php foreach ($pager->getResults() as $diary): ?>
<dl>
<dt><?php echo op_format_date($diary->getCreatedAt(), 'XDateTimeJa') ?></dt>
<dd><?php echo link_to(op_diary_get_title_and_count($diary), '@diary_show?id='.$diary->getId()) ?> (<?php echo $diary->getMember()->getName() ?>)<?php if ($diary->getHasImages()) : ?> <?php echo image_tag('icon_camera.gif', array('alt' => 'photo')) ?><?php endif; ?></dd>
</dl>
<?php endforeach; ?>
<?php op_include_pager_navigation($pager, '@favorite_diary?page=%d'); ?>
</div></div>
<?php else: ?>
<?php op_include_box('diaryList', __('There are no diaries'), array('title' => $title)) ?>
<?php endif; ?>
