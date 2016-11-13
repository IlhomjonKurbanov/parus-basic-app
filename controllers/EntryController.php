<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Entry controller
 */
class EntryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays category with post view.
     *
     * @return mixed
     */
    public function actionIndex($id)
    {
        $category = $id ? get_category_by('id', $id, ['with' => 'post_count']) : get_root_category();
        
        if (null === $category) {
            throw new NotFoundHttpException(Yii::t('app', 'Category does not exist.'));
        }
        
        $searchModel = new \app\models\search\PostSearch();
        $dataProvider = $searchModel->search($category, Yii::$app->request->queryParams);
        
        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays single entry view.
     *
     * @return mixed
     */
    public function actionPost($id)
    {
        if (null === $entry = get_post_by('id', $id, ['with' => 'category'])) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
        
        update_post_counter($entry->id);

        return $this->render('entry', [
            'entry' => $entry
        ]);
    }
}
