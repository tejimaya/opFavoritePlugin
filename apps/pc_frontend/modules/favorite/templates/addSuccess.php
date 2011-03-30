<?php use_helper('Date'); ?>
<div class="dparts searchResultList"><div class="parts">
<div class="partsHeading"><h3><?php echo __('Do you add member to the favorite?') ?></h3></div>

<div class="block">

<div class="ditem"><div class="item"><table><tbody><tr>

<td rowspan="4" class="photo">
<?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), 'member/profile?id=' . $member->getId()); ?><br />
<?php echo link_to(__('Show detail'), 'member/profile?id=' . $member->getId()) ?>
</td>

<th><?php echo __('Nickname') ?></th>
<td><?php echo $member->getName() ?></td>
</tr>

<?php $self_intro = $member->getProfile('self_intro'); ?>
<?php if ($self_intro && $self_intro->isViewable()): ?>
<tr>
<th><?php echo $self_intro->getCaption() ?></th>
<td><?php echo $self_intro ?></td>
</tr>
<?php endif; ?>

<tr>
<th><?php echo __('The last login') ?></th>
<td><?php echo distance_of_time_in_words($member->getLastLoginTime()) ?></td>
</tr>

</tbody></table>

<?php $form = new sfForm() ?>
<div style="border-top: 1px solid #CCCCCC; padding: 2px">
<form style="float: left; padding-left: 38%" method="post" action="">
<input type="hidden" name="add" value="1"/>
<input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>"/>
<input style="width: 60px" type="submit" value="<?php echo __('Yes') ?>" /></form>
<form style="float: right; padding-right: 38%" method="post" action="">
<input style="width: 60px" type="submit" value="<?php echo __('No') ?>" /></form>
<div style="clear: left"></div>
</div>

</div></div>
</div>

</div></div>
