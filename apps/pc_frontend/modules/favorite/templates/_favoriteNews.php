<?php

if (count($diaryList))
{
  include_parts(
    'diaryListBox',
    'favoriteHomeDiary_'.$gadget->getId(),
    array(
      'title' => __('The favorite newest diary'),
      'list' => $diaryList,
      'showName' => true,
      'moreInfo' => 'favorite/diary',
      'link_to' => 'diary/%d'
    )
  );
}

if (count($blogList))
{
  op_include_parts(
    'BlogListBox',
    'favoriteHomeBlog_'.$gadget->getId(),
    array(
      'class' => 'homeRecentList',
      'title' => __('The favorite newest blog'),
      'blogRssCacheList' => $blogList,
      'showName' => true,
      'moreInfo' => array(link_to(__('More info'), 'favorite/blog')),
    )
  );
}
