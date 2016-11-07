<?php

namespace app\presenters;

use rokorolov\parus\admin\base\BasePresenter;
use rokorolov\helpers\Html;
use Yii;

/**
 * PhotoPresenter
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PhotoPresenter extends BasePresenter
{
    public function image_src()
    {
        return $this->full_image_src();
    }

    public function image_large_src()
    {
        return $this->full_image_src('large');
    }
    
    public function image_thumb_src()
    {
        return $this->full_image_src('thumb');
    }
    
    public function full_image_src($prefix = null)
    {
        $prefix = $prefix ? '-' . $prefix : '';
        
        return Yii::getAlias('@web/uploads/gallery/' . $this->wrappedObject->album_id . '/' . $this->wrappedObject->photo_name . $prefix . '.' . $this->wrappedObject->photo_extension);
    }
}
