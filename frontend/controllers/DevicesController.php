<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Devices;
use frontend\models\DevicesSearch;
use frontend\models\Ups;
use frontend\models\UpsSearch;
use frontend\models\Switchboard;
use frontend\models\SwitchboardSearch;
use frontend\models\PatchPanel;
use frontend\models\PatchpanelSearch;
use frontend\models\Optcross;
use frontend\models\OptcrossSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * DevicesController implements the CRUD actions for Devices model.
 */
class DevicesController extends Controller
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
     * Lists all Devices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DevicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Devices model.
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
     * Creates a new Devices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Devices();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			if ($model->device_type == 1) {
				
				$model1 = new Ups();
				
				$model1->device_id = $model->device_id;
				$model1->ups_model = $model->device_name;
				$model1->save();
				
				$ups = (new Query())
					->select(['ups_id'])
					->from(['ups'])
					->where(['device_id' => $model->device_id])
					->all();
				
				$model->device_link = '<a href="/ups/view?id='.$ups[0]['ups_id'].'&ups_name='.$model->device_name.'">Ссылка</a>';
				$model->save();
				
			}
			
			if ($model->device_type == 2) {
				
				$model2 = new Switchboard();
				
				$model2->device_id = $model->device_id;
				$model2->switch_model = $model->device_name;
				$model2->port = 1;
				$model2->save();
				
				$model->device_link = '<a href="/switchboard/index?id='.$model->device_id.'&switch_name='.$model->device_name.'&name='.$model->device_switchn.'&ip='.$model->device_ip.'.">Ссылка</a>';
				$model->save();
				
				if ($model->port > 1) {
					$i = 2;
					for($i = 2; $i <= $model->port; $i++) {
						$model2 = new Switchboard();
						
						$model2->device_id = $model->device_id;
						$model2->switch_model = $model->device_name;
						$model2->port = $i;
						$model2->save();
					}
						
				}
			}
			
			if ($model->device_type == 3) {
				
				$model3 = new PatchPanel();
				
				$model3->device_id = $model->device_id;
				$model3->patch_name = $model->device_name;
				$model3->ports = 1;
				$model3->save();
				
				$model->device_link = '<a href="/patchpanel/index?id='.$model->device_id.'&patch_name='.$model->device_name.'">Ссылка</a>';
				$model->save();
				
				if ($model->port > 1) {
					$i = 2;
					for($i = 2; $i <= $model->port; $i++) {
						$model3 = new PatchPanel();
						
						$model3->device_id = $model->device_id;
						$model3->patch_name = $model->device_name;
						$model3->ports = $i;
						$model3->save();
					}
						
				}
			}
			
			if ($model->device_type == 4) {
				
				$model4 = new Optcross();
				
				$model4->device_id = $model->device_id;
				$model4->optcross_name = $model->device_name;
				$model4->port = 1;
				$model4->save();
				
				$model->device_link = '<a href="/optcross/index?id='.$model->device_id.'&optcross='.$model->device_name.'">Ссылка</a>';
				$model->save();
				
				if ($model->port > 1) {
					$i = 2;
					for($i = 2; $i <= $model->port; $i++) {
						$model4 = new Optcross();
						
						$model4->device_id = $model->device_id;
						$model4->optcross_name = $model->device_name;
						$model4->port = $i;
						$model4->save();
					}
						
				}
			}
			
            return $this->redirect(['cases/view', 'id' => $_SESSION['case']]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Devices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cases/view', 'id' => $_SESSION['case']]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Devices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		if ($this->findModel($id)->device_link == null) {
			$this->findModel($id)->delete();
		} elseif ($_GET['devicetype'] == 1) {
			$this->findModelUps($id)->delete();
		} else {
			$this->findModel($id)->delete();
		}

        return $this->redirect(['cases/view',
			'id' => $_SESSION['case'],
		]);
    }

    /**
     * Finds the Devices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Devices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Devices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function findModelUps($id)
    {
		$ups = (new Query())
					->select(['ups_id'])
					->from(['ups'])
					->where(['device_id' => $id])
					->all();
		
        if (($model = Ups::findOne($ups)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
