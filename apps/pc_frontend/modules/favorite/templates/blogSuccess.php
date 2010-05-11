<?php

op_include_parts(
  'BlogListPage',
  'blogFavorite',
  array(
    'class' => 'recentList',
    'title' => __('The favorite newest blog'),
    'blogRssCacheList' => $blogList,
    'showName' => true
  )
);
