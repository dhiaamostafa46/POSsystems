<?php

ini_set("display_errors", 0);
ob_start();
session_start();
session_regenerate_id();
require_once 'dbconnect.php';
$error = false;
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

$query8 = $db->prepare("SELECT Receipts.*,orders.dat,orders.tim,orders.oBranch FROM Receipts inner join orders on orders.oID = Receipts.oID WHERE resta = :resta and Receipts.Status > 0");
$query8->execute(['resta' => $resta_id]);
$num_rows8 = $query8->rowCount();



if(isset($_GET['cancel']))
  {
    
    $recid = filter_var($_GET['cancel'], FILTER_SANITIZE_NUMBER_INT);
    $query4 = $db->prepare("UPDATE Receipts SET Status = 0 WHERE recID = :recid");
    $query4->execute(['recid' => $recid]);
    
    ////////////update apart /////////////////////
   
    
    /////////////////////////////////////////////
 
  if ($query4) {
    $errTyp = "success";
    $sucMSG = "تم إلغاء الفاتورة بنجاح";
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
        <h1><i class='bx bx-store-alt'></i>الفواتير </h1>
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
                        
                    </div>
                    <div class="card-body pt-3">

                        <?php if (e($num_rows8) > 0) { ?>
                            <div class="row mb-2">

                                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm" width="1%">#</th>
                                            <th class="th-sm">الفرع</th>
                                            <th class="th-sm">رقم الفاتورة</th>
                                            <th class="th-sm">رقم الطلب</th>
                                            <th class="th-sm">المبلغ قبل الضريبة</th>
                                            <th class="th-sm">قيمة الضريبة</th>
                                            <th class="th-sm">الإجمالي</th>
                                            <th class="th-sm">التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody id="noti_number">
                                        <?php while ($row8 = $query8->fetchObject()) {
                                            
                                            $getBran = $db->prepare("SELECT * FROM branch WHERE hex = :hex");
                                            $getBran->execute(['hex' => e($row8->oBranch)]);
                                            $bracnro2 = $getBran->rowCount();
                                            $branRow = $getBran->fetchObject();
                                        ?>
                                            <tr>


                                                <td>
                                                    <?php echo e($row8->recID); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($branRow->branchAr); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->oID); ?>
                                                </td>
                                                <td>
                                                     <?php echo e($row8->oNo); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->amount); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->vat); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->amountVat); ?>
                                                </td>
                                                <td>
                                                    <?php echo e($row8->dat)."-".e($row8->tim); ?>
                                                </td>
                                                <td>
                                                    <a href="View?oID=<?=e($row8->oID);?>" class="btn btn-primary"  >التفاصيل</a>
                                                </td>
                                                  <!--<td>
                                                    <a href="?cancel=<?=e($row8->recID);?>" class="btn btn-danger"  >إلغاء</a>
                                                </td>-->
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
                                <i class="fas fa-exclamation-triangle"></i>&nbsp; <strong>لا توجد مشتريات</strong>
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
                        <label class="form-label">المورد :</label>
                        <select name="supplier" class="form-select">
                            <?php
                            $q = $db->prepare("SELECT * FROM Suppliers WHERE resta = :resta");
                            $q->execute(['resta' => e($row->resta)]);
                            while ($option = $q->fetchObject()) { ?>
                                <option <?php echo ($row8->unit == $option->id ? 'selected' : ''); ?> value="<?= $option->subID; ?>"><?= $option->name; ?></option>
                            <?php } ?>
                        </select>
                        <label class="form-label">رقم الفاتورة :</label>
                        <input type="text" class="form-control mb-3" name="invoice_no">

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