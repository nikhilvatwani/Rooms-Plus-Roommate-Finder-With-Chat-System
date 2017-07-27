<?php

namespace backend\controllers;

use Yii;
use backend\models\Partner;
use backend\models\PartnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Rooms;
use yii\helpers\Json;
use backend\models\State;
use backend\models\Area;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use backend\models\Credintials;
/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partner();
        $modelRooms = new Rooms();
        $modelUpload = new UploadForm();
        $modelCredintials = new Credintials();
        if ($model->load(Yii::$app->request->post()) && $modelRooms->load(Yii::$app->request->post())&&Yii::$app->request->isPost) {
            $modelUpload->imageFiles = UploadedFile::getInstances($modelUpload, 'imageFiles');
                       // var_dump($modelUpload->imageFiles);
            //die();
            $modelUpload->upload($modelRooms->building_name,$modelRooms->flat_no);
            $modelRooms->images = '../uploads/'.$modelRooms->flat_no.')'.$modelRooms->building_name;
            $modelRooms->save();
            //var_dump($modelRooms->id);
            //die();
            $model->room_id = $modelRooms->id;
            $modelCredintials->username = $model->email;
            $modelCredintials->password = $model->password;
            $model->save();
            $modelCredintials->role = 20;
            $modelCredintials->foreign_id = $model->id;
            $modelCredintials->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelRooms'=>$modelRooms,
                'modelUpload'=>$modelUpload,
            ]);
        }
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRooms = $this->findModelRooms($model->room_id);
        $images = $modelRooms->images;
        if ($model->load(Yii::$app->request->post()) && $modelRooms->load(Yii::$app->request->post())&&Yii::$app->request->isPost) {
            $password = Credintials::findOne(['foreign_id'=>$id]);
            $password = $password->password;
            $model->password = $password;
            $modelRooms->images = $images;
            $modelRooms->save();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelRooms' =>$modelRooms,
            ]);
        }
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelRooms($id)
    {
        if (($model = Rooms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

        // THE CONTROLLER
    public function actionSubcat() {
    $out = [];
    //var_dump(Yii::$app->request->post('depdrop_parents'));
    //die();
        //echo "hello";
    if (Yii::$app->request->post('depdrop_parents')) {
        $parents = Yii::$app->request->post('depdrop_parents');
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = State::getState($cat_id); 
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
            echo Json::encode(['output'=>$out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}
 
public function actionProd() {
    $out = [];
    //echo "hi";
    if (Yii::$app->request->post('depdrop_parents')) {
        //echo "inside";

        $ids = Yii::$app->request->post('depdrop_parents');
        $cat_id = empty($ids[0]) ? null : $ids[0];
        $subcat_id = empty($ids[1]) ? null : $ids[1];
        if ($cat_id != null) {
           $data = Area::getArea($subcat_id);
                           //var_dump($data);
       //die();
            /**
             * the getProdList function will query the database based on the
             * cat_id and sub_cat_id and return an array like below:
             *  [
             *      'out'=>[
             *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
             *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
             *       ],
             *       'selected'=>'<prod-id-1>'
             *  ]
             */
           
           echo Json::encode(['output'=>$data, 'selected'=>'']);
           return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}
}
