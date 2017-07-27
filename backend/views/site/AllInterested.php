<?php
  use backend\models\Customer;
  use backend\models\Partner;
  use backend\models\Country;
  use backend\models\State;
  use backend\models\Area;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            margin-right:8%;
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
  <script type="text/javascript">
    $(document).ready(function() {
    var loc = "/advaced/backend/web/index.php?r=site%2Fall-interested";
    //alert(loc.indexOf("/advaced/backend/web/index.php?r=customer%2Findex"));
    $('.navbar-inverse .navbar-nav > li').each(function() {
        var link = $(this).find('a:first').attr('href');
        //alert(loc);
        //alert(link);
        if(loc.indexOf(link) >= 0){
            $(this).addClass('active');
        }
    });
});
</script>
</head>
<body>

<div class="container">         
      <?php
        foreach ($data as $key => $value) {
            $country = Country::findOne(['id'=>$value['country']]);
            $state = State::findOne(['id'=>$value['state']]);
            $area = Area::findOne(['id'=>$value['area']]);
            $value['country'] = $country->name;
            $value['state'] = $state->name;
            $value['area'] = $area->name;
            $customers = explode(',',$value['interested']);
      ?>
      <div class="row">
        <div class="col-md-4">  
          <p style="font-weight:bold">Customer Info:</p>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Occupation</th>
                <th>Contact no</th>
              </tr>
            </thead>
            <tbody>
              <tr>

        <?php
              foreach($customers as $k => $v){
                $customer = Customer::findOne(['id'=>$v]);
                if($customer->gender == 1)
                  $customer->gender = 'Female';
                  else
                      $customer->gender = 'Male';
                  if($customer->occupation == 1)
                      $customer->occupation = 'Proffesional';
                  else
                      $customer->occupation = 'Student';
                
        ?>
              <td><?php echo $customer->name?></td>
              <td><?php echo $customer->gender?></td>
              <td><?php echo $customer->occupation?></td>
              <td><?php echo $customer->contact_no?></td>
            </tr>
        <?php
              }
        ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <p style="font-weight:bold">Room Info:</p>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Type</th>
                <th>Rooms</th>
                <th>Rent</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $value['type']?></td>
                <td><?php echo $value['no_of_rooms']?></td>
                <td><?php echo $value['rent']?></td>
                <td><?php echo $value['flat_no'].','.$value['building_name'].',<br>'.$value['area'].','.$value['state'].','.$value['country']?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-4">
          <?php
             $partner = Partner::findOne(['room_id'=>$value['id']]);
          ?>
          <p style="font-weight:bold">Partner Info:</p>
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Contact</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $partner->name?></td>
                <td><?php echo $partner->email?></td>
                <td><?php echo $partner->contact?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <?php
        }
      ?>
</div>

</body>
</html>
