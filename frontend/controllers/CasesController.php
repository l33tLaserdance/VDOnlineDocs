<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cases;
use frontend\models\CasesSearch;
use frontend\models\Devices;
use frontend\models\DevicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * CasesController implements the CRUD actions for Cases model.
 */
class CasesController extends Controller
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
     * Lists all Cases models.
     * @return mixed
     */
    public function actionIndex($id, $obj_name, $search = '')
    {
        $searchModel = new CasesSearch();
		
			$_SESSION['obj_id'] = $id;
			$_SESSION['obj_name'] = $obj_name;
			
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = 40;
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'search' => $search,
        ]);
    }

    /**
     * Displays a single Cases model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $search = '')
    {
		$_SESSION['case'] = $id;
		if (isset($_GET['altcase'])) {
			$_SESSION['altcase'] = $_GET['altcase'];
		}
		
		$searchModel = new DevicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		if (isset($_GET['case_num'])) {
			$_SESSION['case_num'] = $_GET['case_num'];
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'search' => $search,
        ]);
    }

    /**
     * Creates a new Cases model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Cases();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (UploadedFile::getInstance($model, 'file') != null) {
				$imageName = $model->case_id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/', 0777);
				$model->file->saveAs('uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/'.$imageName.'.'.$model->file->extension);
				
				$model->photo = '/uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
			}
			
            return $this->redirect(['view', 'id' => $model->case_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cases model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (UploadedFile::getInstance($model, 'file') != null) {
				$imageName = $model->case_id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/', 0777);
				$model->file->saveAs('uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/'.$imageName.'.'.$model->file->extension);
			
				$model->photo = '/uploads/'.$_SESSION['org_id'].'/'.$_SESSION['obj_id'].'/'.$model->case_id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
			}
			
            return $this->redirect(['view', 'id' => $model->case_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cases model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index',
			'id' => $_SESSION['obj_id'],
			'org_full_name' => $_SESSION['obj_name'],
		]);
    }

    /**
     * Finds the Cases model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cases the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cases::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
