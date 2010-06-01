<?php

op_mobile_page_title(__('Favorite'), __('Member list'));

echo '<center>';
echo pager_total($pager);
echo '</center>';

$list = array();
foreach ($members as $member)
{
  $list[] = link_to($member->getName(), '@member_profile?id='.$member->getId())
          . '['.link_to(__('Delete'), '@favorite_delete?id='.$member->getId()).']';
}
$options = array(
  'border' => true,
);
op_include_list('introFriend', $list, $options);

op_include_pager_navigation($pager, '@favorite_list?page=%d');
