<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<div class=" ccm-dashboard-section-menu">
    <?php if (count($pages)) { ?>
        <?php foreach ($pages as $page) { ?>
            <p>
                <a
                    href="<?= $page->getCollectionLink(); ?>"
                    title="<?= $page->getCollectionDescription(); ?>"
                    ><?= $page->getCollectionName(); ?>
                </a>
            </p>
        <?php } ?>
    <?php } elseif ($showEmptyText) { ?>
        <p><?= t('No pages found'); ?></p>
    <?php } ?>
</div>