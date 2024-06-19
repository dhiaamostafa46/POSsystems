<?php 
ini_set( "display_errors", 0);
ob_start();
session_start();
session_regenerate_id();
require_once 'dbconnect.php';
$title = "إضافة دفعية";
$error = false;
date_default_timezone_set("Asia/Riyadh");
$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
//$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
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

        $query8 = $db->prepare("SELECT * FROM branch WHERE resta = :resta ORDER BY branchID ASC");
$query8->execute(['resta' => e($ro2->resta)]);
$num_rows8 = $query8->rowCount();

$id=0;$am=0;$sublierName ="";
if(isset($_GET['id'])  )
{
    $id = $_GET['id'];
    //$am = $_GET['am'];
    $subQuery = $db->prepare("SELECT Purchases.*,Suppliers.name FROM `Purchases` inner join Suppliers on Suppliers.subID = Purchases.supplier where Purchases.id = :id;");
         
          $subQuery->execute(['id' => $id]);
          $subrow = $subQuery->fetchObject();
          $sublierName = $subrow->name;
    
}
if(isset($_POST["save"]))
{
  
           /*$qu = $db->prepare("SELECT * FROM `sublierBalance`");
          $qu->execute();
          $nums = $qu->rowCount();
          
           echo "<script>alert('user".$nums."')</script>";*/
  
  
    
  $subid = $_POST["sub"];
    //$dat = date('Y-m-d');
    $amount = $_POST["amount"];
    $type = $_POST["type"];
     $imgFile = $_FILES['file']['name'];
	  $tmp_dir = $_FILES['file']['tmp_name'];
	  $imgSize = $_FILES['file']['size'];
 //echo '<script>alert("'.$job.$hdate.'");</script>';
 

       if($imgFile)
		{
			$upload_dir = 'recImages/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif' ,'webp'); // valid extensions
			$pic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
				   
					move_uploaded_file($tmp_dir,$upload_dir.$pic);
				}
				else
				{
				     
					$error = true;
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$error = true;
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		} else
      {
          $error = true;
              $errMSG = "الرجاء إرفاق صورة الإشعار";
      }
    
 
 
 
  $addQuery = $db->prepare("INSERT INTO sublierPayments(subID,userID,amount,type,recPhoto,dat) VALUES (:subid, :userid, :amount, :type, :photo,:dat)");
       // echo "<script>alert('user".$subid.$row->aID.$amount.$type.$pic.$dat."')</script>";
          $addQuery->execute(['subid' => $subid,'userid'=>e($row->aID),'amount'=>$amount,'type'=>$type,'photo'=>$pic,'dat'=>$dat]);
          
          if ($addQuery) {
              
              $updateBalQuery = $db->prepare("update sublierBalance SET balance = balance - :bal where subID =:subid");
               $updateBalQuery->execute(['bal' => $amount,'subid' => $subid]);
               //if(!$updateBalQuery){$done = false;}
              
              //////////////update purchase status //////////////
              $updatePurchQuery = $db->prepare("update Purchases SET Status = 1 where id =:id");
               $updatePurchQuery->execute(['id' => $id]);
              //////////////////////////////////////////////////
                  $errTyp = "success";
                          $sucMSG = "تمت إضافة الدفعية";
    header("refresh:2;SubBalance");
    }
          
         
}





if(isset($_GET['UPDATE']))
  {
    
    $delete = filter_var($_GET['UPDATE'], FILTER_SANITIZE_NUMBER_INT);
    $query4 = $db->prepare("UPDATE orders SET status = 4 WHERE oID = :oID");
    $query4->execute(['oID' => $delete]);
 
  if ($query4) {
    $errTyp = "success";
    $sucMSG = "الطلب جاهز";
    header("refresh:3;home");
  } else {
    $errTyp = "danger";
    $errMSG = "حدث خطاء";	
  }
  
}

?>
 
 <?php require_once 'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><i class="bi bi-menu-app"></i>دفعية جديدة
      
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
    <h5 class="card-title m-0">إضافة دفعيه  - <?php echo $sublierName; ?> 

</h5>
    </div>



            <div class="col-12">

                
              <div class="card recent-sales overflow-auto">

                <div class="card-body pt-3">

                        <form method="post" enctype="multipart/form-data">
                          <input type ="hidden" name="sub" value="<?php echo $subrow->supplier;?>">
	  <div class="mb-3">
	      
      <label for="exampleFormControlInput1" class="form-label">المبلغ المدفوع </label><br>
       <!--<label for="exampleFormControlInput1" class="form-label"> تاكد من مطابقة المبلغ مع الإشعار </label>-->
      <input type="number" name="amount" class="form-control"  required placeholder="00.0" value ="<?php echo $subrow->price;?>">
	  </div>
	  <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">نوع الدفعية </label > 
                                &nbsp;&nbsp;
                                <select class="form-control" name="type">
                                    
                               </div>
                                 
                                 
                               <option value="1">نقدأ</option>
                               <option value="2">شبكة</option>
                               <option value="3">حوالة بنكية</option>
                              
                         
                           </select>
                            <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">صورة الإشعار </label>
      <input type="file" name="file" class="form-control">
	  </div>
      <div class="d-grid gap-2">
      <button class="btn btn-success btn-lg butt2" type="submit" name="save">
          <span class="button__text">حفظ</span>
      </button>
      </div>
	  </form>
                </div>

              </div>
            </div><!-- End Recent Sales -->

          
          </div>
       
    </section>

  </main><!-- End #main -->
  
     
  
 <?php require_once 'footer.php'; ?>
 