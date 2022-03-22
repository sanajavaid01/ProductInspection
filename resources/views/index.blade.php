<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product inspection</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/index.css">
   
</head>
<body>

<div class="container">
   
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#inspection" onclick="InspectionTab()">Inspection</a></li>
        <li><a data-toggle="tab" href="#product" onclick="ProductTab()">Product</a></li>
    </ul>
    <div class="tab-content">
        <div id="inspection" class="tab-pane fade in active">
            <br>
            @include('inspection-tab')
        </div>
        <div id="product" class="tab-pane fade">
        <br>
            @include('product-tab')
        </div>
    </div>
</div>
</body>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap4.min.js"></script>
<script src="js/sweetalert2@11.js"></script>
<script src="js/inspection.js"></script>
<script src="js/product.js"></script>
<script src="js/substep.js"></script>
<script>
    var CSRF_TOKEN = "{{csrf_token()}}";
    function ProductTab()
    {
        $('#product-section').show();
        $('#add-product-section').hide();
        $('#assign-step-section').hide();
        
    }
 
 
   


$(document).ready(function() {
InspectionDatatable();
ProductDatatable();
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$('#add-product-form').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
     
       $.ajax({
        url: '/addProduct',
        type: 'POST',
        data: formData ,
        contentType: false,
        cache: false,
        processData: false,
        

  success: function (response) {
           if(response.status===true)
           {
            showProductSection();
            ReloadProductDatatable();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.msg,
                })
           }
           else if(response.status===false)
           {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.msg,
                })
           }
        },
        error: function () {
        console.log(response);
        }
        });
  });

  $('#edit-product-form').submit(function(e) {
       e.preventDefault();
       let formData = new FormData(this);
       var prev_file_name=$('#update_p_file').val();
       console.log($('#p_image').prop('files')[0],$('#p_image').val());
       if($('#p_image').val()==="" ||$('#p_image').val()==='undefined' )
       {
        formData.delete('p_image');
       }
     
       $.ajax({
        url: '/updateProduct',
        type: 'POST',
        data: formData ,
        contentType: false,
        cache: false,
        processData: false,
        

  success: function (response) {
           if(response.status===true)
           {
            
            ReloadProductDatatable();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.msg,
                })
           }
           else if(response.status===false)
           {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.msg,
                })
           }
        },
        error: function () {
        console.log(response);
        }
        });
  });

});
</script>


</html>
