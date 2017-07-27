 <?php
  use backend\models\Message;
  use backend\models\Credintials;
 ?>
 </!DOCTYPE html>
 <html>
 <head>
   <title></title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script>

   $(document).ready(function(){
      $('input[name=uname]').focusin(function(){
        $('.err').empty();
      });
   });

   function checkUser(){
    //console.log('here');
     $.ajax({
            type:"GET",
            url:"http://localhost/advaced/backend/web/index.php?r=site/check&username="+$("input[name=uname]").val(),
            success:function(msg){
              msg = eval(msg);
                if(msg == 'true'){
                  send();
                }
                else if(msg == 'false'){
                  $('.err').text('enter valid values');
                }
                else if(msg == 'exists'){
                  $('.err').text('Chat Already Exists');
                }
              }
          }) 
   }

      function send(){
        if($("input[name=uname]").val() != '' && $("input[name=msg]").val() != '')
          $.ajax({
            type:"GET",
            url:"http://localhost/advaced/backend/web/index.php?r=site/send&username="+$("input[name=uname]").val()+"&msg="+$("input[name=msg]").val(),
            success:function(){
                location.reload();
              }
          })
      }
   </script>

    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .chats{
      height:20px;
    }
    .err{
      color:red;
    }
  </style>
  <style type="text/css">
    .navbar-inverse{
            background-color: white;
            border-color:white;
        }
    .navbar-inverse .navbar-nav > li > a{
            color : black;
            font-size:15px;
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
            margin-top: -5px;
        }
        .navbar-right{
            margin-right:10%;
        }
        .navbar-inverse .navbar-nav > li > a:hover{
            background-color:#9E3A3A; 
        }
        .navbar-inverse .navbar-nav > .active > a{
            background-color:#9E3A3A;
        }
        .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover{
            background-color:#9E3A3A; 
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
        }

  </style>
 </head>
 <body>
        <div class="container">
        <?php 
        if(Yii::$app->session['role'] == 10)
          $data = Message::find()->where(['c_id'=>Yii::$app->session['UserId']])->asArray()->all();
        else if(Yii::$app->session['role'] == 20)
          $data = Message::find()->where(['p_id'=>Yii::$app->session['UserId']])->asArray()->all();
        if($data != NULL){
        ?>
          <h1>Chat History:</h1>
          <hr>
        <?php
        }
          foreach ($data as $key => $value) {
        ?>
              <a href="http://localhost/advaced/backend/web/index.php?r=site/home&id=<?php echo $value['id']?>"><div class="row chats">

        <?php
          if(Yii::$app->session['role'] == 10)
            $name = Credintials::findOne(['id'=>$value['p_id']]);
        else if(Yii::$app->session['role'] == 20)
          $name = Credintials::findOne(['id'=>$value['c_id']]);
          echo $name->username;
        ?>
              </div></a>
              <hr>
        <?php
          }
        ?>
          <label><b>TO:</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>

          <label><b>Message:</b></label>
          <input type="text" placeholder="Enter Message" name="msg" required>

          <button type="submit" onclick="checkUser()">Send</button>
          <p class="err"></p>
        </div>
 </body>
 </html>
