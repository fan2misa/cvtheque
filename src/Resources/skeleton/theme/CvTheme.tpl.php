<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Theme\<?= $parent_class_name; ?>;

class <?= $class_name; ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{
    public function getThemeName() {
        return '<?= $theme_name; ?>';
    }

    public function run() {

    }
}
