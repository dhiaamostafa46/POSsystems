<?php 
ini_set( "display_errors", 0);
ob_start();
session_start();
session_regenerate_id();
require_once 'dbconnect.php';
$error = false;
date_default_timezone_set("Asia/Riyadh");

$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
if( isset($_SESSION['user3']) ) {
$user = filter_var($_SESSION['user3'], FILTER_SANITIZE_STRING);
$query = $db->prepare("SELECT * FROM branch WHERE token = :user");
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

  
 
//$query2 = $db->prepare("SELECT menuStock.*,menu.arName,menu.enName FROM `menuStock` INNER JOIN menu on menuStock.mID = menu.mID    where menu.resta= :rest and menuStock.hex = :oBranch and addDate= :dat");
//$query2->execute(['rest'=>e($row->resta),'oBranch' => e($row->hex),'dat'=>$dat]);
if( isset( $_GET["sdt"]) && isset($_GET["edt"])  )
       // {
        //$sdat= $_GET["sdt"];
        //$edate = $_GET["edt"];
          //echo '<script>alert("test")</script>';
$query2 = $db->prepare("SELECT menuStock.*,menu.arName,menu.enName,branch.branchAr FROM `menuStock` INNER JOIN menu on menuStock.mID = menu.mID INNER JOIN branch on menuStock.hex = branch.hex   ");
//and addDate >= :sdate and addDate <= :edate
//$query2->execute(['sdate'=>$sdat,'edate'=>$edate]);
$query2->execute();
//$query2->execute(['dat'=>$dat]);
$num_rows2 = $query2->rowCount();

//}


 ?>

<?php while($row2 = $query2->fetchObject()) { 
                        $query7 = $db->prepare("SELECT * FROM branch WHERE hex = :hex");
                        $query7->execute(['hex' => e($row->hex)]);
                        $row7 = $query7->fetchObject(); ?> 
                      <tr>
                        <th scope="row"><?php echo e($row2->branchAr); ?></th>
                        <td> 
                           <?php echo e($row2->arName); ?>
                        </td>
                        <td>
                            <?php echo e($row2->quantity); ?>
                        </td>
                        <td>
                            <?php echo e($row2->remain); ?>
                        </td>
                        <td>
                            <?php echo e($row2->quantity)- e($row2->remain); ?>
                        </td>
                        
                       
	                  
	                  
    
     
     <!-- <td><a class="btn btn-info btn-sm" type="button" href="view?hexID=<?php echo e($row2->hex); ?>">عرض</a></td>
-->     
</tr>





                      <?php } ?>
                      
                  
                 