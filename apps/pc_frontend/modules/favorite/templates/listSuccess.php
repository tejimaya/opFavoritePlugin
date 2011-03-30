<?php use_helper('Date') ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Favorite') ?></h3></div>

<?php op_include_pager_navigation($pager, '@favorite_list?page=%d') ?>

<div class="block">

<?php $form = new BaseForm() ?>
<?php foreach ($members as $member): ?>
<div class="ditem"><div class="item">
<table><tbody>

<tr>
<td rowspan="2" class="photo">
<?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), '@member_profile?id=' . $member->getId()); ?><br />
</td>
<th><?php echo __('Nickname') ?></th>
<td><?php echo $member->getName() ?></td>
</tr>

<?php $self_intro = $member->getProfile('self_intro'); ?>
<?php if ($self_intro && $self_intro->isAllowed($sf_user->getMember()->getRawValue(), 'view')): ?>
<tr>
<th><?php echo $self_intro->getCaption() ?></th>
<td><?php echo nl2br($self_intro) ?></td>
</tr>
<?php endif ?>

<tr class="operation">
<th><?php echo __('The last login') ?></th>
<td>
<span class="text"><?php echo op_distance_of_time_in_words($member->getLastLoginTime(), time()) ?></span>
<span class="moreInfo">
<?php echo link_to(__('Show detail'), '@member_profile?id='.$member->getId()) ?>
 <?php echo link_to(__('Delete'), '@favorite_delete?id='.$member->getId().'&'.$form->getCSRFFieldName().'='.$form->getCSRFToken()) ?>
</span>
</td>
</tr>

</tbody></table>
</div></div>
<?php endforeach; ?>

<?php op_include_pager_navigation($pager, '@favorite_list?page=%d') ?>

</div></div></div>
