<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use yii\helpers\Html;

$callback = function ($menu) {
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
};
$menu = MenuHelper::getAssignedMenu(Yii::$app->user->id);
?>

<?php
foreach ($menu as $row) {
    if (isset($row['items'])) {
        echo '<li class="slide">';
        echo Html::a('<i class="side-menu__icon ' . $row['icon'] . '"></i> <span class="side-menu__label">' . $row['label'] . '</span><i class="angle fa fa-angle-right"></i>', Url::toRoute([$row['url'][0]]), ['class' => 'side-menu__item', 'data-bs-toggle' => 'slide']);
        echo '<ul class="slide-menu" style="display: none;">';
        foreach ($row['items'] as $val) {
            echo '<li>' . Html::a('<i class="' . $val['icon'] . '"></i> ' . $val['label'], Url::toRoute([$val['url'][0]]), ['class' => 'slide-item']) . '</li>';
        }
        echo '</ul>';
        echo '<li>';
    } else {
        echo '<li>';
        echo Html::a('<i class="side-menu__icon ' . $row[''] . '"></i> <span class="side-menu__label">' . $row['label'] . '</span><i class="angle fa fa-angle-right"></i>', Url::toRoute([$row['url'][0]]), ['class' => 'side-menu__item', 'data-bs-toggle' => 'slide']);
        echo '</li>';
    }

}
?>