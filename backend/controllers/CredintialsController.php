<?php

namespace backend\controllers;

use Yii;
use backend\models\Credintials;
use backend\models\CredintialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Customer;
use backend\models\Partner;
/**
 * CredintialsController implements the CRUD actions for Credintials model.
 */
class CredintialsController extends Controller
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
     * Lists all Credintials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CredintialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Credintials model.
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
     * Creates a new Credintials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Credintials();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Credintials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Credintials model.
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
     * Finds the Credintials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Credintials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Credintials::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLogin(){
        $model = new Credintials();
        $err1 = 'Incorrect Username or Password';
        if(!isset(Yii::$app->session['UserId']))
        {
            if($model->load(Yii::$app->request->post())){
                    $query = Credintials::findOne(['username'=>$model->username,'password'=>$model->password]);
                    if($query != NULL)
                    {
                        Yii::$app->session['username'] = $query->username;
                        switch($query->role){
                            case 10 :
                                     Yii::$app->session['role'] = $query->role;
                                      Yii::$app->session['customer'] = $query->foreign_id;
                                      Yii::$app->session['UserId'] = $query->id;
                                      $modelUser = Customer::findOne(['id'=>$query->foreign_id]);
                                      return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/filter'
                                        );
                                      break;
                            case 20 : 
                                     Yii::$app->session['role'] = $query->role;
                                      Yii::$app->session['partner'] = $query->foreign_id;
                                      Yii::$app->session['UserId'] = $query->id;
                                      $modelUser = Partner::findOne(['id'=>$query->foreign_id]);
                                      return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/view');                          
                                      break;
                            case 30 :
                                     Yii::$app->session['role'] = $query->role;
                                      Yii::$app->session['admin'] = $query->foreign_id;
                                      Yii::$app->session['UserId'] = $query->id;
                                      return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/customer');                          
                                      break;
                                        }
                    }else{
                        return $this->render('login',[
                            'model'=>$model,
                            'err1' => $err1
                        ]);
                    }
                }else{
                    return $this->render('login',[
                        'model'=>$model,
                        ]);
                }
            }else{
                switch(intval(Yii::$app->session['role'])){
                        case 10 :
                                  return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/filter'
                                    );
                                  break;
                        case 20 : 
                                  return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/view');                          
                                  break;
                        case 30 : 
                                  return $this->redirect('http://localhost/advaced/backend/web/index.php?r=site/customer');                          
                                  break;
                }
            }
    }
    public function actionLogout(){
        Yii::$app->session->remove('role');
        Yii::$app->session->remove('admin');
        Yii::$app->session->remove('partner');
        Yii::$app->session->remove('customer');
        Yii::$app->session->remove('UserId');
        return $this->redirect('http://localhost/advaced/backend/web/index.php?r=credintials/login');
    }

}
