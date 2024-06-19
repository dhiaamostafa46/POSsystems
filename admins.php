<?php 

ini_set( "display_errors", 0);
	ob_start();
	session_start();
session_regenerate_id();
	require_once 'dbconnect.php';
	$error = false;
	$title="المدراء";
if( isset($_SESSION['user']) ) {
$user = filter_var($_SESSION['user'], FILTER_SANITIZE_STRING);
$query = $db->prepare("SELECT * FROM admin WHERE token = :user");
$query->execute(['user' => $user,]);
$num_rows = $query->rowCount();
$row = $query->fetchObject();
if ($num_rows == 0) {
header("Location: logout?logout");
}
} else {
  header("Location: index");
  exit;
}


$quer2 = $db->prepare("SELECT * FROM resta WHERE resta = :resta");
    $quer2->execute(['resta' => e($row->resta)]);
    $num_ro2 = $quer2->rowCount();
    $ro2 = $quer2->fetchObject();
    if ($num_ro2 == 0) {
    header("Location: add");
    }


$query2 = $db->prepare("SELECT * FROM admin WHERE resta = :resta ORDER BY aID ASC");
$query2->execute(['resta' => e($ro2->resta)]);
$num_rows2 = $query2->rowCount();


if ( isset($_POST['add_account']) ) {
    
    $bytes = random_bytes(12);
     $token = bin2hex($bytes);
    $event = e($row->event);
    $aName = filter_var($_POST['aName'], FILTER_SANITIZE_STRING);
    $aEmail = filter_var($_POST['aEmail'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['aPassword'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['aPhone'], FILTER_SANITIZE_STRING);
    $role =filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    
    $imgFile = $_FILES['file']['name'];
	  $tmp_dir = $_FILES['file']['tmp_name'];
	  $imgSize = $_FILES['file']['size'];
    
    $error = "";
    
    /*if (empty($event)){
      $error = true;
      $errMSG = "Error....105";
    } else*/ if (empty($aName)){
        $error = true;
        $errMSG = "الرجاء كتابة الإسم";
    } else if (empty($aEmail)){
        $error = true;
        $errMSG = "الرجاء كتابة البريد الإلكتروني";
    } else if (empty($password)){
			$error = true;
			$errMSG = "الرجاء كتابة كلمة السر ";
	} else {
		$query41 = $db->prepare("SELECT email FROM admin WHERE email = :email");
        $query41->execute(['email' => $aEmail,]);
        $num_rows41 = $query41->rowCount();

		if($num_rows41 != 0){
			$error = true;
			$errMSG = "هذا البريد مسجل مسبقا.";
		}
	}
	
		if($imgFile)
		{
			$upload_dir = 'profiles/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif' ,'webp'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
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
		}
    
    if( !$error ) {
        $options = ['cost' => 12,];
        $aPassword = password_hash($password, PASSWORD_DEFAULT, $options);  

       $query = $db->prepare("INSERT INTO admin(resta,fName,phone,email,password,token,role) VALUES (:resta, :fName, :phone ,:email, :password, :token, :role)");
        $query->execute(['resta' =>e($ro2->resta),'fName' => e($aName),'phone'=>$phone,'email' => e($aEmail),'password' => e($aPassword),'token' => e($token),'role'=>$role]);
            
        if ($query) {
            $errTyp = "success";
            $sucMSG = "تم إنشاء الحساب بنجاح";
            header("refresh:2;admins");
        } else {
            $errTyp = "danger";
            $errMSG = "حدث خطاء";
        }	
            
    }	
}

if(isset($_POST['btnUpdate']))
{
  
    $aID = filter_var($_POST['admID'], FILTER_SANITIZE_STRING);
     
    $aName = filter_var($_POST['editName'], FILTER_SANITIZE_STRING);
    $aEmail = filter_var($_POST['editEmail'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['editPass'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['editPhone'], FILTER_SANITIZE_STRING);
    $role =filter_var($_POST['editRole'], FILTER_SANITIZE_STRING);
    
        $options = ['cost' => 12,];
        $aPassword = password_hash($password, PASSWORD_DEFAULT, $options);  
         //$aPassword = $password;  

    //echo "<script>alert('".$aName.$phone.$role.'soso'.$aID."');</script>";
   
	$res6 = $db->prepare("UPDATE admin SET fName = :fName , phone = :phone, email = :email, password =:password,
	 role = :role WHERE aID = :aid");
    $res6->execute(['fName' => e($aName),'phone'=>$phone,'email' => e($aEmail),'password' => e($aPassword),'role'=>$role,'aid'=>$aID]);
	
	//	$res6 = $db->prepare("UPDATE admin SET fName = :fName, phone = :phone,email = :email,password =:password  WHERE aID = :aid");
    //$res6->execute(['fName' => e($aName),'phone'=>$phone,'email' => e($aEmail),'password' => e($aPassword),,'aid'=>$aID]);
	
	
	
	if ($res6) {
    $errTyp = "success";
    $sucMSG = "تم التعديل بنجاح";
    header("refresh:2;admins");
    }
}
if(isset($_GET['accept']))
{
	$accept = filter_var($_GET['accept'], FILTER_SANITIZE_NUMBER_INT);
	$res4 = $db->prepare("UPDATE admin SET active = 1 WHERE aID = :accept");
    $res4->execute(['accept' => $accept,]);
	if ($res4) {
    $errTyp = "success";
    $sucMSG = "تم تفعيل الحساب بنجاح";
    header("refresh:2;admins");
    }
}

if(isset($_GET['reject']))
{
	$reject = filter_var($_GET['reject'], FILTER_SANITIZE_NUMBER_INT);
	$res42 = $db->prepare("UPDATE admin SET active = 0 WHERE aID = :reject");
    $res42->execute(['reject' => $reject,]);
    if ($res42) {
    $errTyp = "success";
    $sucMSG = "تم إيقاف الحساب بنجاح";
    header("refresh:2;admins");
    }
}

?>
 
 <?php require_once 'header.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><i class='bx bx-user-check'></i> حسابات المدراء 
      
      <a class="btn btn-primary float-end" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" title="حساب جديد"><i class='bx bx-plus-medical'></i></a>
      </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home">الرئيسية</a></li>
          <li class="breadcrumb-item active">المدراء</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    
          <div class="row">

    
            <div class="col-12">
<?php if(isset($errMSG) && $errMSG != ""){ ?>
<div class="alert alert-danger" role="alert">
  <i class='bx bx-x-circle'></i> <?php echo $errMSG; ?>
</div>
<?php } else if(isset($sucMSG) && $sucMSG != ""){ ?>
<div class="alert alert-success" role="alert">
  <i class='bx bx-check-circle'></i> <?php echo $sucMSG; ?>
</div>
<?php } ?>
                
              <div class="card recent-sales overflow-auto">


                <div class="card-body pt-3">

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="بحث" id="live-search-box" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class='bx bx-search' ></i></button>
</div>

<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
    
      <th scope="col">الإسم</th>
      <th scope="col">الإيميل</th>
      <th scope="col">التلفون</th>
      <th scope="col">الصلاحية</th>
      <th scope="col">الحالة</th>
    </tr>
  </thead>
  <?php if(e($num_rows2) > 0) { ?>
  <tbody id="live-search-list">
  <?php while($row2 = $query2->fetchObject()) { ?>
    <tr style="text-align: center; vertical-align: middle;">
      <!--<td><img src="profiles/<?php if($row2->pics == "") { echo 'auser.png'; } else { echo e($row2->pics); } ?>" style="height:40px;" alt="Profile" class="rounded-circle"></td>-->
      <td><?php echo e($row2->fName).e($row2->lName); ?></td>
      <td><?php echo e($row2->email); ?></td>
         <td><?php echo e($row2->phone); ?></td>
      <td>
          <?php 
          if(e($row2->role ==1)){
          
               echo "مدير";
          }else if(e($row2->role ==2)){
              echo "موارد بشرية";
          }else if(e($row2->role ==3)){
              echo "مخزون";
          }
          
          ?>
          
      </td>
      <td><?php if(e($row2->active) == 0) { ?>
      <a type="button" href="?accept=<?php echo e($row2->aID); ?>" onclick="return confirm('هل تريد تفعيل الحساب ؟')" class="btn btn-danger btn-sm">موقوف</a>
      <?php } else if(e($row2->active) == 1) {  ?>
  <a type="button" href="?reject=<?php echo e($row2->aID); ?>" onclick="return confirm('هل تريد إيقاف الحساب ؟')" class="btn btn-success btn-sm">مفعل</a>
  <?php } ?>
    </td>
    <td>
        
      <a type="button"  class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $row2->aID;?>">تعديل</a>
      
      
      
    </td>
    </tr>
<!----------------------------------------------------------------------------------------------------------->

      <div class="modal fade" id="EditModal<?php echo $row2->aID;?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">تعديل</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <form method="post" enctype="multipart/form-data">
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> الإسم </label>
      <input type="text" name="editName" class="form-control" value="<?php echo e($row2->fName)."".e($row2->lName); ?>" placeholder="عب دالله محمد" requierd>
      <input type="hidden" name="admID" value ="<?php echo $row2->aID;?>" >
	  </div>
	  <?php
	  $queryB = $db->prepare("SELECT * FROM EmpUserRoles");
                             $queryB->execute();
                             //$role=$queryB->fetchObject();
                             $num_rowsB = $queryB->rowCount();
         
         
                              if($num_rowsB > 0)
                               {?>
                               
                               <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">الصلاحية </label > 
                                &nbsp;&nbsp;
                                <select class="form-control" name="editRole">
                                    
                               </div>
                                 
                                 <?php
                                  while($rowB = $queryB->fetchObject()){
                           ?>
             
                 
                               <option value="<?php echo e($rowB ->rolID);?>" 
                               <?php if(e($rowB->rolID ==$row2->role)){echo 'selected';}?>
                               
                               
                               >
                                   
                                   
                                   
                                   
                                   <?php 
                                  
                                   if(e($rowB->rolID ==1)){
          
                                        echo "مدير";
                                    }else if(e($rowB->rolID ==2)){
                                        echo "موارد بشرية";
                                    }else if(e($rowB->rolID ==3)){
                                        echo "مخزون";
                                         }
          
          
                                   ?>
                              </option>
                              
                          
                           <?php  }}?>
                           </select>
                           
    
	  
	  
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">التلفون </label>
      <input type="phone" name="editPhone" class="form-control" placeholder="05xxxxxxxx" value ="<?php echo $row2->phone;?>" requierd>
	  </div>
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> البريد الإلكتروني </label>
      <input type="email" name="editEmail" class="form-control" value ="<?php echo $row2->email;?>" placeholder="example@mail.com">
	  </div>
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> كلمة المرور </label>
      <input type="password" name="editPass" class="form-control" value="<?php echo e($row2->password); ?>" placeholder="********" requierd>
	  </div>
	  
      <div class="d-grid gap-2">
      <button class="btn btn-success btn-lg butt2" type="submit" name="btnUpdate" onclick="this.classList.toggle('button--loading')">
          <span class="button__text">حفظ</span>
      </button>
      </div>
	  </form>
                      
                    </div>
                  </div>
                </div>
    </div><!-- End Basic Modal-->
    /////////////////////////////////////////////////////////////////////////////////////////

<?php } ?>
  </tbody>
  <?php } else { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>لا توجد حسابات</strong> 
    </div>
 <?php } ?>
</table>
</div>
               

                </div>

              </div>
            </div><!-- End Recent Sales -->

          
          </div>
       
    </section>

  </main><!-- End #main -->
  
  
  
      <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">إضافة مدير</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <form method="post" enctype="multipart/form-data">
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> الإسم </label>
      <input type="text" name="aName" class="form-control" value="<?php echo e($aName); ?>" placeholder="عبدالله محمد">
	  </div>
	  <?php
	  $queryB = $db->prepare("SELECT * FROM EmpUserRoles");
                             $queryB->execute();
                             $num_rowsB = $queryB->rowCount();
         
         
                              if($num_rowsB > 0)
                               {?>
                               
                               <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">الصلاحية </label > 
                                &nbsp;&nbsp;
                                <select class="form-control" name="role">
                                    
                               </div>
                                 
                                 <?php
                                  while($rowB = $queryB->fetchObject()){
                           ?>
             
                 
                               <option value="<?php echo e($rowB ->rolID);?>">
                                   <?php 
                                  
                                    
                                   if(e($rowB->rolID ==1)){
          
                                        echo "مدير";
                                    }else if(e($rowB->rolID ==2)){
                                        echo "موارد بشرية";
                                    }else if(e($rowB->rolID ==3)){
                                        echo "مخزون";
                                         }
          
          
                                   ?>
                              </option>
                              
                          
                           <?php  }}?>
                           </select>
                           
    
	  
	  
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">التلفون </label>
      <input type="phone" name="aPhone" class="form-control" placeholder="05xxxxxxxx">
	  </div>
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> البريد الإلكتروني </label>
      <input type="email" name="aEmail" class="form-control" value="<?php echo e($aEmail); ?>" placeholder="example@mail.com">
	  </div>
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> كلمة المرور </label>
      <input type="password" name="aPassword" class="form-control" value="<?php echo e($password); ?>" placeholder="********">
	  </div>
	  <!--
	  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"> الصورة الشخصية </label>
      <input type="file" name="file" class="form-control">
	  </div>-->
      <div class="d-grid gap-2">
      <button class="btn btn-success btn-lg butt2" type="submit" name="add_account" onclick="this.classList.toggle('button--loading')">
          <span class="button__text">حفظ</span>
      </button>
      </div>
	  </form>
                      
                    </div>
                  </div>
                </div>
    </div><!-- End Basic Modal-->
    
 <?php require_once 'footer.php'; ?>
 