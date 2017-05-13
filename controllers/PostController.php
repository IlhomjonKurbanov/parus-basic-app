<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Post controller
 */
class PostController extends Controller
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
     * Displays single entry view.
     *
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionShow($id)
    {
        if (null === $entry = get_post_by('id', $id, ['with' => 'category'])) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested entry does not exist.'));
        }
        
        update_post_counter($entry->id);

        return $this->render('show', [
            'entry' => $entry
        ]);
    }
}
