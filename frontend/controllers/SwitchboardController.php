<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Switchboard;
use frontend\models\SwitchboardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * SwitchboardController implements the CRUD actions for Switchboard model.
 */
class SwitchboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Switchboard models.
     * @return mixed
     */
    public function actionIndex($search = '')
    {
		if (isset($_GET['switch_name'])) {
			$_SESSION['switch_id'] = $_GET['id'];
			$_SESSION['switch_name'] = $_GET['switch_name'];
			$_SESSION['name'] = $_GET['name'];
			$_SESSION['ip'] = $_GET['ip'];
		}
		
        $searchModel = new SwitchboardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = 24;
		
		$poe = (new Query())
			->select(['sw_poe'])
			->from(['devices'])
			->where(['device_id' => $_SESSION['switch_id']])
			->all();

		$cont = (new Query())
			->select(['sw_control'])
			->from(['devices'])
			->where(['device_id' => $_SESSION['switch_id']])
			->all();
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'search' => $search,
			'poe' => $poe[0]['sw_poe'],
			'control' => $cont[0]['sw_control'],
        ]);
    }

    /**
     * Displays a single Switchboard model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Switchboard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Switchboard();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->switch_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Switchboard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $_SESSION['switch_id']]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Switchboard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$deletion = Yii::$app->db->createCommand("
			DELETE FROM switchboard 
			WHERE device_id = '$id' 
		")->execute();
		
		$deletion2 = Yii::$app->db->createCommand("
			DELETE FROM devices
			WHERE device_id = '$id' 
		")->execute();
		
        return $this->redirect(['cases/view', 'id' => $_SESSION['case']]);
    }

    /**
     * Finds the Switchboard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Switchboard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Switchboard::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
