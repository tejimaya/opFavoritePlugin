<?php if (count($diaryList)): ?>
<?php use_helper('opDiary') ?>
<?php
$list = array();
foreach ($diaryList as $diary)
{
  $list[] = sprintf("[%s] %s<br>%s",
              op_format_date($diary->created_at, 'XShortDate'),
              $diary->Member->name,
              link_to(op_diary_get_title_and_count($diary, false, 28), 'diary_show', $diary)
            );
}
$moreInfo = array();
$moreInfo[] = link_to(__('More'), '@favorite_diary');
$options = array(
  'title' => __('The favorite newest diary'),
  'border' => true,
  'moreInfo' => $moreInfo,
);
op_include_list('friendDiaryList', $list, $options);
?>
<?php endif ?>
