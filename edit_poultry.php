<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['insert1']))
{
    $eib= $_SESSION['editbidp'];
    $category=$_POST['category'];
    $poultry=$_POST['poultry'];
    $arrival = $_POST['arrival'];
    $RecentVaccinationDate = $_POST['vaccination'];
    $frequency = $_POST['frequency'];
    $maxVaccinations = $_POST['maxvaccinations'];
    $units = $_POST['units'];

    // Get today's date
    $today = new DateTime();

    echo $category;
    echo $units;

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

  $sql4="update tblpoultry set CategoryName=:category,PoultryName=:poultry,ArrivalDate=:arrival,RecentVaccination=:vaccinationDate,VaccinationFrequency=:frequency,MaxVaccinations=:maxVaccinations,NextVaccination=:nextVaccination,Units=:units where id=:eib";    
  $query=$dbh->prepare($sql4);
  $query->bindParam(':category',$category,PDO::PARAM_STR);
  $query->bindParam(':poultry',$poultry,PDO::PARAM_STR);
  $query->bindParam(':arrival',$arrival,PDO::PARAM_STR);
  $query->bindParam(':vaccinationDate',$vaccinationDate,PDO::PARAM_STR);
  $query->bindParam(':frequency',$frequency,PDO::PARAM_STR);
  $query->bindParam(':maxVaccinations',$maxVaccinations,PDO::PARAM_STR);
  $query->bindParam(':nextVaccination',$nextVaccination,PDO::PARAM_STR);
  $query->bindParam(':units',$units,PDO::PARAM_STR);
  $query->bindParam(':eib',$eib,PDO::PARAM_STR);

    
    $query->execute();
    if ($query->execute())
    {
        echo '<script>alert("updated successfuly")</script>';
    }else{
        echo '<script>alert("update failed! try again later")</script>';
    }
}
?>
<div class="card-body">
    <?php
    $eid=$_POST['edit_id4'];
    $sql2="SELECT tblpoultry.id,tblpoultry.CategoryName,tblpoultry.PoultryName,tblpoultry.ArrivalDate,tblpoultry.RecentVaccination,tblpoultry.VaccinationFrequency,tblpoultry.MaxVaccinations,tblpoultry.NextVaccination,tblpoultry.Units,tblpoultry.PostingDate,tblpoultry.PoultryImage from tblpoultry where tblpoultry.id=:eid";
    $query2 = $dbh -> prepare($sql2);
    $query2-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query2->execute();
    $results=$query2->fetchAll(PDO::FETCH_OBJ);
    if($query2->rowCount() > 0)
    {
        foreach($results as $row)
        {
            $_SESSION['editbidp']=$row->id;
            ?>

                <div class="col-md-12 mt-4">
                <form class="form-sample"  method="post" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="basicinput">Poultry Image</label>
                    <div class="controls">
                        <img style="height: 100px; width: 100px;" src="poultryimages/<?php  echo $row->PoultryImage;?>" width="150" height="100">
                        <!-- <a href="update_productimage.php?imageid=<?php echo ($row->id) ?>">Change Image</a> -->
                    </div>
                </div>  
                <div>&nbsp;</div>

                  <div class="row ">
                    <div class="form-group col-md-6 ">
                     <label class="col-sm-12 pl-0 pr-0">Poultry Category</label>
                        <div class="col-sm-12 pl-0 pr-0">
                            <input type="text" name="category" id="category" class="form-control" value="<?php  echo $row->CategoryName;?>" readonly />
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Name </label>
                      <input type="text" name="poultry" class="form-control" value="<?php  echo $row->PoultryName;?>" id="poultry" placeholder="Enter Poultry name" readonly>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Birth Date</label>
                      <input type="date" name="arrival" value="<?php  echo $row->ArrivalDate;?>" placeholder="Enter Date" class="form-control" id="arrival" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Recent Vaccination Date</label>
                      <input type="date" name="vaccination" value="<?php  echo $row->RecentVaccination;?>" placeholder="Enter Date" class="form-control" id="vaccination"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Vaccination Frequency in Days</label>
                      <input type="number" name="frequency" value="<?php  echo $row->VaccinationFrequency;?>" placeholder="Enter frequency" class="form-control" id="frequency"required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Max No. of Vaccinations</label>
                      <input type="number" name="maxvaccinations" value="<?php  echo $row->MaxVaccinations;?>" placeholder="No. of vaccinations" class="form-control" id="maxvaccinations"required>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="form-group col-md-6">
                      <label for="exampleInputName1">Poultry Units</label>
                      <input type="number" name="units" value="<?php  echo $row->Units;?>" placeholder="Enter units" class="form-control" id="units"required>
                    </div> 
                  </div>
                  <button type="submit" name="insert1" class="btn btn-primary btn-fw mr-2" style="float: left;">Update</button>
                </form>
              </div>
            <?php 
        }
    } ?>
</div>