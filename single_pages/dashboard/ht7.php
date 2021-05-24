<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="row">
    <?php foreach ($pages as $key => $page) { ?>
        <?php if ($key % 3 == 0) { ?>
        </div>
        <div class="row">
        <?php } ?>
        <div class="col-md-4 ccm-dashboard-section-menu">
            <h2 title="<?= $page->getCollectionDescription(); ?>">
                <?php echo $page->getCollectionName(); ?>
            </h2>
            <?php
            $children = $page->getCollectionChildren();

            if (count($children) > 0) {
                ?>
                <?php foreach ($children as $child) { ?>
                    <p>
                        <a
                            href="<?= $child->getCollectionLink(); ?>"
                            title="<?= $child->getCollectionDescription(); ?>">
                                <?php echo $child->getCollectionName(); ?>
                        </a>
                    </p>
                <?php } ?>
            <?php } else { ?>
                <p><?php echo t('No page found'); ?></p>
            <?php } ?>
        </div>
    <?php } ?>
</div>