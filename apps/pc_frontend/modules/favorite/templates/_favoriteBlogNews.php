<?php if (count($blogList)): ?>

<?php
op_include_parts(
  'BlogListBox',
  'favoriteHomeBlog_'.$gadget->getId(),
  array(
    'class' => 'homeRecentList',
    'title' => __('The favorite newest blog'),
    'blogRssCacheList' => $blogList,
    'showName' => true,
    'moreInfo' => array(link_to(__('More info'), '@favorite_blog')),
  )
)
?>

<?php endif ?>
