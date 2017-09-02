<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Class RbacRolesController
 * @package app\commands
 */
class RbacRolesController extends Controller
{
    public function actionInit()
    {
        $roles = Yii::$app->params['roles'];

        $auth = Yii::$app->authManager;

        $admin = $auth->createRole($roles['admin']);
        $auth->add($admin);

        $auth->assign($admin, 1);
    }
}