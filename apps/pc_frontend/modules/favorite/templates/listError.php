<?php include_box( 'notFavorite', __('Favorite'), __('There is not registration of the favorite yet.')); ?>

<?php use_helper('Javascript') ?>
<p><?php echo link_to_function(__('前のページに戻る'), 'history.back()') ?></p>
