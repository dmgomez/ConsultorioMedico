<?php

/**
 * @author Morris Jencen O. Chavez <macinville@gmail.com>
 * @license http://www.yiiframework.com/license/
 */

/**
 * MTreeView extends CTreeView, which displays a tree view of hierarchical data.
 * It can handle both nested set and adjacency hierarchy model. It also creates
 * link and adds icon if available.
 *
 * References (aside from Yii docs):
 * http://stackoverflow.com/questions/841014/nested-sets-php-array-and-transformation
 * http://semlabs.co.uk/journal/converting-nested-set-model-data-in-to-multi-dimensional-arrays-in-php
 * http://www.fliquidstudios.com/2008/12/23/nested-set-in-mysql/
 * http://snipplr.com/view/4383/build-nested-array-from-sql/
 */
class MTreeView extends CTreeView {

    //private properties
    private $_tree;
    private $_menus;
    private $_fields_adjacency = array(
        'id' => 'id',
        'text' => 'text',
        'url' => 'url',
        'icon' => 'icon',
        'alt' => 'alt',
        'tooltip' => 'tooltip',
        'id_parent' => 'id_parent',
        'task' => 'task',
        'position' => 'position',
        'options' => false
    );
    private $_fields_nestedSet = array(
        'id' => 'id',
        'text' => 'text',
        'url' => 'url',
        'icon' => 'icon',
        'alt' => 'alt',
        'tooltip' => 'tooltip',
        'task' => 'task',
        'lft' => 'lft',
        'rgt' => 'rgt',
        'options' => false,
    );
    private $_url = array();
    //public properties for the widget
    public $assets;
    public $boldCurrent = true;
    public $conditions = array('1=1');
    public $fields;
    public $hierModel;
    public $table;
    public $template = "{icon} {text}";
    public $encode = true;
    public $selectedStyle = "font-weight:bold";
    /**
     * @see CHtml::ajaxOptions()
     */
    public $ajaxOptions=false;
    private static $_createUrl_ = true;
    private static $_ajax_;
    //static properties for AJAX
    public static $_assetsPath_;
    public static $_boldCurrent_ = true;
    public static $_template_ = "{icon} {text}";
    public static $_encode_ = true;
    public static $_selectedStyle_ = "font-weight:bold";

    /**
     * Initializes the widget.
     * This method registers all needed client scripts and renders
     * the tree view content.
     */
    public function init() {
        if (isset($this->htmlOptions ['id']))
            $id = $this->htmlOptions ['id'];
        else
            $id=$this->htmlOptions ['id'] = $this->getId();
        if ($this->url !== null)
            $this->url = CHtml::normalizeUrl($this->url);
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('treeview');
        $options = $this->getClientOptions();
        $options = $options === array() ? '{}' : CJavaScript::encode($options);
        $cs->registerScript('Yii.CTreeView#' . $id, "jQuery(\"#{$id}\").treeview($options);");
        if ($this->cssFile === null)
            $cs->registerCssFile($cs->getCoreScriptUrl() . '/treeview/jquery.treeview.css');
        else if ($this->cssFile !== false)
            $cs->registerCssFile($this->cssFile);
        echo CHtml::tag('ul', $this->htmlOptions, false, false) . "\n";

        if (!isset($this->assets))
            $this->assets = dirname(__FILE__) . '/' . 'assets';
        if ($this->_fields_adjacency['icon'] || $this->_fields_nestedSet['icon'])
            self::$_assetsPath_ = Yii::app()->getAssetManager()->publish($this->assets);
        self::$_template_ = $this->template;
        self::$_boldCurrent_ = $this->boldCurrent;
        self::$_encode_ = $this->encode;
        self::$_selectedStyle_ = $this->selectedStyle;
        self::$_ajax_ = $this->ajaxOptions;
        echo $this->getData();
        //reset the static properties for the next tree
        self::$_assetsPath_;
        self::$_boldCurrent_ = true;
        self::$_template_ = "{icon} {text}";
        self::$_encode_ = true;
        self::$_createUrl_ = true;
        self::$_selectedStyle_ = "font-weight:bold";
        self::$_ajax_ = false;
    }

    public function getData() {
        if (!isset($this->_tree)) {
            $refs = array();
            $list = array();

            $this->queryTable();
        }
        echo self::saveDataAsHtml($this->_tree);
    }

    private function queryTable() {
        $fields = $this->getFields();
        $conditions = $this->getConditions();
        switch ($this->hierModel) {
            case 'adjacency':
                $this->_menus = Yii::app()->db->createCommand()
                        ->select($fields)
                        ->from($this->table)
                        ->where($conditions[0], $conditions[1])
                        ->order($this->_fields_adjacency['position'])
                        ->queryAll();
                $this->_tree = $this->getAdjacentTree($this->_menus);
                break;
            case 'nestedSet':
                $this->_menus = Yii::app()->db->createCommand()
                        ->select($fields)
                        ->from($this->table . ' AS t1,' . $this->table . ' AS t2')
                        ->where($conditions[0], $conditions[1])
                        ->group('t1.' . $this->fields['text'])
                        ->order('t1.' . $this->_fields_nestedSet['lft'])
                        ->queryAll();
                $this->_tree = $this->getNestedTree($this->_menus);
                break;
        }
    }

    private function getFields() {
        $fields = array();
        if (!empty($this->fields)) {
            switch ($this->hierModel) {
                case 'adjacency':
                    $_fields = $this->_fields_adjacency;
                    foreach ($_fields as $field => $val) {
                        if (isset($this->fields[$field])) {
                            $this->_fields_adjacency[$field] = $this->fields[$field];
                            if ($field == 'position')
                                continue;
                            if (is_bool($this->fields[$field])) {
                                if ($this->fields[$field])
                                    $fields[] = $field;
                            }
                            elseif (is_string($this->fields[$field]))
                                $fields[] = $this->fields[$field] . ' AS ' . $field;
                            elseif (is_array($this->fields[$field]) && $field == 'url')
                                $fields[$field] = $this->fields[$field];
                        }
                        elseif ($val) {
                            if ($field == 'position')
                                continue;
                            $fields[] = $field;
                        }
                    }
                    break;
                case 'nestedSet':
                    $_fields = $this->_fields_nestedSet;
                    foreach ($_fields as $field => $val) {
                        if (isset($this->fields[$field])) {
                            $this->_fields_nestedSet[$field] = $this->fields[$field];
                            if ($field == 'position')
                                continue;
                            if (is_bool($this->fields[$field])) {
                                if ($this->fields[$field])
                                    $fields[] = '`t1`.`' . $field . '`';
                            }
                            elseif (is_string($this->fields[$field]))
                                $fields[] = 't1.' . $this->fields[$field] . ' AS ' . $field;
                            elseif (is_array($this->fields[$field]) && $field == 'url')
                                $fields[$field] = $this->fields[$field];
                        }
                        elseif ($val) {
                            if ($field == 'position')
                                continue;
                            $fields[] = '`t1`.`' . $field . '`';
                        }
                    }
                    $text = isset($this->fields['text']) ? $this->fields['text'] : $this->_fields_nestedSet['text'];
                    $fields['depth'] = '(COUNT( `t2`.`' . $text . '` ) -1) AS `depth`';
                    break;
            }
        }
        else {
            switch ($this->hierModel) {
                case 'adjacency':
                    $fields = $this->_fields_adjacency;
                    break;
                case 'nestedSet':
                    $fields = $this->_fields_nestedSet;
                    $fields['depth'] = '(COUNT( t2.' . $text . ' ) -1) AS depth';
                    break;
            }
        }
        $fields = $this->processFields($fields, $this->hierModel);
        return implode(', ', $fields);
    }

    private function getAdjacentTree($menu) {
        foreach ($menu as $data) {
            if ($this->_fields_adjacency['task'])
                if (isset($data ['task']))
                    if (!Yii::app()->user->checkAccess($data ['task']))
                        continue;
            $thisref = &$refs [$data ['id']];
            $thisref ['id'] = $data ['id'];
            $thisref ['text'] = $this->formatTreeLinks($data ['text'], $this->processURL($this->_fields_adjacency, $data), $this->_fields_adjacency['icon'] ? $data ['icon'] : NULL, $this->_fields_adjacency['tooltip'] ? $data ['tooltip'] : NULL, $this->_fields_adjacency['alt'] ? $data['alt'] : '', $this->_fields_adjacency['options'] ? json_decode($data ['options'], true) : array());

            if ($data ['id_parent'] == 0) {
                $list [$data ['id']] = &$thisref;
            } else {
                $refs [$data ['id_parent']] ['children'] [$data ['id']] = &$thisref;
            }
        }
        return $list;
    }

    private function getNestedTree($menu) {
        // Trees mapped
        $list = array();
        $l = 0;

        if (count($menu) > 0) {
            // Node Stack. Used to help building the hierarchy
            $stack = array();
            foreach ($menu as $node) {
                $data = $node;
                $data['children'] = array();
                $data['text'] = $this->formatTreeLinks($data ['text'], $this->processURL($this->_fields_nestedSet, $data), $this->_fields_nestedSet['icon'] ? $data ['icon'] : NULL, $this->_fields_nestedSet['tooltip'] ? $data ['tooltip'] : NULL, $this->_fields_nestedSet['alt'] ? $data['alt'] : '', $this->_fields_nestedSet['options'] ? json_decode($data ['options'], true) : array());

                // Number of stack items
                $l = count($stack);

                // Check if we're dealing with different levels
                while ($l > 0 && $stack[$l - 1]['depth'] >= $data['depth']) {
                    array_pop($stack);
                    $l--;
                }

                // Stack is empty (we are inspecting the root)
                if ($l == 0) {
                    // Assigning the root node
                    $i = count($list);
                    $list[$i] = $data;
                    $stack[] = & $list[$i];
                } else {
                    // Add node to parent
                    $i = count($stack[$l - 1]['children']);
                    $stack[$l - 1]['children'][$i] = $data;
                    $stack[] = & $stack[$l - 1]['children'][$i];
                }
            }
        }
        return $list;
    }

    private function processURL($fields, $data) {
        if ($fields['url']) {
            if (isset($data['url']))
                return $data['url'];
            elseif (!empty($this->_url)) {
                $arrTemp = array();
                foreach ($this->_url[1] AS $id => $var) {
                    foreach ($var as $field => $val) {
                        $arrTemp[$field] = $data[$val];
                    }
                }
                self::$_createUrl_ = false;
                $arrOptions = isset($data['options']) ? $data['options'] : array();
                return Yii::app()->createUrl($this->_url[0], $arrTemp, $arrOptions);
            }
        }
        else
            return '';
    }

    private function processFields($fields, $hierarchy) {
        switch ($this->hierModel) {
            case 'nestedSet':
                $hierModel = $this->_fields_nestedSet;
                break;
            case 'adjacency':
                $hierModel = $this->_fields_adjacency;
                break;
        }
        if (isset($hierModel['url'])) {
            if (isset($fields['url'])) {
                if (is_array($fields['url'])) {
                    $this->_url[] = $fields['url'][0];
                    unset($fields['url'][0]);
                    $this->_url[] = $fields['url'];
                    foreach ($fields['url'][1] AS $key => $val) {
                        if (!isset($fields[$val]))
                            $fields[] = ($hierarchy == 'nestedSet') ? 't1.' . $val : $val;
                    }
                    unset($fields['url']);
                }
            }
        }
        return $fields;
    }

    private function getConditions() {
        $conditions = array();
        if ($this->hierModel == 'adjacency')
            $conditions[] = $this->conditions[0];
        else
            $conditions[] = $this->conditions[0] . ' AND (t1.' . $this->_fields_nestedSet['lft'] .
                    ' BETWEEN t2.' . $this->_fields_nestedSet['lft'] . ' AND t2.' .
                    $this->_fields_nestedSet['rgt'] . ')';
        if (isset($this->conditions[1])) {
            $conditions[] = $this->conditions[1];
        }
        else
            $conditions[] = array();
        return $conditions;
    }

    public static function formatTreeLinks($text, $url='', $icon=NULL, $tooltip=NULL, $alt='', $nodeOptions=array()) {
        $style = '';
        $img = "";
        if ($icon)
            $img = CHtml::image(self::$_assetsPath_ . '/' . $icon, $alt);
        $tmpOptions = $nodeOptions;
        if (strlen($url) && self::$_boldCurrent_)
            if (self::sameUrl($url))
                $style = self::$_selectedStyle_;
        if(!empty($tmpOptions)){
            if(isset($tmpOptions['style']))
                $style = $tmpOptions['style'].';'.$style;
            unset($tmpOptions['style']);
        }
        $htmlOptions = array('title' => $tooltip, 'style' => $style);
        if(!empty($tmpOptions)){
            $htmlOptions = array_merge($htmlOptions,$tmpOptions);
        }
        
        $text = (self::$_encode_) ? CHtml::encode($text) : $text;
        $title = str_replace('{icon}', $img, self::$_template_);
        $title = str_replace('{text}', $text, $title);
        $url = self::$_createUrl_ ? (strlen($url) > 0 ? Yii::app()->createUrl($url) : $url)  : $url;
        $label = strlen($url) == 0 ? $title : (self::$_ajax_ ? CHtml::ajaxLink($title,$url,self::$_ajax_,$nodeOptions) : CHtml::link($title, $url, $nodeOptions));
        return CHtml::tag('span', $htmlOptions, $label);
    }

    private static function sameUrl($url) {
        if (Yii::app()->request->requestUri == CHtml::normalizeUrl(array($url)))
            return true;
        return false;
    }

    /**
     * Saves tree view data in JSON format.
     * This method is typically used in dynamic tree view loading
     * when the server code needs to send to the client the dynamic
     * tree view data.
     * @param array $data the data for the tree view (see {@link data} for possible data structure).
     * @return string the JSON representation of the data
     */
    public static function saveDataAsJson($data) {
        $arrData = array();
        foreach ($data AS $key) {
            $url = isset($key['url']) ? $key['url'] : '';
            $icon = (isset($key['icon']) && isset(self::$_assetsPath_)) ? $key['icon'] : NULL;
            $tooltip = isset($key['tooltip']) ? $key['tooltip'] : NULL;
            $alt = isset($key['alt']) ? $key['alt'] : '';
            $nodeOptions = isset($key['options']) ? json_decode($key['options'], true) : array();

            $key['text'] = self::formatTreeLinks($key['text'], $url, $icon, $tooltip, $alt, $nodeOptions);
            $arrData[] = $key;
        }

        if (empty($arrData))
            return '[]';
        else
            return CJavaScript::jsonEncode($arrData);
    }
}
