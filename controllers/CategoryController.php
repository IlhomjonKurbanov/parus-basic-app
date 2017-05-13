<?php

namespace app\controllers;

use app\models\search\PostSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Entry controller
 */
class CategoryController extends Controller
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
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionShow($id)
    {
        $category = $id ? get_category_by('id', $id) : get_root_category();
        
        if (null === $category) {
            throw new NotFoundHttpException(Yii::t('app', 'Category does not exist.'));
        }
        
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($category, Yii::$app->request->queryParams);
        
        return $this->render('show', [
            'category' => $category,
            'dataProvider' => $dataProvider
        ]);
    }
}
