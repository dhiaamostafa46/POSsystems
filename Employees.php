<?php 
ini_set( "display_errors", 0);
ob_start();
session_start();
session_regenerate_id();
require_once 'dbconnect.php';
$title = "الموظفين";
$error = false;
date_default_timezone_set("Asia/Riyadh");
$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
//$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
	$title = "الموظفين";

if( isset($_SESSION['user']) ) {
        $user = filter_var($_SESSION['user'], FILTER_SANITIZE_STRING);
        $query = $db->prepare("SELECT * FROM admin WHERE token = :user");
        $query->execute(['user' => $user,]);
        $num_rows = $query->rowCount();
        $row = $query->fetchObject();
        if ($num_rows == 0 || $_SESSION['role'] ==3) {
        header("Location: logout?logout");
        }
        } else {
        header("Location: index");
        }

        $quer2 = $db->prepare("SELECT * FROM resta WHERE resta = :resta");
        $quer2->execute(['resta' => e($row->resta)]);
        $num_ro2 = $quer2->rowCount();
        $ro2 = $quer2->fetchObject();
        if ($num_ro2 == 0) {
        header("Location: add");
        }

     //"SELECT EmpUsers.*,branch.resta FROM `EmpUsers` inner join branch on branch.hex = EmpUsers.hex WHERE branch.resta = '284656733';";
         // $querys2 = $db->prepare("SELECT EmpUsers.*,branch.branchAr,resta.resta FROM `EmpUsers` INNER JOIN branch on branch.hex = EmpUsers.hex INNER join resta on resta.resta = branch.resta where resta.resta = :resta and EmpUsers.Status=1;");
          $querys2 = $db->prepare("SELECT EmpUsers.*,branch.branchAr FROM `EmpUsers` INNER JOIN branch on branch.hex = EmpUsers.hex where branch.resta = :resta and EmpUsers.Status=1;");
         
          $querys2->execute(['resta' => e($ro2->resta)]);
          $num_rows8 = $querys2->rowCount();

if(isset($_POST["btnUpd"]))
{
    $uid = $_POST['uID'];
    $status =$_POST['status'];
     $qUpdate = $db->prepare("UPDATE EmpUsers SET Status= :stat where userID= :uid;");
     $qUpdate->execute(['stat' => $status,'uid'=>$uid]);
     
     if($qUpdate)
     {
         $sucMSG ="";
         header("Location: Employees");
     }
}

?>
 
 <?php require_once 'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><i class="bi bi-menu-app"></i>الموظفين <?php echo e($row->branchAr); ?>
      
      </h1>
      
    </div><!-- End Page Title -->

 <?php if(isset($errMSG) && $errMSG != ""){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong><?php echo $errMSG; ?></strong>
</div>
<?php } else if(isset($sucMSG) && $sucMSG != ""){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><?php echo $sucMSG; ?></strong>
</div>
<?php } ?>
    <section class="section dashboard">
    
          <div class="row">
 
 
  



<div class="card recent-sales overflow-auto">
    <div class="card-header py-2">
    <h5 class="card-title m-0">المستخدمين 
<a class="btn btn-primary float-end m-0" type="button"  title="موظف جديد"  href="empAdd?hex=<?php echo e($row->hex); ?>"><i class='bx bx-plus-medical'></i></a>

</h5>
    </div>



            <div class="col-12">
<a type="button" href="OldEmps"   class="btn btn-danger mx-0"><i class='bx bx-group' ></i>الموظفين الموقوفين</a>
                <div class="card-body pt-3">
                
              <div class="card recent-sales overflow-auto">

<div style="overflow-x:auto;">
 <center><h4 class="card-title"><?php //echo $dat; ?></h4></center>
 <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
                      <tr>
    <th class="th-sm" width="1%">رقم الموظف</th>
	  <th class="th-sm">إسم الموظف</th>
	  <th class="th-sm">الفرع</th>
	  <th class="th-sm">الجوال</th>
	  <th class="th-sm">الوظيفة</th>
	  
	 
	  


	  
    
    
                      </tr>
                    </thead>
  <tbody id="noti_number">
 <?php while($row2 = $querys2->fetchObject()) { 
                         ?> 
                      <tr>
                       
                        <td> 
                           <?php echo e($row2->userID); ?>
                        </td>
                        <td>
                            <?php echo e($row2->empName); ?>
                        </td>
                         <td> 
                           <?php echo e($row2->branchAr); ?>
                        </td>
                        <td>
                            <?php echo e($row2->empPhone ); ?>
                        </td>
                         <td>
                            <?php echo e($row2->empJob ); ?>
                        </td>
                        <td>
                            <a type="button" href="?del=<?php echo e($row2->userID); ?>"  data-bs-toggle="modal" data-bs-target="#exampleModalG" class="btn btn-danger mx-0"><i class='bx bx-trash'></i></a>
                        </td>
                        
                        <!--<a class="btn btn-primary float-end m-0" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModalG"><i class='bx bx-plus-medical'></i></a>-->

                        
                   <div class="modal fade" id="exampleModalG" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >حذف موظف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data">
      <div class="modal-body">

      <div class="mb-3">
    <label class="form-label">سبب الحذف</label>
    <input type="hidden" name="uID" value="<?php echo e($row2->userID); ?>">
    <select name="status">
        <option value="0">حذف</option>
        <option value="2">ترك العمل</option>
    </select>
  </div>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="submit" name="btnUpd" class="btn btn-primary">حذف</button>
      </div>
       </form>
    </div>
  </div>
</div>    
	                  
	                  
    
     
     <!-- <td><a class="btn btn-info btn-sm" type="button" href="view?hexID=<?php echo e($row2->hex); ?>">عرض</a></td>
-->     
</tr>





                      <?php } ?>
  </tbody>
</table>

</div>	

                </div>

              </div>
            </div><!-- End Recent Sales -->

          
          </div>
       
    </section>

  </main><!-- End #main -->
  
     
  
 <?php require_once 'footer.php'; ?>
 