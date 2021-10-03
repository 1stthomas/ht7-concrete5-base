<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<div class="ccm-dashboard-form-actions-wrapper">
    <div class="ccm-dashboard-form-actions">
        <?php if ($urlReset) { ?>
            <input
                class="btn btn-default pull-left"
                data-url="<?= $urlReset; ?>"
                type="reset"
                value="<?= tc('ht7_c5_library', 'Abort'); ?>"
                />
            <?php
        }
        echo $fH->submit(
                'ht7-tools-settings-save',
                tc('ht7_c5_library', 'Save'),
                [],
                'btn-primary pull-right'
        );
        ?>
    </div>
</div>
