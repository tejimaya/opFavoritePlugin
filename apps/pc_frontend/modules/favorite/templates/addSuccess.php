<?php use_helper('Date'); ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('お気に入りに以下のメンバーを追加しますか？') ?></h3></div>

<div class="block">

<div class="ditem"><div class="item"><table><tbody><tr>

<td rowspan="4" class="photo">
<?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), 'member/profile?id=' . $member->getId()); ?><br />
<?php echo link_to(__('詳細を見る'), 'member/profile?id=' . $member->getId()) ?>
</td>

<th><?php echo __('ニックネーム') ?></th>
<td><?php echo $member->getName() ?></td>
</tr>

<tr>
<th><?php echo $member->getProfile('self_intro')->getCaption() ?></th>
<td><?php echo $member->getProfile('self_intro') ?></td>
</tr>

<tr>
<th><?php echo __('最終ログイン') ?></th>
<td><?php echo distance_of_time_in_words($member->getLastLoginTime()) ?></td>
</tr>

</tbody></table>

<div style="border-top: 1px solid #CCCCCC; padding: 2px">
<form style="float: left; padding-left: 38%" method="post" action="">
<input type="hidden" name="add" value=true>
<input style="width: 60px" type="submit" value="<?php echo __('はい') ?>" /></form>
<form style="float: right; padding-right: 38%" method="post" action="">
<input style="width: 60px" type="submit" value="<?php echo __('いいえ') ?>" /></form>
<div style="clear: left"></div>
</div>

</div></div>
</div>

</div></div>
