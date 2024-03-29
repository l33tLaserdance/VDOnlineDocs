<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Objects;
use frontend\models\ObjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * ObjectsController implements the CRUD actions for Objects model.
 */
class ObjectsController extends Controller
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
     * Lists all Objects models.
     * @return mixed
     */
    public function actionIndex($id, $org_full_name, $search = '')
    {
        $searchModel = new ObjectsSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $org_id);
			$_SESSION['org_id'] = $id;
			$_SESSION['org_full_name'] = $org_full_name;
		/*if (isset($_SESSION['case_id'])) {	
			unset($_SESSION['case_id']);
			unset($_SESSION['obj_name']);
		}*/
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'search' => $search,
        ]);
    }

    /**
     * Displays a single Objects model.
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
     * Creates a new Objects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Objects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (UploadedFile::getInstance($model, 'file') != null) {
				$imageName = $model->obj_id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$_SESSION['org_id'].'/'.$model->obj_id, 0777);
				$model->file->saveAs('uploads/'.$_SESSION['org_id'].'/'.$model->obj_id.'/'.$imageName.'.'.$model->file->extension);
				
				$model->photo = '/uploads/'.$_SESSION['org_id'].'/'.$model->obj_id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
			}
			
            return $this->redirect(['view', 'id' => $model->obj_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Objects model.
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
				$imageName = $model->obj_id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$_SESSION['org_id'].'/'.$model->obj_id, 0777);
				$model->file->saveAs('uploads/'.$_SESSION['org_id'].'/'.$model->obj_id.'/'.$imageName.'.'.$model->file->extension);
				
				$model->photo = '/uploads/'.$_SESSION['org_id'].'/'.$model->obj_id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
			}
			
            return $this->redirect(['view', 'id' => $model->obj_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Objects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		//print_r($_SESSION);
        return $this->redirect(['index',
			'id' => $_SESSION['org_id'],
			'org_full_name' => $_SESSION['org_full_name'],
		]);
    }

    /**
     * Finds the Objects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Objects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	/*public function actionObjects($search = '', $id = '')
	{
		$obj = (new Query())
			->select(['address', 'obj_name', 'Comment'])
			->from(['objects'])
			->where(['org_id' => $id])
			->all();
		
		$dataProvider = new ArrayDataProvider([
            'allModels' => $obj,
            'sort'=> [
                'attributes' => ['address', 'obj_name', 'Comment'],
                'defaultOrder' => ['address' => SORT_DESC],
            ]
        ]);
		
		return $this->render('index', ['dataProvider' => $dataProvider, 'search' => $search]);
	}*/
}
