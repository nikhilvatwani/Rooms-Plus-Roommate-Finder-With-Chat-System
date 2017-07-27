<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Rooms;
use backend\models\Country;
use backend\models\State;
use backend\models\Area;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use backend\models\Customer;
use backend\models\Credintials;
use backend\models\Chat;
use backend\models\Message;
use backend\models\Partner;
use backend\models\Queries;
/**
 * Site controller
 */
class SiteController extends Controller
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
      public function actionFilter()
    {
        $info = Rooms::find()->asArray()->all();
        $info = $this->processData($info);
        return $this->render('filter',['info'=>$info]);
    }

    public function actionPartnerHome()
    {
        return $this->render('partner');
    }
    public function actionAdminHome()
    {
        return $this->render('admin-home');
    }
    public function processData($data){//For action INTERESTED
        foreach ($data as $key => $value) {
            //var_dump($value['country']);
            //die();
            $country = Country::findOne(['id'=>$value['country']]);
            $state = State::findOne(['id'=>$value['state']]);
            $area = Area::findOne(['id'=>$value['area']]);
            $data[$key]['country'] = $country->name;
            $data[$key]['state'] = $state->name;
            $data[$key]['area'] = $area->name;
            $images= null;
            $i=0;
            if (is_dir($value['images'])){
                  if ($dh = opendir($value['images'])){
                    while (($file = readdir($dh)) !== false){
                        if($file!='.'&&$file!='..'&&$file!='Thumbs.db')
                        {    $images = $file;
                             break;
                        }
                    }
                    closedir($dh);
                  }
                }
            $data[$key]['images'] = $value['images'].'/'.$images;
                //var_dump($data);
            //var_dump($country->name);
        }
        return $data;
    }

    public function actionHint($q){
        $type = NULL;
        $occupation = NULL;
        $no_of_rooms = NULL;
        $gender = NULL;
        $minrent = 0;
        $maxrent = NULL;
        $minage =0;
        $maxage = NULL;
        $country = NULL;
        $state = NULL;
        $area = NULL;
        $temp = json_decode($q);
       // $i = count($temp);
        $query = (new \yii\db\Query());
        foreach ($temp as $key => $value) {
            if(isset($temp->type)&&$type ==NULL){
                     $type = $temp->type;

            }
            elseif (isset($temp->no_of_rooms)&&$no_of_rooms ==NULL){      
                 $no_of_rooms = $temp->no_of_rooms;
             }
             elseif (isset($temp->occupation)&&$occupation ==NULL){     
                 $occupation = $temp->occupation;
             }
             elseif (isset($temp->gender)&&$gender ==NULL){       
                 $gender = $temp->gender;
             }elseif (isset($temp->minrent)&&$minrent ==NULL){      
                 $minrent = $temp->minrent;
             }elseif (isset($temp->maxrent)&&$maxrent ==NULL){      
                 $maxrent = $temp->maxrent;
             }elseif (isset($temp->minage)&&$minage ==NULL){      
                 $minage = $temp->minage;
                ;
             }elseif (isset($temp->maxage)&&$maxage ==NULL){      
                 $maxage = $temp->maxage;
                 
             }elseif (isset($temp->country)&&$country ==NULL){      
                 $country = $temp->country;
                 
             }elseif (isset($temp->state)&&$state ==NULL){      
                 $state = $temp->state;
                 
             }elseif (isset($temp->area)&&$area ==NULL){      
                 $area = $temp->area;
                 
             }
        }
        
        $data = Rooms::find()->filterWhere(['type' => $type,
                                            'no_of_rooms' => $no_of_rooms,
                                            'country' => $country,
                                            'state' => $state,
                                            'area' => $area,
                                                ])->andFilterWhere(['>=', 'rent', $minrent])->andFilterWhere(['<=', 'rent', $maxrent])->asArray()->all();

        if(isset($gender)||isset($occupation)||isset($minage)||isset($maxage)){
            foreach ($data as $key => $value) {
                $flag =0;
                if($value['interested'] != NULL){
                    $interest = explode(',', $value['interested']);
                    foreach ($interest as $k => $v) {
                       if($v!=Yii::$app->session['customer']){$model = Customer::find()->filterWhere(['id'=>$v,'gender'=>$gender,'occupation'=>$occupation])->andFilterWhere(['>=', 'age', $minage])->andFilterWhere(['<=', 'age', $maxage])->asArray()->one();}  
                        if(isset($model)){
                            //var_dump($model->id.'----'.$model->gender.'----');
                            $flag = 1;
                        }
                    }
                    //var_dump($flag);
                    //die();
                    if($flag == 0){
                        unset($data[$key]);
                    }
                }else{
                    unset($data[$key]);
                }
            }
                            //die();
        }
        //var_dump($data);
        //die();
        $data = $this->processData($data);
        /*
        $i=0;
        foreach ($data as $key => $value) {
            var_dump($key);
        }
       //var_dump($data);
        die();
        */
        return json_encode($data);
    }
    public function actionSlider($room_id){
        $model = $this->findModel($room_id);
        return $this->render('slider', [
                'model' => $model,
            ]);
    }

    public function findModel($id){
        $model = Rooms::findOne(['id'=>$id]);
        return $model;
    }
    public function findModelCustomer($id){
        $model = Customer::findOne(['id'=>$id]);
        return $model;
    }
    public function findModelPartner($id){
        $model = Partner::findOne(['room_id'=>$id]);
        return $model;
    }
    public function actionInterested($q){
        $model = $this->findModel($q);
        $modelCustomer = $this->findModelCustomer(Yii::$app->session['customer']);
        if($model->interested == NULL){
                $model->interested = strval(Yii::$app->session['customer']);
        }
        else{
            $temp = explode(',', $model->interested);
            $flag = 0;
            foreach ($temp as $key => $value) {
                if($value == Yii::$app->session['customer'])
                    $flag = 1;
            }
            if($flag == 0)
                $model->interested = $model->interested . ','.Yii::$app->session['customer'];
        }
         if($modelCustomer->interested == NULL){
           // echo 'if';
                $modelCustomer->interested = $q;
        }
        else{
            //echo 'else';
            $temp = explode(',', $modelCustomer->interested);
            $f = 0;
            foreach ($temp as $key => $value) {
                if($value == $q)
                    $f = 1;
            }
            if($f == 0)
                $modelCustomer->interested = $modelCustomer->interested . ','.$q;
        }    
        //var_dump($modelCustomer);
        if($modelCustomer->update(false))
            echo 'true';
        else 
            echo 'false';
        if($model->update())
            echo 'true';
        else 
            echo 'false';
    }

    public function actionHome($id){
        return $this->render('home',['id'=>$id]);
    }
    public function actionDisplayMessages($id){
        $data = Message::findOne(['id'=>$id]);
        $data= $data->chat_id;
        return $this->render('DisplayMessages',['data'=>$data]);  
    }
    public function actionInsertMessage($id){
        return $this->render('InsertMessage',['id'=>$id]);
    }
    public function actionTo(){
        return $this->render('to');
    }
    public function actionSend($username,$msg){
        $modelChat = new Chat();
        $modelChat->ChatUserId = Yii::$app->session['UserId'];
        $modelChat->ChatText = $msg;
        $modelChat->save();
        $to = Credintials::findOne(['username'=>$username]);
        if(Yii::$app->session['role'] == 10)
            $msgReq = Message::findOne(['c_id'=>Yii::$app->session['UserId'],'p_id'=>$to->id]);
        elseif(Yii::$app->session['role'] == 20)
            $msgReq = Message::findOne(['p_id'=>Yii::$app->session['UserId'],'c_id'=>$to->id]);
        if($msgReq != NULL){
            if($msgReq->chat_id == NULL){
                $msgReq->chat_id = $modelChat->ChatId;
                $msgReq->update();
            }else{
                $msgReq->chat_id = $msgReq->chat_id.",".$modelChat->ChatId;
                $msgReq->update();
            }
        }else{
            $msgReq = new Message();
            Yii::$app->session['role'] == 10 ? $msgReq->c_id = Yii::$app->session['UserId'] : $msgReq->p_id = Yii::$app->session['UserId'];
            Yii::$app->session['role'] == 10 ? $msgReq->p_id = $to->id : $msgReq->c_id = $to->id;
            $msgReq->chat_id = $modelChat->ChatId;
            $msgReq->save();
        }
    }
    public function actionCheck($username){
        if(Yii::$app->session['role'] == 10)
            $role = 20;
        elseif(Yii::$app->session['role'] == 20)
            $role = 10; 
        $to = Credintials::findOne(['username'=>$username,'role'=>$role]);
        if($to != NULL){
            if(Yii::$app->session['role'] == 10)
                $msgReq = Message::findOne(['c_id'=>Yii::$app->session['UserId'],'p_id'=>$to->id]);
            elseif(Yii::$app->session['role'] == 20)
                $msgReq = Message::findOne(['p_id'=>Yii::$app->session['UserId'],'c_id'=>$to->id]);
            if($msgReq != NULL)
                return json_encode('exists');
            return json_encode('true');
        }
        else
            return json_encode('false');
    }


    public function actionInterest(){
        $data = [];
        $i=0;
        if(Yii::$app->session['role'] == 10){
            $cust = Customer::findOne(['id'=>Yii::$app->session['customer']]);
            if($cust->interested != NULL)
            { 
            $inter = explode(',', $cust->interested);  
                foreach ($inter as $key => $value) {
                   $data[$i++] = Rooms::findOne(['id'=>intval($value)]);
                }
                        //var_dump($data);
                        //die();
                $data = $this->processData($data);
            }else{
                return $this->render('Sorry');
            }
        }else if(Yii::$app->session['role'] == 20){
            $part = Partner::findOne(['id'=>Yii::$app->session['partner']]);
            $room = Rooms::findOne(['id'=>$part->room_id]);
            if($room->interested != NULL)
            { 
                $inter = explode(',', $room->interested);
                foreach ($inter as $key => $value) {
                    $data[$i++] = Customer::findOne(['id'=>intval($value)]);
                }
            }else{
                return $this->render('Sorry');
            }
        }
        
        return $this->render('interested',['data'=>$data]);
    }

    public function actionIndex1(){
        return $this->render('index1');
    }
    public function actionView(){
        if(Yii::$app->session['role'] == 10){
            return $this->redirect(['/customer/view','id'=>Yii::$app->session['customer']]);
        }else if(Yii::$app->session['role'] == 20){
            return $this->redirect(['/partner/view','id'=>Yii::$app->session['partner']]);
        }

    }
    public function actionCustomer(){
        return $this->redirect(['/customer/index']);
    }
    public function actionPartner(){
        return $this->redirect(['/partner/index']);
    }
    public function actionMainhome(){
        return $this->redirect('http://localhost/advaced/home/index.html');
    }
    public function actionGetstate($state){
        $data = State::find()->where(['country_id'=>intval($state)])->asArray()->all();
        return json_encode($data);
    }
    public function actionGetarea($area){
        $data = Area::find()->where(['state_id'=>intval($area)])->asArray()->all();
        return json_encode($data);
    }
    public function actionAllInterested(){
        $data = Rooms::find()->asArray()->all();
        foreach ($data as $key => $value) {
            $customers = explode(',',$value['interested']);
            if(count($customers) < 2){
                unset($data[$key]);
            }
        }
        return $this->render('AllInterested',['data'=>$data]);
    }
    public function actionAllQueries(){
        $data = Queries::find()->asArray()->all();
        return $this->render('AllQueries',['data'=>$data]);
    }
    public function actionClearquery($q)
    {
        $model = Queries::findOne(['id'=>$q]);
        $model->delete();
    }
}
