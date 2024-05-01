<?php
include('includes/checklogin.php');
check_login();
if(isset($_POST['save']))
{

  // Get today's date
  $today = new DateTime();

  $category=$_POST['category'];
  $poultry=$_POST['poultry'];
  $arrival = $_POST['arrival'];
  $RecentVaccinationDate = $_POST['vaccination'];
  $frequency = $_POST['frequency'];
  $maxVaccinations = $_POST['maxvaccinations'];
  $units = $_POST['units'];

// Convert last vaccination date to DateTime object
$lastVaccination = new DateTime($RecentVaccinationDate);

// Check if today's date is past the last vaccination date
if ($today > $lastVaccination) {
    // Calculate next vaccination date
    $vaccinationDate = $RecentVaccinationDate;
    $nextVaccination = $lastVaccination->modify("+$frequency days")->format('Y-m-d');
} else {
    $vaccinationDate = '';
    // Next vaccination date is the same as last vaccination date
    $nextVaccination = $RecentVaccinationDate;
}

  $image=$_FILES["poultryimage"]["name"];

  move_uploaded_file($_FILES["poultryimage"]["tmp_name"],"poultryimages/".$_FILES["poultryimage"]["name"]);

  $sql="insert into tblpoultry(CategoryName,PoultryName,ArrivalDate,RecentVaccination,VaccinationFrequency,MaxVaccinations,NextVaccination,Units,PoultryImage)values(:category,:poultry,:arrival,:vaccinationDate,:frequency,:maxVaccinations,:nextVaccination,:units,:image)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':category',$category,PDO::PARAM_STR);
  $query->bindParam(':poultry',$poultry,PDO::PARAM_STR);
  $query->bindParam(':arrival',$arrival,PDO::PARAM_STR);
  $query->bindParam(':vaccinationDate',$vaccinationDate,PDO::PARAM_STR);
  $query->bindParam(':frequency',$frequency,PDO::PARAM_STR);
  $query->bindParam(':maxVaccinations',$maxVaccinations,PDO::PARAM_STR);
  $query->bindParam(':nextVaccination',$nextVaccination,PDO::PARAM_STR);
  $query->bindParam(':units',$units,PDO::PARAM_STR);
  $query->bindParam(':image',$image,PDO::PARAM_STR);

  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) 
  {
    echo '<script>alert("Registered successfully")</script>';
    echo "<script>window.location.href ='poultry_mngt.php'</script>";
  }
  else
  {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}
if(isset($_GET['del'])){    
  $cmpid=$_GET['del'];
  $query=mysqli_query($con,"delete from tblpoultry where id='$cmpid'");
  echo "<script>alert('Product record deleted.');</script>";   
  echo "<script>window.location.href='product.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php @include("includes/header.php");?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php @include("includes/sidebar.php");?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
               <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Register Poultry</h5>
              </div>
              <div class="col-md-12 mt-4">
                <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row ">
                    <div class="form-group col-md-6 ">
                      <label for="exampleInputPassword1">Poultry Category</label>
                      <select  name="category"  class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                        $sql="SELECT * from  tblpoultry_category";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0)
                        {
                          foreach($results as $row)
                          {
                            ?> 
                            <option value="<?php  echo $row->CategoryName;?>"><?php  echo $row->CategoryName;?></option>
                            <?php 
                          }
                        } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Name </label>
                      <input type="text" name="poultry" class="form-control" value="" id="poultry" placeholder="Enter Poultry name" required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Arrival/Birth Date</label>
                      <input type="date" name="arrival" value="" placeholder="Enter Date" class="form-control" id="arrival"required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">First Vaccination Date</label>
                      <input type="date" name="vaccination" value="" placeholder="Enter Date" class="form-control" id="vaccination"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Vaccination Frequency in Days</label>
                      <input type="number" name="frequency" value="" placeholder="Enter frequency" class="form-control" id="frequency"required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Max No. of Vaccinations</label>
                      <input type="number" name="maxvaccinations" value="" placeholder="No. of vaccinations" class="form-control" id="maxvaccinations"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Units</label>
                      <input type="number" name="units" value="" placeholder="Enter units" class="form-control" id="units"required>
                    </div>
                    <div class="form-group col-md-6 pl-md-0">
                      <label class="col-sm-12 pl-0 pr-0 ">Attach Poultry Photo</label>
                      <div class="col-sm-12 pl-0 pr-0">
                        <input type="file" name="poultryimage" class="file-upload-default1">
                        <div class="input-group ">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse1 btn btn-gradient-primary" value="" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                    </div>  
                  </div>
                  <button type="submit" style="float: left;" name="save" class="btn btn-primary  mr-2 mb-4">Save</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <!--  start  modal -->
              <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Poultry details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                      <?php @include("edit_poultry.php");?>
                    </div>
                    <div class="modal-footer ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <!--  start  modal -->
              <div id="editData5" class="modal fade">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View poultry details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update5">
                      <?php @include("view_product.php");?>
                    </div>
                    <div class="modal-footer ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <!--   end modal -->
              <!--  start  modal -->
              <div id="notificationsent" class="modal fade">
                <div class="notcontent">
                  <p>A notification has been sent to your phone number</p>
                </div>
              </div>
                <!--   end modal -->
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Poultry Name</th>
                      <th class="text-center"> Poultry Category</th>
                      <th class="text-center"> Poultry Age</th>
                      <th class="text-center"> Poultry Units</th>
                      <th class="text-center"> Most Recent Vaccination</th>
                      <th class="text-center"> Next Vaccination</th>
                      <th class="text-center">Posting Date</th>
                      <th class=" Text-center" style="width: 15%;">Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $currentDate = new DateTime(); // Current date

                    $sql="SELECT tblpoultry.id,tblpoultry.CategoryName,tblpoultry.PoultryName,tblpoultry.ArrivalDate,tblpoultry.RecentVaccination,tblpoultry.NextVaccination, tblpoultry.PostingDate,tblpoultry.units,tblpoultry.PoultryImage from tblpoultry ORDER BY id DESC";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                      { 
                        $arrivalDate = new DateTime($row->ArrivalDate); // Arrival date from database
                       
                    $interval = $currentDate->diff($arrivalDate);  // Calculate difference
                    $daysInterval = $interval->days;  // Get days interval
                     
                        ?>
                        <tr>
                          <td class="text-center"><?php echo htmlentities($cnt);?></td>
                          <td>
                            <img src="poultryimages/<?php  echo $row->PoultryImage;?>" class="mr-2" alt="image"><a href="#"class=" edit_data5" id="<?php echo  ($row->id); ?>" ><?php  echo htmlentities($row->PoultryName);?></a>
                          </td>
                          <td class="text-center"><?php  echo htmlentities($row->CategoryName);?></td>
                          <td class="text-center"><?php echo htmlentities($daysInterval);?> days</td>
                          <td class="text-center"><?php  echo htmlentities($row->units);?></td>
                          <td class="text-center">
                          <?php  
                        $RecentVaccinationDate = htmlentities($row->RecentVaccination); 
                        // Check if the date is null
                        try {
                        if ($RecentVaccinationDate == '0000-00-00') {
                        echo "No record of previous vaccinations";
                        } else {
                        echo $RecentVaccinationDate;
                        }
                         } catch (Exception $e) {
                        echo "No record of previous vaccinations";
                          }
                            ?>
                          </td>
                        <td class="text-center">
                          <?php  
                        $NextVaccination = htmlentities($row->NextVaccination); 
                        // Check if the date is null
                        try {
                        if ($NextVaccination == '0000-00-00') {
                        echo "Fully Vaccinated";
                        } else {
                        echo $NextVaccination;
                        }
                         } catch (Exception $e) {
                        echo "Fully Vaccinated";
                          }
                            ?>
                          </td>
                          <td class="text-center"><?php  echo htmlentities(date("d-m-Y", strtotime($row->PostingDate)));?></td>
                          <td class=" text-center"><a href="#"  class=" edit_data4" id="<?php echo  ($row->id); ?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a> </td>
                          <!-- <a href="#"  class=" sendtext" id="<?php echo  ($row->id); ?>" title="click to send reminder"><i class="fas fa-bell"></i></a> </td>
                          <a href="#"  class=" edit_data5" id="<?php echo  ($row->id); ?>" title="click to view">&nbsp;<i class="mdi mdi-eye" aria-hidden="true"></i></a>
                            <a href="product.php?del=<?php echo ($row->id);?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Do you really want to delete?');"> <i class="mdi mdi-delete"></i> </a>
                          </td> -->
                        </tr>
                        <?php 
                        $cnt=$cnt+1;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      <?php @include("includes/footer.php");?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php @include("includes/foot.php");?>
<!-- End custom js for this page -->
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data4',function(){
      var edit_id4=$(this).attr('id');
      $.ajax({
        url:"edit_poultry.php",
        type:"post",
        data:{edit_id4:edit_id4},
        success:function(data){
          $("#info_update4").html(data);
          $("#editData4").modal('show');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data5',function(){
      var edit_id5=$(this).attr('id');
      $.ajax({
        url:"view_product.php",
        type:"post",
        data:{edit_id5:edit_id5},
        success:function(data){
          $("#info_update5").html(data);
          $("#editData5").modal('show');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.sendtext',function(){
      var edit_id4=$(this).attr('id');
      $.ajax({
        url:"sendnotification.php",
        type:"post",
        data:{edit_id4:edit_id4},
        success:function(data){
          $("#info_update4").html(data);
          $("#notificationsent").modal('show');
        }
      });
    });
  });
</script>

</body>
</html>