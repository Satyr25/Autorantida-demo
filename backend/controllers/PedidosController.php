<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Documentos;
use backend\models\Pedidos;
use backend\models\PedidosSoluciones;
/**
 * Site controller
 */
class PedidosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new Pedidos();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        $model = $this->findModel($id);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
////        
//        $searchModel = new PedidosSoluciones();
//        $dataProvider = $searchModel->search($id);
        $soluciones = PedidosSoluciones::find()->where(['pedidos_id' => $id])->all();
        $documentos = Documentos::find()->where(['pedidos_id' => $id])->all();
        
        return $this->render('view', [
            'model' => $model,
            'soluciones' => $soluciones,
            'documentos' => $documentos,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = Pedidos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página buscada no existe.');
    }

}
