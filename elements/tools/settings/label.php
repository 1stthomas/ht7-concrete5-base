<?php
defined('C5_EXECUTE') or die('Access Denied.');

/* @var $item \Concrete\Package\Ht7C5Base\Ht7Tools\Settings\Models\LabelModel */
?>
<label class="control-label" for="<?= $item->getFor(); ?>">
    <span><?php echo $item->getLabel(); ?> </span>
    <?php if (!empty($item->getTitle())) { ?>
        <i
            class="fa fa-question-circle"
            data-toggle="tooltip"
            title="<?= $item->getTitle(); ?>">
        </i>
    <?php } ?>
</label>
