<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
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
use frontend\models\UpsModels;
use frontend\models\UpsmodelsSearch;
use frontend\models\Patches;
use frontend\models\PatchesSearch;
use frontend\models\Ports;
use frontend\models\PatchTypes;
use frontend\models\SwitchModels;
use frontend\models\SwitchmodelsSearch;
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
		$modelups = new UpsModels();
		$modelports = new Ports();
		$modelpptypes = new PatchTypes();
		$modelsw = new SwitchModels();
		
		$countpp = $this->Countpp();
		$countoc = $this->Countoc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			if ($model->device_type == 1) {
				
				$model1 = new Ups();
				
				$model1->device_id = $model->device_id;
				$model1->ups_model = $model->device_name;
				$model1->save();
				
				$modelups->load(Yii::$app->getRequest()->post());
				
				$modelnewups = new UpsModels();
				
				$modelnewups->manufacturer = $modelups->manufacturer;
				$modelnewups->model = $modelups->model;
				$modelnewups->save();
				
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
				
				$modelsw->load(Yii::$app->getRequest()->post());
				
				$modelnewsw = new SwitchModels();
				
				$modelnewsw->manufacturer = $modelsw->manufacturer;
				$modelnewsw->model = $modelsw->model;
				$modelnewsw->ports = $model->port;
				$modelnewsw->PoE = $modelsw->PoE;
				$modelnewsw->save();
				
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
				
				$modelpptypes->load(Yii::$app->getRequest()->post());
				
				$modelnewppt = new PatchTypes();
				
				$modelnewppt->type = $modelpptypes->type;
				$modelnewppt->save();
				
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
			'modelups' => $modelups,
			'countpp' => $countpp,
			'countoc' => $countoc,
			'modelports' => $modelports,
			'modelpptypes' => $modelpptypes,
			'modelsw' => $modelsw,
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
		} 
		if ($_GET['devicetype'] == 1) {
			$this->findModelUps($id)->delete();
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

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
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

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
	
	public function actionUpsModels($q = null) {
		$query = UpsModels::find();
		
		$query->select(["concat(upsman_name, ' ', model) as all"])
			->from(['ups_models', 'ups_manufacturers'])
			->where('concat(upsman_name, " ", model) LIKE "%'. $q .'%"')
			->andWhere('ups_models.manufacturer = ups_manufacturers.id_man')
			->orderBy('all');
			
		$command = $query->createCommand();
		$data = $command->QueryAll();
		$out = [];
		foreach ($data as $d) {
			$out[] = $d['all'];
		}
		echo Json::encode($out);
	}
	
	public function actionPpTypes($q = null) {
		$query = Patches::find();
		
		$query->select(["type"])
			->from(['patch_types'])
			->where('type LIKE "%'. $q .'%"')
			->orderBy('type');
			
		$command = $query->createCommand();
		$data = $command->QueryAll();
		$out = [];
		foreach ($data as $d) {
			$out[] = $d['type'];
		}
		echo Json::encode($out);
	}
	
	public function actionSwModels($q = null) {
		$q = preg_replace('/\"/', '\"', $q);
		
		$query = SwitchModels::find();
		
		$query->select(["concat(swman_name, ' \"', model, '\"') as all"])
			->from(['switch_models', 'switch_manufacturers'])
			->where('concat(swman_name, " \"", model, "\"") LIKE "%'. $q .'%"')
			->andWhere('switch_models.manufacturer = switch_manufacturers.id_swman')
			->orderBy('all');
			
		$command = $query->createCommand();
		$data = $command->QueryAll();
		$out = [];
		foreach ($data as $d) {
			$out[] = $d['all'];
		}
		echo Json::encode($out);
	}
	
	protected function Countpp() {
		$countpp = (new Query())
			->select(['COUNT(*)'])
			->from('devices')
			->where(['case_id' => $_SESSION['case']])
			->andWhere(['device_type' => 3])
			->all();
		$result = $countpp[0]['COUNT(*)'] + 1;
		return $result;
	}
	
	protected function Countoc() {
		$countoc = (new Query())
			->select(['COUNT(*)'])
			->from('devices')
			->where(['case_id' => $_SESSION['case']])
			->andWhere(['device_type' => 4])
			->all();
		$result = $countoc[0]['COUNT(*)'] + 1;
		return $result;
	}
	
	public function actionPorts($id) {
		//$id = json_decode($id);
		
		$ports = (new Query())
			->select('ports')
			->from('switch_models')
			->where(['model' => $id])
			->all();
		$result = $ports[0]['ports'];
		return $result;
	}
}
