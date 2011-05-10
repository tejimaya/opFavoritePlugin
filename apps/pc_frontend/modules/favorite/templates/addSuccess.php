<?php use_helper('Date'); ?>
<div class="dparts form"><div class="parts">

<div class="partsHeading"><h3><?php echo __('Do you add member to the favorite?') ?></h3></div>

<table><tbody>

<tr>
<th><?php echo __('Photo') ?></th>
<td><?php echo link_to(image_tag_sf_image($member->getImageFilename(), array('size' => '76x76')), '@member_profile?id=' . $member->getId()); ?></td>
</tr>

<tr>
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

<tr>
<th><?php echo __('The last login') ?></th>
<td><?php echo op_distance_of_time_in_words($member->getLastLoginTime(), time()) ?></td>
</tr>

</tbody></table>

<?php $form = new BaseForm() ?>
<div class="operation">
<ul class="moreInfo button">
<li>
<form method="post" action="">
<input type="hidden" name="add" value="1"/>
<input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>"/>
<input type="submit" value=<?php echo __('Yes') ?> class="input_submit"/>
</form>
</li>
<li>
<form action="<?php echo url_for('member/' . $member->getId()) ?>">
<input type="submit" value=<?php echo __('No') ?> class="input_submit"/>
</form>
</li>
</ul>
</div>

</div></div>
