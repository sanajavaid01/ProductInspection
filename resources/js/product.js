  //////////////////////////////////////////// /////Products functions

       // Loads datatble for product table
function ProductDatatable()
{
        var table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        bInfo: false,
        ajax: "/datatable/product",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'assign_inspection', name: 'assign_inspection'},
            {data: 'edit', name: 'edit',orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
        ]
    });
}

//reloads inspection datatable
function ReloadProductDatatable()
{
    $('#productTable').dataTable().fnDestroy();
    ProductDatatable();
}
//add product section
function addProductSection()
{
         $('#product-section').hide();
         $('#add-product-section').show();
}
    

function showProductSection()
{
        $('#product-section').show();
        $('#add-product-section').hide();
}


//add product function
function addProduct()
{
    var CSRF_TOKEN = "{{csrf_token()}}";
    var name=$('#name').val();
    var sku_code=$('#sku_code').val();
    var image=$('#image').val();
    if(name == null || name == ''  || name==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Name should not be empty.',
                });

    }
    if(sku_code == null || sku_code == ''  || sku_code==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Sku Code  should not be empty.',
                });

    }
     else if(image == null || image == ''  || image==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Image is required.',
                });

	        
        
    
    }
    else
    {
        var cimg=$('#image').val();
        var ext=cimg.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Image should only contain gif,png,jpg,jpeg extension.',
                });

	        }
            else
            {
            
               
        $.ajax({
        url: '/addProduct',
        type: 'POST',
        data: { name:name,image:file,sku_code:sku_code,_token:CSRF_TOKEN} ,
        dataType:'text',
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
            }
        
    }   
}
// opening edit product modal
function editProduct(id,name)
{
     $('#product_name').val(name);
     $('#product_id').val(id);
     $('#editProductModal').modal('show'); 
}
  
//ajax for updating product details
function editProductDetails()
{
    var name=$('#product_name').val();
    var id=$('#product_id').val();
    var CSRF_TOKEN = "{{csrf_token()}}";
    if(name == null || name == ''  || name==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Product Name should not be empty.',
                });

    }
    else
    {
        $.ajax({
        url: '/updateProduct',
        type: 'POST',
        data: { id:id,name:name,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            ReloadProductDatatable()
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
    }
    
}

// ajax for deleteing product detail
function deleteProduct(id)
{
        var CSRF_TOKEN = "{{csrf_token()}}";
    $.ajax({
        url: '/deleteProduct',
        type: 'delete',
        data: { id:id,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            ReloadProductDatatable()
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
}

 