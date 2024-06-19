 <!-- ======= Footer ======= -->
 <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header text-white" style="background: #ffb03b;">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-bag"></i> السلة </h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <span id="cart_details"></span>
   
  </div>
</div>
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Evix</span></strong>. All Rights Reserved
    </div>
 
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/table2excel.js" type="text/javascript"></script>
  <script src="assets/js/saveAsExcel.js" type="text/javascript"></script>
  <script src="assets/js/qrcode.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script>
    jQuery(document).ready(function($){

$('#live-search-list tr').each(function(){
$(this).attr('data-search-term', $(this).text().toLowerCase());
});

$('#live-search-box').on('keyup', function(){

var searchTerm = $(this).val().toLowerCase();

    $('#live-search-list tr').each(function(){

        if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
            $(this).show();
        } else {
            $(this).hide();
        }

    });

});

});

  function getState(val) {
              $.ajax({
              type: "POST",
              url: "ArAjax.php",
              data:'CounId='+val,
              success: function(data){
                $("#city").html(data);
              }
              });
            }
</script>

<script>
function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Table.xls"
            });
        }
    </script>
    
    <script>  
$(document).ready(function(){

	load_product();

	load_cart_data();
    
	function load_product()
	{
		$.ajax({
			url:"fetch_item.php",
			method:"POST",
			success:function(data)
			{
				$('#display_item').html(data);
			}
		});
	}

	function load_cart_data()
	{
		$.ajax({
			url:"fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge2').text(data.total_item);
			}
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add_to_cart', function(){

		/////////////
		var checks = $('input[type="checkbox"]:checked').map(function() {
    return $(this).val();
  }).get()
  console.log(checks);
  //alert(checks);

		/////////////
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
        //var product_deti = $('#deti'+product_id).val();
		let text = "";
		checks.forEach(myFunction);
		function myFunction(item, index) 
		{
            text += " + " + item; 
          }
        var product_deti =text;
        var product_section = $('#section'+product_id).val();
        var product_resta = $('#resta'+product_id).val();
        var product_branch = $('#branch'+product_id).val();
		//var adds = checks;
        
        

		var action = "add";
		if(product_quantity > 0)
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, product_deti:product_deti, product_section:product_section, product_resta:product_resta, product_branch:product_branch, action:action},
				success:function(data)
				{
					load_cart_data();
          Swal.fire({
  position: 'center',
  icon: 'success',
  title: '<?php echo $wishlist[$language]['6']?>',
  showConfirmButton: false,
  timer: 1000
});
				}
			});
		}
		else
		{
      Swal.fire({
  position: 'center',
  icon: 'warning',
  title: '<?php echo $wishlist[$language]['7']?>',
  showConfirmButton: false,
  timer: 1000
});
		}
	});


  
	$(document).on('click', '.delete', function(){
		var product_id = $(this).attr("id");
		var action = 'remove';
		if(confirm("هل تريد مسح هذا المنتج من السلة ؟"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function()
				{
					load_cart_data();
					$('#cart-popover').popover('hide');
          Swal.fire({
  position: 'center',
  icon: 'success',
  title: '<?php echo $wishlist[$language]['8']?>',
  showConfirmButton: false,
  timer: 1000
});
				}
			})
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
					swal({
                    title: "تم مسح جميع المنتجات من السلة",
                    icon: "success",
                    button: "حسناُ",
                    });
			}
		});
	});
	
		$(document).on('click', '.wish', function(){
		var product_id = $(this).attr("id");
		var action = 'addwish';
	
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function()
				{
				    load_cart_data();
				$('#cart-popover').popover('hide');
        Swal.fire({
  position: 'center',
  icon: 'success',
  title: '<?php echo $wishlist[$language]['5']?>',
  showConfirmButton: false,
  timer: 1000
});
		     
				}
			})
	
	});
    
});

</script>



</body>

</html>