<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>
<main
    class="ht7-dashboard ht7-library ht7-tools-settings<?php
    echo $isBordered ? ' bordered-settings' : '';
    echo $isStripped ? ' stripped-settings' : '';
    ?>"
    data-bs-tooltips="<?= $isActiveBsTooltips; ?>"
    data-is-saved-by-ajax="<?= $isSavedByAjax; ?>"
    >
    <section>
        <?php
        foreach ($views as $v) {
            echo $v;
        }
//        echo app('helper/ht7/tools/tabs', ['ht7_tabs.settings', $pkgFileConfig]);
//        app('helper/ht7/tools/settings/form')
//                ->setFormUrl($urlSave)
//                ->print($definitions, $pkgHandle);

        View::element(
                'tools/settings/action_buttons',
                compact('fH', 'urlReset'),
                $pkgHandleBase
        );
        ?>
        <script>
            $(function() {
                ht7.tools.settings.init('.ht7-tools-settings');
            });
        </script>
    </section>
    <?php View::element('widgets/body_overlay', [], $pkgHandleBase); ?>
</main>
