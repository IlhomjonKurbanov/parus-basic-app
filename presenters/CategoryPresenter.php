<?php

namespace app\presenters;

use rokorolov\parus\admin\base\BasePresenter;

/**
 * CategoryPresenter
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class CategoryPresenter extends BasePresenter
{
    const DEFAULT_CAT_TYPE = 'cat-0';
    
    public function post_count()
    {
        return $this->wrappedObject->post_count ?: 0;
    }
    
    public function cat_type()
    {
        $types = $this->cat_type_options();
        return isset($types[$this->wrappedObject->id]) ? $types[$this->wrappedObject->id] : self::DEFAULT_CAT_TYPE;
    }
    
    public function cat_type_options()
    {
        return [
            '3' => 'cat-3',
            '4' => 'cat-4',
            '5' => 'cat-5',
        ];
    }
}
