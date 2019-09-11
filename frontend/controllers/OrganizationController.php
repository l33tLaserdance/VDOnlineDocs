<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Organization;
use frontend\models\OrgnizationSearch;
use frontend\models\Contacts;
use frontend\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\grid\EditableColumnAction;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends Controller
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

	public function actions()
   {
	   //$id = $_GET['id'];
       return ArrayHelper::merge(parent::actions(), [
           'editfio' => [                                       // identifier for your editable action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => Contacts::className(),                // the update model class
               'outputValue' => function ($model, $attribute, $key, $index) {
                    $fmt = Yii::$app->formatter;
                    $value = $model->$attribute;                 // your attribute value
                    if ($attribute === 'FIO') {           // selective validation by attribute
                        return $fmt->asText($value);       // return formatted value if desired
                    } elseif ($attribute === 'Phone') {
						return $fmt->asText($value);
					} elseif ($attribute === 'Email') {
						return $fmt->asText($value);
					} elseif ($attribute === 'Positon') {
						return $fmt->asText($value);
					}
                    return '';                                   // empty is same as $value
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                     return '';                                  // any custom error after model save
               },
                /*'showModelErrors' => true,                     // show model errors after save
                'errorOptions' => ['header' => ''],             // error summary HTML options
                'postOnly' => true,
                'ajaxOnly' => true,
                'findModel' => function($id, $action) {},
                'checkAccess' => function($action, $model) {}*/
           ]
       ]);
   }
    /**
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex($search = '')
    {
        $searchModel = new OrgnizationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'search' => $search,
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		//$response = Organization::findOne($id);
		
		/*$responsibles = Organization::find()->with('resp_FIO')->all();
		foreach ($responsibles as $resp) {
			$resp->resp_FIO;
		}
		print_r($resp);*/
		
		/*$cont = (new Query())
			->select(['FIO', 'Phone', 'Email', 'Positon'])
			->from(['Contacts'])
			->where(['org_id' => $id])
			->all();
		
		$dataProvider = new ArrayDataProvider([
            'allModels' => $cont,
            'sort'=> [
                'attributes' => ['FIO', 'Phone', 'Email', 'Positon'],
                'defaultOrder' => ['FIO' => SORT_ASC],
            ]
        ]);*/
		
		$resp = (new Query())
			->select(['resp_FIO', 'resp_phone', 'resp_email'])
			->from(['responsible r', 'resp_org ro'])
			->where('r.resp_id=ro.resp_id')
			->andWhere('org_id='.$id)
			->all();
		
		$dataProvider2 = new ArrayDataProvider([
            'allModels' => $resp,
            'sort'=> [
                'attributes' => ['resp_FIO', 'resp_phone', 'resp_email'],
                'defaultOrder' => ['resp_FIO' => SORT_ASC],
            ]
        ]);
		
        return $this->render('view', [
			'model' => $this->findModel($id),
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Organization();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (UploadedFile::getInstance($model, 'file') != null) {	
				$imageName = $model->id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$model->id.'/', 0777);
				$model->file->saveAs('uploads/'.$model->id.'/'.$imageName.'.'.$model->file->extension);
				
				$model->photo = '/uploads/'.$model->id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
				Yii::$app->session->setFlash('success', 'Организация "'.$model->org_full_name.'" успешно создана.');
			}
			
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Organization model.
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
				$imageName = $model->id;
				$model->file = UploadedFile::getInstance($model, 'file');
				FileHelper::createDirectory('uploads/'.$model->id.'/', 0777);
				$model->file->saveAs('uploads/'.$model->id.'/'.$imageName.'.'.$model->file->extension);
				
				$model->photo = '/uploads/'.$model->id.'/'.$imageName.'.'.$model->file->extension;
				$model->save();
			}
			
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
	
	protected function findModel2($id)
    {
        if (($model2 = Contacts::findOne($id)) !== null) {
            return $model2;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}
