<?php
defined('C5_EXECUTE') or die("Access Denied.");

if ($fb->has('error')) {
    $msg = $fb->get('error');
    $classAdd = 'danger';
} elseif ($fb->has('success')) {
    $msg = $fb->get('success');
    $classAdd = 'success';
}

if ($classAdd):
    ?>
    <div class="alert alert-<?= $classAdd; ?>" role="alert">
        <a
            aria-label="close"
            class="close"
            data-dismiss="alert"
            href="javascript:void(0)"
        >
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
        <?php if (is_array($msg)): ?>
            <?php foreach ($msg as $m): ?>
                <p><?= $m; ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p><?= $msg; ?></p>
        <?php endif; ?>
    </div>
    <?php
endif;
