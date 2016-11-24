<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * RunController
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class RunController extends Controller
{
    public $defaultAction = 'init';

    public function actionInit()
    {
        if ($this->confirm("\nDo you want to apply Migrations?")) {
            Yii::$app->runAction('run/migrate');
        }

        if ($this->confirm("\nDo you want to install Role Based Access Control (RBAC)?")) {
            Yii::$app->runAction('run/rbac-install');
        }

        if ($this->confirm("\nDo you want to install sample data?")) {
            Yii::$app->runAction('run/sample-data-install');
        }
        
        $this->stdout("\nApplication configuration successfully completed.\n", Console::FG_GREEN);
        
        self::EXIT_CODE_NORMAL;
    }
    
    public function actionMigrate()
    {
        $this->stdout("\nStart applying Migrations ...\n", Console::FG_YELLOW);
        Yii::$app->runAction('migrate/up', ['migrationPath' => '@rokorolov/parus/admin/migrations']);
    }
    
    public function actionRbacInstall()
    {
        if (!Yii::$container->has('rokorolov\parus\admin\contracts\RbacServiceInterface')) {
            Yii::$container->set('rokorolov\parus\admin\contracts\RbacServiceInterface', 'rokorolov\parus\admin\rbac\RbacService');
        }
        
        $this->stdout("\nStart RBAC Installation ...\n", Console::FG_YELLOW);
        Yii::createObject('rokorolov\parus\admin\contracts\RbacServiceInterface')->init();
        $this->stdout("\nRBAC successfully installed.\n", Console::FG_GREEN);
    }
    
    public function actionSampleDataInstall()
    {
        $this->stdout("\nStart Sample data Installation ...\n", Console::FG_YELLOW);
        Yii::createObject('rokorolov\parus\admin\helpers\SampleDataInstall')->init();
        $this->stdout("\nSample data successfully installed.\n", Console::FG_GREEN);
    }
    
    public function actionPostSampleDataInstall()
    {
        $this->stdout("\nStart Sample data Installation ...\n", Console::FG_YELLOW);
        Yii::createObject('rokorolov\parus\admin\helpers\SampleDataInstall')->installPostSampleData();
        $this->stdout("\nSample data successfully installed.\n", Console::FG_GREEN);
    }
    
    public function actionMigrateDown($limit = 1)
    {
        if ($this->confirm("\nAre you sure you want to revert migrations?")) {
            $this->stdout("\nStart reverting migrations ...\n", Console::FG_YELLOW);
            Yii::$app->runAction('migrate/down', [$limit, 'migrationPath' => '@rokorolov/parus/admin/migrations']);
        }
    }
        
    public function actionRbacRemove()
    {
        if ($this->confirm("\nAre you sure you want to remove RBAC?")) {
            Yii::$app->authManager->removeAll();
            $this->stdout("\nRemoved RBAC successfully.\n", Console::FG_GREEN);
        }
    }
        
    public function actionCacheFlush()
    {
        Yii::$app->cache->flush();
        $this->stdout("\nYou've successfully cleared Cache.\n", Console::FG_GREEN);
    }
}
