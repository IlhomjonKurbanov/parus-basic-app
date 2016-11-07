<?php

namespace app\presenters;

use rokorolov\parus\admin\base\BasePresenter;
use Yii;

/**
 * PostPresenter
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PostPresenter extends BasePresenter
{
    const IMAGE_EXTENSION = 'jpg';
    
    public function published_at()
    {
        return Yii::$app->formatter->asDate($this->wrappedObject->published_at);
    }
    
    public function published_at_relative()
    {
        return Yii::$app->formatter->asRelativeTime($this->wrappedObject->published_at);
    }
    
    public function image_large_src()
    {
        return $this->full_image_src('large');
    }
    
    public function image_small_src()
    {
        return $this->full_image_src('small');
    }
    
    public function image_thumb_src()
    {
        return $this->full_image_src('thumb');
    }
    
    public function full_image_src($prefix = null)
    {
        if (!$this->existsImage()) {
            return null;
        }
        
        $prefix = $prefix ? '-' . $prefix : '';
        
        return Yii::getAlias('@web/uploads/post/' . $this->wrappedObject->id . '/' . $this->wrappedObject->image . $prefix . '.' . self::IMAGE_EXTENSION);
    }
    
    public function existsImage()
    {
        return !empty($this->wrappedObject->image);
    }
}
