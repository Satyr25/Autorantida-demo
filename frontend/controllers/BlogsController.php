<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Blogs;

class BlogsController extends Controller
{
    public function actionIndex(){
        
        if (Yii::$app->request->queryParams['tema']){
            $blogs = Blogs::find()
                ->where(['tema' => Yii::$app->request->queryParams['tema']])
                ->orderBy('created_at DESC')
                ->all();
        } else {
            $blogs = Blogs::find()->orderBy('created_at DESC')->all();
        }
        
        if (Yii::$app->request->queryParams['tema']){
            $reciente = Blogs::find()
                ->orderBy('created_at DESC')
                ->limit(1)
                ->where(['tema' => Yii::$app->request->queryParams['tema']])
                ->one();
        } else {
            $reciente = Blogs::find()->orderBy('created_at DESC')->limit(1)->one();
        }
        
        $temas = Blogs::find()->select('tema')->distinct()->all();
        
        return $this->render('index',[
            'temas' => $temas,
            'reciente' => $reciente,
            'blogs' => $blogs,
        ]);
    }
    
    public function actionVer(){
        if (Yii::$app->request->queryParams['id']){
            $blog = Blogs::find()
                ->where(['id' => Yii::$app->request->queryParams['id']])
                ->one();
        } else {
            Yii::$app->session->setFlash('error', 'No se encontró el blog solicitado');
            return $this->redirect('index');
        }
        return $this->render('ver', [
            'blog' => $blog
        ]);
    }
}
