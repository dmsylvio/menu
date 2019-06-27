<?php

namespace vendor\dmsylvio\menu;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use vendor\dmsylvio\menu\models\Model;

/**
 * menu module definition class
 */
class Menu extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'vendor\dmsylvio\menu\controllers';
    public $defaultRoute = 'creator';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init(); // custom initialization code goes here
    }

    public function get_menu_tree($arr)
    {
        $result = Model::find()->where(['status' => false])
                            ->orderBy(['nome' => SORT_ASC])
                            ->andWhere(['not in', 'id', $arr])
                            ->All();

        // Create an array to conatin a list of items and parents
        $menus = array(
            'items' => array(),
            'parents' => array()
        );

        foreach($result as $items){
            // Create current menus item id into array
            $menus['items'][$items['id']] = $items;
            // Creates list of all items with children
            $menus['parents'][$items['id_parent']][] = $items['id'];
        }

        echo Menu::createTreeView(null, $menus);
    }

    // function to create dynamic treeview menus
    function createTreeView($parent, $menu) {
        $html = '';
        $count = 1;
        if (isset($menu['parents'][$parent])){
            foreach ($menu['parents'][$parent] as $itemId) {
                if(!isset($menu['parents'][$itemId])) {
                    $html .= '<li>';
                    if($menu['items'][$itemId]['new_tab'] == true){
                        $html .= '<a href="'.$menu['items'][$itemId]['link'].'" target="_blank">'.$menu['items'][$itemId]['nome'].'</a>';
                    }else{
                        $html .= '<a href="'.$menu['items'][$itemId]['link'].'">'.$menu['items'][$itemId]['nome'].'</a>';
                    }
                    $html .= '</li>';
                }
                if(isset($menu['parents'][$itemId])) {
                    $html .= '<li>';
                    $html .= '<input type="checkbox" id="'.$count.'">';
                    //$html .= '<label for="'.$count.'" title="Acesse '.$menu['items'][$itemId]['nome'].'" class="titulo">'.$menu['items'][$itemId]['nome'].'</label>';
                    $html .= '<label for="'.$count.'" title="Acesse '.$menu['items'][$itemId]['nome'].'" class="titulo">';
                    if($menu['items'][$itemId]['new_tab'] == true){
                        $html .= '<a href="'.$menu['items'][$itemId]['link'].'" target="_blank">'.$menu['items'][$itemId]['nome'].'</a>';
                    }else{
                        $html .= '<a href="'.$menu['items'][$itemId]['link'].'">'.$menu['items'][$itemId]['nome'].'</a>';
                    }
                    $html .= '</label>';
                    $html .= '<ul>';
                    $html .= Menu::createTreeView($itemId, $menu);
                    $html .= '</ul>';
                    $html .= '</li>';
                }
                $count += 1;
            }

        }
        return $html;
    }
}