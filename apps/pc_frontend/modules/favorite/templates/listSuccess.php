<?php use_helper('Date'); ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('お気に入り') ?></h3></div>

<div class="pagerRelative"><p class="number"><?php echo pager_navigation($pager, 'friend/list?page=%d&id=' . $sf_params->get('id')); ?></p></div>

<div class="block">

<?php foreach ($members as $member): ?>
<div class="ditem"><div class="item"><table><tbody><tr>

<td rowspan="4" class="photo">
<?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), 'member/profile?id=' . $member->getId()); ?><br />
</td>

<th><?php echo __('ニックネーム') ?></th>
<td><?php echo $member->getName() ?></td>
</tr>

<tr>
<th><?php echo $member->getProfile('self_intro')->getCaption() ?></th>
<td><?php echo nl2br($member->getProfile('self_intro')) ?></td>
</tr>

<tr>
<th><?php echo __('最終ログイン') ?></th>
<td style="padding: 0">
<span style="display: block; border-right: 1px solid #CCCCCC; float: left; width: 110px; padding: 5px">
<?php echo distance_of_time_in_words($member->getLastLoginTime()) ?>
</span>
<span style="display: block; padding-top: 5px">
<?php echo link_to(__('詳細を見る'), 'member/profile?id=' . $member->getId()) ?>
<?php echo link_to(__('削除する'), 'favorite/delete?id=' . $member->getId()) ?>
</span>
</td>
</tr>

</tbody></table></div></div>
<?php endforeach; ?>
</div>

<div class="pagerRelative"><p class="number"><?php echo pager_navigation($pager, 'friend/list?page=%d&id=' . $sf_params->get('id')); ?></p></div>

</div></div>
