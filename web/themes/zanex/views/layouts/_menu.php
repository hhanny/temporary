<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use yii\helpers\Html;

$callback = function ($menu) {
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'],
        'icon' => $menu['icon'],
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
};
$menu = MenuHelper::getAssignedMenu(Yii::$app->user->getId(), null, null, true);

$controller = Yii::$app->controller->id;

$title = '';
foreach ($menu as $row) {
    if (isset($row['items'])) {
        echo '<li aria-haspopup="true">';
        echo Html::a('<i class="' . $row['icon'] . '"></i>' . $row['label'] . ' <i class="fa fa-angle-down horizontal-icon" ></i >', null, ['class' => 'sub-icon']);
        echo '<ul class="sub-menu">';
        foreach ($row['items'] as $val) {
            if (isset($val['items'])) {
                echo '<li aria-haspopup="true">';
                echo Html::a('<i class="' . $val['icon'] . '"></i>' . $val['label'], null, ['class' => 'sub-menu-sub']);
                echo '<ul class="sub-menu">';
                foreach ($val['items'] as $xval) {
                    echo '<li aria-haspopup="true">' . Html::a('<i class="' . $xval['icon'] . '"></i> ' . $xval['label'], Url::toRoute([$xval['url'][0]]), ['class' => 'slide-item']) . '</li>';
                }
                echo '</ul>';
                echo '<li>';
            } else {
                echo '<li aria-haspopup="true">' . Html::a('<i class="' . $val['icon'] . '"></i> ' . $val['label'], Url::toRoute([$val['url'][0]]), ['class' => 'slide-item']) . '</li>';
            }
        }
        echo '</ul>';
        echo '<li>';
    } else {
        echo '<li aria-haspopup="true">' . Html::a('<i class="' . $row['icon'] . '"></i>' . $row['label'], Url::toRoute([$row['url'][0]])) . '</li>';
    }
}
echo '<title>' . ucfirst($title) . '</title>';
?>