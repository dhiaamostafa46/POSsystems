<?php

ini_set("display_errors", 0);
ob_start();
session_start();
session_regenerate_id();
require_once 'dbconnect.php';
$error = false;
date_default_timezone_set("Asia/Riyadh");
$dat = filter_var(date('Y-m-d'), FILTER_SANITIZE_STRING);
$tim = filter_var(date('H:i:s'), FILTER_SANITIZE_STRING);
$title = "فواتير المبيعات";
if (isset($_SESSION['user'])) {
    $user = filter_var($_SESSION['user'], FILTER_SANITIZE_STRING);
    $query = $db->prepare("SELECT * FROM admin WHERE token = :user");
    $query->execute(['user' => $user,]);
    $num_rows = $query->rowCount();
    $row = $query->fetchObject();
    if ($num_rows == 0 || $_SESSION['role'] !=1) {
        header("Location: logout?logout");
    }
} else {
    header("Location: index");
}

$quer2 = $db->prepare("SELECT * FROM resta WHERE resta = :resta");
$quer2->execute(['resta' => e($row->resta)]);
$num_ro2 = $quer2->rowCount();
$ro2 = $quer2->fetchObject();
$resta_id = $row->resta;
if ($num_ro2 == 0) {
    header("Location: add");
}

$query8 = $db->prepare("SELECT * FROM SalesInvoices WHERE resta = :resta ");
$query8->execute(['resta' => $resta_id]);
$num_rows8 = $query8->rowCount();



if (isset($_POST['add_purchase'])) {
      
      
      


    $resta = filter_var($_POST['resta'], FILTER_SANITIZE_STRING);
    $client = filter_var($_POST['client'], FILTER_SANITIZE_STRING);
    $invoice_no = filter_var($_POST['invoice_no'], FILTER_SANITIZE_STRING);
    $payType = filter_var($_POST['paytype'], FILTER_SANITIZE_STRING);
     $paid =0;
     if($payType ==1)
     {
         $paid=1;
     }
     
    // arrays
    $purchase_type = $_POST['purchase_type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $total_price = 0;
    foreach ($price as $value) {
        $total_price += $value;
    }


    if (empty($client)) {
        $error = true;
        $errMSG = "الرجاء اختيار المورد";
    } else if (empty($invoice_no)) {
        $error = true;
        $errMSG = "الرجاء كتابة رقم الفاتورة";
    } else if (empty($total_price)) {
        $error = true;
        $errMSG = "الرجاء كتابة السعر";
    } else if (count($purchase_type) < 1) {
        $error = true;
        $errMSG = "الرجاء كتابة بيانات مشترى واحد على الأقل";
    } else if (count($quantity) < 1) {
        $error = true;
        $errMSG = "الرجاء كتابة بيانات مشترى واحد على الأقل";
    } else if (count($price) < 1) {
        $error = true;
        $errMSG = "الرجاء كتابة بيانات مشترى واحد على الأقل";
    }

    if (!$error) {
              
              


        $sql3 = $db->prepare("INSERT INTO `SalesInvoices`(`clientID`, `resta`, `invNo`, `fullAmount`, `dat`,'tim', `isPaid`, `payType`) VALUES(:client,:resta,:invoice_no, :price,:dat,:tim,:paid,:paytype)");
        $sql3->execute(['client'=>$client,'resta' => $resta, 'invoice_no' => $invoice_no, 'price' => $total_price, 'dat' => $dat,'tim'=>$tim,'paid'=>$paid,'paytype'=>$payType]);
        if ($sql3) {
            $invid = $db->lastInsertId();
            $done = false;
            foreach ($purchase_type as $i => $value) {
                $sql44 = $db->prepare("INSERT INTO SalesInvoicesDetails(invID,itemID,quantity, price) VALUES(:id, :item, :quantity, :price)");
                $sql44->execute(['invID' => $invid, 'item' => $purchase_type[$i], 'quantity' => $quantity[$i], 'price' => $price[$i]]);

                if ($sql44) {
                    $done = true;
                } else {
                    $done = false;
                }

                $stk_q= $db->prepare("SELECT itemID,itemQuantity FROM purStock WHERE itemID = :itemID LIMIT 1");
                $stk_q->execute(['itemID' => $purchase_type[$i]]);
                $stk_rows = $stk_q->rowCount();
                if ($stk_rows > 0) {
                    $oldQty = $stk_q->fetchObject();
                    $sql55 = $db->prepare("UPDATE purStock SET itemQuantity = :itemQuantity WHERE itemID = :itemID");
                    $sql55->execute([ 'itemQuantity' => floatval($oldQty->itemQuantity) - floatval($quantity[$i]), 'itemID' => $purchase_type[$i]]);
                    if(!$sql55){$done = false;}
                }
                else{
                    $sql66 = $db->prepare("INSERT INTO purStock(resta,itemID,itemQuantity, unitID) VALUES(:resta, :itemID, :itemQuantity, :unitID)");
                    $sql66->execute(['resta' => $resta_id, 'itemID' => $purchase_type[$i], 'itemQuantity' => $quantity[$i], 'unitID' => '0']);
                    if(!$sql66){$done = false;}
                }
                // print_r($sql44);
            
            }
            
              ////////////////////////////update subbliers balance/////////////////////////////////
                if(isset($_POST['paytype']) && ($_POST['paytype'] == 2 ))
      {
          echo "<script>alert('".$_POST['paytype'].$supplier."')</script>";
          
          $balance = $total_price;
          
          $getBalQuery = $db->prepare("SELECT * FROM sublierBalance where subID= :subid");
          $getBalQuery->execute(['subid' => $supplier]);
          $count = $getBalQuery->rowCount();
         
          $rowBal = $getBalQuery->fetchObject();
          if($count > 0)
          {
              echo "<script>alert('".$count."')</script>";
               //$balance = $rowBal->balance + $total_price;
               $updateBalQuery = $db->prepare("update sublierBalance SET balance = balance + :bal where subID =:subid");
               $updateBalQuery->execute(['bal' => $balance,'subid' => $supplier]);
               if(!$updateBalQuery){$done = false;}
          }else{
               echo "<script>alert('".$balance."')</script>";
           $balQuery = $db->prepare("INSERT INTO sublierBalance (subID,balance) VALUES(:subid, :bal)");
           $balQuery->execute(['subid' => $supplier, 'bal' => $balance]);
            if(!$balQuery){$done = false;}
          }
          
      }
              
              /////////////////////////////////////////////////////////////
            if ($done) {
                $errTyp = "success";
                $sucMSG = "تمت إضافة الفاتورة";
                header("refresh:2;SalesInvo");
            } else {
                $errTyp = "danger";
                $errMSG = "حدث خطاء";
            }
        }
    }
}


// if (isset($_POST['update_purchase_type'])) {
//     $type_id = filter_var($_POST['type_id'], FILTER_SANITIZE_STRING);
//     $purchase_type = filter_var($_POST['purchase_type'], FILTER_SANITIZE_STRING);
//     $purchase_type = filter_var($_POST['purchase_type'], FILTER_SANITIZE_STRING);


//     if (empty($purchase_type)) {
//         $error = true;
//         $errMSG = "الرجاء كتابة اسم المشترى";
//     } else if (empty($purchase_type)) {
//         $error = true;
//         $errMSG = "الرجاء اختيار الوحدة";
//     }

//     if (!$error) {

//         $sql3 = $db->prepare("UPDATE PurchasesTypes SET purchase_type = :purchase_type, unit = :unit WHERE id = :id");
//         $sql3->execute(['purchase_type' => $purchase_type, 'id' => $type_id, 'unit' => $purchase_type]);

//         if ($sql3) {
//             $errTyp = "success";
//             $sucMSG = "تمت تعديل المشترى بنجاح";
//             header("refresh:2;purchasesTypes");
//         } else {
//             $errTyp = "danger";
//             $errMSG = "حدث خطاء";
//         }
//     }
// }


// if (isset($_GET['delete_type'])) {
//     $delete_type = filter_var($_GET['delete_type'], FILTER_SANITIZE_NUMBER_INT);
//     $query123 = $db->prepare("DELETE FROM PurchasesTypes WHERE id = :id");
//     $query123->execute(['id' => $delete_type]);

//     if ($query123) {
//         $errTyp = "success";
//         $sucMSG = "تم مسح المشترى بنجاح";
//         header("refresh:2;purchasesTypes");
//     } else {
//         $errTyp = "danger";
//         $errMSG = "حدث خطاء";
//     }
// }

?>

<?php require_once 'header.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1><i class='bx bx-store-alt'></i> فواتير المبيعات </h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <div class="row">
            <div class="col-12">
                <?php if (isset($errMSG) && $errMSG != "") { ?>
                    <div class="alert alert-danger" role="alert">
                        <i class='bx bx-x-circle'></i> <?php echo $errMSG; ?>
                    </div>
                <?php } else if (isset($sucMSG) && $sucMSG != "") { ?>
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: '<?php echo $sucMSG; ?>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    </script>
                <?php } ?>

                <div class="card recent-sales overflow-auto">
                    <div class="card-header py-2">
                        <h5 class="card-title m-0">فواتير المبيعات
                            <a class="btn btn-primary float-end m-0" type="button" onclick="showAdd()" title="إضإفة فاتورة شراء"><i class='bx bx-plus-medical'></i></a>
                        </h5>
                    </div>
                    <div class="card-body pt-3">

                        <?php if (e($num_rows8) > 0) { ?>
                            <div class="row mb-2">

                                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm" width="1%">#</th>
                                            <th class="th-sm">رقم الفاتورة</th>
                                            <th class="th-sm">المورد</th>
                                            <th class="th-sm">السعر</th>
                                            <th class="th-sm">التاريخ</th>
                                            <th class="th-sm">خيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="noti_number">
                                        <?php while ($row8 = $query8->fetchObject()) {
                                        ?>
                                            <tr>

                                                <td>
                                                    <?php echo e($row8->id); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->invoice_no); ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $queryS = $db->prepare("SELECT name FROM Suppliers WHERE subID = :id LIMIT 1 ");
                                                    $queryS->execute(['id' => $row8->supplier]);
                                                    $supplier = $queryS->fetchObject();
                                                    echo $supplier->name;
                                                    ?>
                                                    <!-- <?php echo e($row8->supplier); ?> -->
                                                </td>
                                                <td>
                                                    <?php echo e($row8->price); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->created_at); ?>
                                                </td>
                                                <td>
                                                    <a href="https://waiterq.com/dashboard/purchaseDetails?purchase_id=<?=e($row8->id);?>" class="btn btn-primary"  >عرض</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!-- <?php while ($row8 = $query8->fetchObject()) { ?>

                                    <div class="col-md-3">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <center>
                                                    <p class="card-text">الاسم: <?php echo e($row8->purchase_type); ?></p>
                                                    <?php
                                                    $q = $db->prepare("SELECT name FROM Units WHERE id = :id");
                                                    $q->execute(['id' => $row8->unit]);
                                                    $unit = $q->fetchObject();
                                                    ?>
                                                    <p class="card-text">الوحدة: <?php echo e($unit->name); ?></p>
                                                    <!-- <p class="card-text"><?php echo e($row8->created_at); ?></p> -->

                                                    <div class="btn-group mb-3" role="group" aria-label="Basic example" style="width:100%;">
                                                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModalq<?php echo e($row8->id); ?>" class="btn btn-outline-warning"><i class='bx bx-edit'></i></a>
                                                        <a type="button" href="?delete_type=<?php echo e($row8->id); ?>" onclick="return confirm('هل تريد مسح المشترى')" class="btn btn-outline-danger"><i class='bx bx-trash'></i></a>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="exampleModalq<?php echo e($row8->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل <?php echo e($row8->id); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">

                                                        <input type="hidden" class="form-control mb-3" name="type_id" value="<?php echo e($row8->id); ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label">إسم المشترى :</label>
                                                            <input type="text" class="form-control" name="purchase_type" value="<?php echo e($row8->purchase_type); ?>" id="exampleFormControlInput1" placeholder="سكر">
                                                            <label class="form-label">الوحدة :</label>
                                                            <select name="purchase_type" class="form-select">
                                                                <?php
                                                                $q = $db->prepare("SELECT * FROM Units WHERE resta = :resta OR resta = 0");
                                                                $q->execute(['resta' => e($row->resta)]);
                                                                while ($option = $q->fetchObject()) { ?>
                                                                    <option value="<?= $option->id; ?>"><?= $option->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <button type="submit" name="update_purchase_type" class="btn btn-primary">حفظ التعديل</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                <?php } ?> -->
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger alert-dismissible  bg-danger text-white fade show px-3" style="border:none; border-radius:0px;" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>&nbsp; <strong>لا توجد فواتير مبيعات</strong>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    </section>
</main><!-- End #main -->

<div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 90% !important; ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة مشترى</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>
    let count = 1;

    function addRow() {


        let row = `
            <div id="row_content" style="display: flex;width:100%">
            <hr>
            <b style="padding-top: 10px;">#${count}</b>
                <div style="width:100%;margin:6px;">
                    <select name="purchase_type[]" class="form-select">
                        <?php
                        $q = $db->prepare("SELECT * FROM PurchasesTypes WHERE resta = :resta");
                        $q->execute(['resta' => e($row->resta)]);
                        while ($option = $q->fetchObject()) { ?>
                            <option value="<?= $option->id; ?>"><?= $option->type_name; ?>(<?php
                             $query77 = $db->prepare("SELECT name FROM Units WHERE id = :id");
                             $query77->execute(['id' => $option->unit]);
                             $row77 = $query77->fetchObject();
                            echo $row77->name;
                            ?>)</option>
                        <?php } ?>
                    </select>
                </div>
                <div style="width:100%;margin:6px;">
                    <input type="text" class="form-control mb-3" name="quantity[]">
                </div>
                <div style="width:100%;margin:6px;">
                    <input type="text" class="form-control mb-3" name="price[]">
                </div>
            </div>
        `;
        count++;

        let newElement = document.createElement('div');
        newElement.innerHTML = row;
        document.querySelector("#purchases_group").appendChild(newElement);

    }

    function showAdd() {

        let element =
            `
        <form id="theform" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control mb-3" name="resta" value="<?php echo e($ro2->resta); ?>">
                        <label class="form-label">العميل :</label>
                        <select name="client" class="form-select">
                            <?php
                            $q = $db->prepare("SELECT * FROM clients WHERE resta = :resta");
                            $q->execute(['resta' => e($row->resta)]);
                            while ($option = $q->fetchObject()) { ?>
                                <option value="<?= $option->clientID; ?>"><?= $option->arName; ?></option>
                            <?php } ?>
                        </select>
                        <label class="form-label">رقم الفاتورة :</label>
                        <input type="text" class="form-control mb-3" name="invoice_no" requierd >
                        
                          <label class="form-label">طريقة الدفع :</label>
                        <input type="radio" value="1" name="paytype">
                        نقدا
                        <input type="radio"  value="2" name="paytype">
                        آجل
                        <!-- <label class="form-label">السعر :</label>
                        <input type="text" class="form-control mb-3" name="price"> -->

                        <div id="purchases_group" class="purchases_group">
                            <div id="row_header" style="display: flex;width:100%">
                                <div style="width:100%;margin:6px;">
                                    <label class="form-label" >الصنف :</label>
                                </div>
                                <div style="width:100%;margin:6px;">
                                    <label class="form-label">الكمية :</label>
                                </div>
                                <div style="width:100%;margin:6px;">
                                    <label class="form-label">السعر :</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addRow()"><i class='bx bx-plus-medical'></i></button>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="location.reload()">إلغاء</button>
                    <button type="submit" name="add_purchase" class="btn btn-primary">حفظ التعديل</button>
                </div>
            </form>
        `;

        document.querySelector("#main").innerHTML = element;

    }
</script>

<?php require_once 'footer.php'; ?>