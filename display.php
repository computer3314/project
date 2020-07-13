<?php

require dirname(__FILE__) . '\silde.php';
//silde bar

?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <!-- Include the above in your HEAD tag -->
<style>
#menu ul{

  float:right;

  list-style:none;

  }

  #menu ul li{

  float:left;

  margin:0px 10px 0px 0px;

  }



</style>
        <div class="container well">
          <div class="container-fluid">


          <br>
          <div class="row">



            <div class="form-group">
              <label class="col-md-5 control-label"  style="color:red"> 申請事項表</label>
              <div id="menu">

<button class="btn btn-primary" id="now">進行中</button>
<button class="btn btn-primary" id="check1">待審核</button>
<button class="btn btn-primary" id="no">窒礙難行</button>
<button class="btn btn-primary" id="ff1">完成</button>

</div>
<script>
$("#now").click(function(){
       $("#p2").show();
       $("#p1").hide();
         $("#p4").hide();
           $("#p3").hide();
  });
  $("#check1").click(function(){
     $("#p1").show();
$("#p2").hide();
$("#p3").hide();
$("#p4").hide();
    });
    $("#no").click(function(){
           $("#p3").show();
           $("#p1").hide();
             $("#p4").hide();
               $("#p2").hide();
      });
      $("#ff1").click(function(){
               $("#p4").show();
$("#p2").hide();
$("#p3").hide();
$("#p1").hide();
        });
</script>



               <div class="col-md-8 inputGroupContainer" id="p1" >
               <br>
               <?php
           include('db.php');
           $sql="SELECT * FROM process where state='待審核'";
           $result=mysqli_query($db,$sql);
           $num=mysqli_num_rows($result);
           for($i=0;$i<=$num;$i++){

            while ($row = mysqli_fetch_assoc($result)) {
              $name=$row['name'];
              $project=$row['project'];
              $id=$row['id'];
              $state=$row['state'];
              $fast=$row['fast'];
              $thing=$row['thing'];
              $file=$row['file'];
              $time=$row['time'];
              $i=$i+1;

           ?>

               <div id="card" class="card" style="width: 30rem;">
                 <div class="card-body">


                   <h3 class="card-text text-center">申請單號：<?php echo "$id"; ?></h3>
                   <h5 class="card-text text-center">申請時間：<?php echo "$time"; ?></h5>
                     <h5 class="card-text text-center">申請人：<?php echo "$name"; ?></h5>


                      <h5 class="card-text text-center">狀態：<?php echo "$state"; ?></h5>

                      <?php if($fast!=""){
                        echo '<h5 class="card-text text-center" style="color:red">需要插隊</h5>';
                      }?>

                   <br>
                   <div class="text-center">
                       <?php if (!$file == NULL) {?><a href="javascript:void(0)" class="btn btn-primary" onclick="window.open('<?php echo "$file" ?>', '', 'width=800,height=800');" >查看檔案</a> <?php  } ?>
<button class="btn btn-primary" data-target="#showModal<?php echo $i ?>" data-toggle="modal">查看</button>


                   </div>

                 </div>
               </div>
               <div id="showModal<?php echo $i ?>" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bolder" style="color:red">申請事項</h4> <button type="button" class="close" data-dismiss="modal"><b>×</b></button>
      </div>

      <div class="modal-body modal-scrolling">
        <div class="my-2">
            <h3  class="modal-title font-weight-bolder">專案名稱：<?php echo "$project"; ?></h3>

        </div>
        <div class="my-2">
          <h3  class="modal-title font-weight-bolder">申請人：<?php echo "$name"; ?></h3>

        </div>
        <div class="my-2">

         <h3  class="modal-title font-weight-bolder">申請單號：<?php echo "$id"; ?></h3>
        </div>
        <div class="my-2">
               <h3  class="modal-title font-weight-bolder">申請時間：<?php echo "$time"; ?></h3>

        </div>
        <div class="my-2">
          <h3  class="modal-title font-weight-bolder">事項：<?php echo "$thing"; ?></h3>

        </div>
        <div class="my-2">

          <label for="lastName">狀態</label>
          <select class="form-control" id="state<?php echo $i ?>" name="state">

        　<option value="<?php echo $state ?>"><?php echo  $state ?></option>
        　<option value="以核可">已核可</option>
        　<option value="有待討論">有待討論</option>

        </select>
           <textarea id="dont<?php echo $i ?>"  placeholder="討論原因" style="display:none" class="form-control" required="true"></textarea>
        <script>
        $(document).on("change",'#state<?php echo $i ?>',function(){
          var state=$(this).val();
          if(state=="有待討論"){
            $("#dont<?php echo $i ?>").show();
          }
          else {
            $("#dont<?php echo $i ?>").hide();
          }
  });
        </script>
        </div>
        <div class="my-2">
          <label for="lastName">開始時間</label>
               <input id="start<?php echo $i ?>" name="addressLine1" style="display:none" placeholder="起日" class="form-control" required="true" value="" type="date">
        </div>
        <div class="my-2">
          <label for="lastName">結束時間</label>
               <input id="end<?php echo $i ?>" name="addressLine2" style="display:none" placeholder="只日" class="form-control" required="true" value="" type="date">

        </div>
        <script>
        $(document).on("change",'#state<?php echo $i ?>',function(){
          var state=$(this).val();
          if(state=="以核可"){
            $("#start<?php echo $i ?>").show();
            $("#end<?php echo $i ?>").show();
          }
          else {
            $("#start<?php echo $i ?>").hide();
            $("#end<?php echo $i ?>").hide();

          }
  });
        </script>
        <div class='pt-2'>
          <h6 id="ts"></h6>
        </div>
      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" id="button<?php echo $i ?>">送出</button>


      </div>
    </div>
  </div>
</div>

<script>
          $("#button<?php echo $i?>").click(function() {
          $.post("updataa.php", {
            state: $("#state<?php echo $i ?>").val(),
              id: <?php echo "$id"; ?>,
           start: $("#start<?php echo $i ?>").val(),

              dont: $("#dont<?php echo $i ?>").val(),
          end: $("#end<?php echo $i ?>").val()
            },
            function(data, status) {

                 location.reload();

        });
        });

        </script>
          <?php } }?>

  </div>



  <div class="col-md-8 inputGroupContainer" id="p2" style="display:none">
  <br>
  <?php
  include('db.php');
  $sql="SELECT * FROM process where state='以核可'";
  $result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  for($i=0;$i<=$num;$i++){

  while ($row = mysqli_fetch_assoc($result)) {
  $name=$row['name'];
  $project=$row['project'];
  $id=$row['id'];
  $state=$row['state'];
  $fast=$row['fast'];
  $thing=$row['thing'];
  $file=$row['file'];
  $time=$row['time'];
  $i=$i+1;

  ?>

  <div id="card" class="card" style="width: 30rem;">
    <div class="card-body">


      <h3 class="card-text text-center">申請單號：<?php echo "$id"; ?></h3>
      <h5 class="card-text text-center">申請時間：<?php echo "$time"; ?></h5>
        <h5 class="card-text text-center">申請人：<?php echo "$name"; ?></h5>
            <h5 class="card-text text-center">交辦內容：<?php echo "$thing"; ?></h5>
  <h5 class="card-text text-center">預計開始時間：<?php echo "$row[strat]"; ?></h5>
  <h5 class="card-text text-center">預計結束時間：<?php echo "$row[end]"; ?></h5>

         <h5 class="card-text text-center">狀態：<?php echo "$state"; ?></h5>

         <?php if($fast!=""){
           echo '<h5 class="card-text text-center" style="color:red">需要插隊</h5>';
         }?>

      <br>
      <div class="text-center">
          <?php if (!$file == NULL) {?><a href="javascript:void(0)" class="btn btn-primary" onclick="window.open('<?php echo "$file" ?>', '', 'width=800,height=800');" >查看檔案</a>      <?php  } ?>



      </div>

    </div>
  </div>

  <script>
  $("#f1<?php echo $i?>").click(function() {
    $.post("upfinish.php", {
        id: <?php echo "$id"; ?>,
      },
      function(data, status) {

           location.reload();

  });
  });
  </script>

  <?php } }?>

  </div>
  <div class="col-md-8 inputGroupContainer" id="p3" style="display:none">
  <br>
  <?php
  include('db.php');
  $sql="SELECT * FROM process where state='有待討論'";
  $result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  for($i=0;$i<=$num;$i++){

  while ($row = mysqli_fetch_assoc($result)) {
  $name=$row['name'];
  $project=$row['project'];
  $id=$row['id'];
  $state=$row['state'];
  $reson=$row['reson'];
  $thing=$row['thing'];
  $file=$row['file'];
  $time=$row['time'];
  $i=$i+1;

  ?>

  <div id="card" class="card" style="width: 30rem;">
    <div class="card-body">


      <h3 class="card-text text-center">申請單號：<?php echo "$id"; ?></h3>
      <h5 class="card-text text-center">申請時間：<?php echo "$time"; ?></h5>
        <h5 class="card-text text-center">申請人：<?php echo "$name"; ?></h5>

         <h5 class="card-text text-center">狀態：<?php echo "$state"; ?></h5>
         <h5 class="card-text text-center">原因：<?php echo "$reson"; ?></h5>



      <br>
      <div class="text-center">
          <?php if (!$file == NULL) {?><a href="javascript:void(0)" class="btn btn-primary" onclick="window.open('<?php echo "$file" ?>', '', 'width=800,height=800');" >查看檔案</a>      <?php  } ?>



      </div>

    </div>
  </div>



  <?php } }?>

  </div>
  <div class="col-md-8 inputGroupContainer" id="p4" style="display:none">
  <br>
  <?php
  include('db.php');
  $sql="SELECT * FROM process where state='已完成'";
  $result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  for($i=0;$i<=$num;$i++){

  while ($row = mysqli_fetch_assoc($result)) {
  $name=$row['name'];
  $project=$row['project'];
  $id=$row['id'];
  $state=$row['state'];
  $reson=$row['reson'];
  $thing=$row['thing'];
  $file=$row['file'];
  $time=$row['time'];
  $i=$i+1;

  ?>

  <div id="card" class="card" style="width: 30rem;">
    <div class="card-body">


      <h3 class="card-text text-center">申請單號：<?php echo "$id"; ?></h3>
      <h5 class="card-text text-center">申請時間：<?php echo "$time"; ?></h5>
        <h5 class="card-text text-center">申請人：<?php echo "$name"; ?></h5>
        <h5 class="card-text text-center">開始時間：<?php echo "$row[strat]"; ?></h5>
        <h5 class="card-text text-center">結束時間：<?php echo "$row[end]"; ?></h5>
         <h5 class="card-text text-center">狀態：<?php echo "$state"; ?></h5>




      <br>
      <div class="text-center">
          <?php if (!$file == NULL) {?><a href="javascript:void(0)" class="btn btn-primary" onclick="window.open('<?php echo "$file" ?>', '', 'width=800,height=800');" >查看檔案</a>      <?php  } ?>



      </div>

    </div>
  </div>



  <?php } }?>

  </div>
      </div>
          <br>
          <div class="col-lg-10">
          </div>


        </div>
      </div>
        <!-- End of Content Wrapper -->
      </div>
        <!-- End of Content Wrapper -->


      <!-- Scroll to Top Button-->

      <!-- Logout Modal-->




      <!-- Custom scripts for all pages-->


</body>

</html>

