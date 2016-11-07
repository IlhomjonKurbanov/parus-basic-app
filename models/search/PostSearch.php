<?php

namespace app\models\search;

use app\dto\PostListDto;
use rokorolov\parus\blog\models\Post;
use rokorolov\parus\blog\models\Category;
use rokorolov\parus\admin\theme\widgets\statusaction\helpers\Status;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * PostSearch represents the model behind the search form about `rokorolov\parus\blog\models\Post`.
 * 
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class PostSearch extends Model
{
    /**
     * 
     * @return type
     */
    public function attributeLabels()
    {
        return [];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($category, $params)
    {
        $catChildrenIds = array_merge(get_category_children_ids($category, null), [$category->id]);

        $query = (new Query)
            ->select('p.id, p.title, p.category_id, p.slug, p.introtext, p.image, p.published_at, p.hits, p.meta_title, p.meta_keywords, p.meta_description, c.title as category_title')
            ->from(Post::tableName() . ' p')
            ->andWhere(['and',
                ['in', 'p.category_id', $catChildrenIds],
                ['p.status' => Status::STATUS_PUBLISHED],
                ['p.deleted_at' => null]
            ])
            ->leftJoin(Category::tableName() . ' c', 'p.category_id = c.id');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['published_at' => SORT_DESC],
            'attributes' => [
                'published_at',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $this->transform($dataProvider);
        }
        
        return $this->transform($dataProvider);
    }
    
    protected function transform($dataProvider)
    {
        $keys = [];
        $models = [];
        foreach($dataProvider->getModels() as $key => $data) {
            $keys[$key] = $data['id'];
            $models[$key] = Yii::createObject('rokorolov\parus\blog\repositories\PostReadRepository')->applyPresenter($this->toDto($data));
        }
        $dataProvider->setKeys($keys);
        $dataProvider->setModels($models);
        
        return $dataProvider;
    }

    protected function toDto($data)
    {
        return new PostListDto($data);
    }
}
