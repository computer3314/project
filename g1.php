<html>
<section class="bg-light" name="admin_news">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-2">
                <a name="admin_news" class="anchor"></a>
                <h2>提醒事項</h2>

                <div class="d-flex justify-content-center">
                    <div class="col-3 bg-primary">

                    </div>
                </div>
            </div>
        </div>

        <div class="py-2 ">

            <div class="py-2 ">
              <form  action="" Enctype="multipart/form-data" method="post">
                <div class="card mt-2 animate-in-down ">
                    <div class="card-header bg-primary text-left bg-white">
                      <label class="col-md-4 control-label"></label>
                      <div class="col-md-8 inputGroupContainer">
                        <?php
                        include('db.php');
                  
                        if($_FILES['file6']['name']!=null){
                        $last = strrpos($_FILES['file6']['name'],'.')+1;//獲取.在文件名中最後一次出現的位置

                        $suffix = substr($_FILES['file6']['name'],$last);//獲取文件名後綴
                        //3.文件重命名，隨機重命名

                        $path = 'upload/'.mt_rand().time().'.'.$suffix;//上傳文件保存的位置

                        move_uploaded_file($_FILES['file6']['tmp_name'], $path);//將文件保存到指定位置

}
                        $sql="INSERT INTO `process` (`name`, `project`, `thing`, `id`, `state`, `fast`, `file`, `time`) VALUES ('$_POST[people]', '$_POST[project]', '$_POST[contect]', NULL, '待審核', '$_POST[fast]', '$path', current_timestamp())";
                        $res=mysqli_query($db,$sql);
                        $sql1="SELECT * FROM project_father where name='$_POST[project]'";
                        $result1=mysqli_query($db,$sql1);
                        while($row1 = mysqli_fetch_assoc($result1)){
                          $people=$row1['principal'];
                          $sql11="SELECT * FROM process where project='$_POST[project]' and state='以核可' ORDER BY `process`.`end` DESC";
                        $res11=mysqli_query($db,$sql11);
                        $num=mysqli_num_rows($res11);
                        $row2 = mysqli_fetch_assoc($res11);
                        if($num==0)
                        {
                           header("location:display.php");
                        }
                        elseif(@$_POST["fast"]=="yes"){?>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="far fa-comment-dots"></i></span>
                            <textarea class="form-control" name="t1" placeholder="事項">你的申請核可後將優先處理</textarea>


                          </div>



                          <?php
                        header("Refresh:5;url=display.php");}
                        else{










                        ?>

                         <div class="input-group">
                           <span class="input-group-addon"><i class="far fa-comment-dots"></i></span>
                           <textarea class="form-control" name="t1" placeholder="事項"><?php echo $people?>進行中的事項由<?php echo $row2["strat"]?>到<?php echo $row2["end"]?>你的申請核可後將再這之後開始進行</textarea>


                         </div>
              <?php   header("Refresh:5;url=display.php");}}?>
                      </div>
                    </div>

                </div>
              </form>
            </div>
        </div>
    </div>
</section>

</html>
