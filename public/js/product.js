function ProductTab()
    {
        $('#product-section').show();
        $('#add-product-section').hide();
        $('#assign-step-section').hide();
        
    }
 
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
                $('#add-product-section').find('form')[0].reset();
                $('#add-product-section').show();
       }
           
       
       function showProductSection()
       {
               $('#product-section').show();
               $('#add-product-section').hide();
              
       }
       function showProductSection1()
       {
               $('#product-section').show();
               $('#assign-step-section').hide();
              
       }
       
       
       
       // opening edit product modal
       function editProduct(id,name)
       {
          
           $.ajax({
               url: '/getProductDetail',
               type: 'post',
               data: { id:id,_token :CSRF_TOKEN} ,
               success: function (response) {
                  if(response.status===true)
                  {
                      
                     var data=response.data[0];
                     console.log(data.id); 
                     $('#update_p_id').val(data.id);
                     $('#p_sku_code').val(data.sku_code);
                     $('#p_name').val(data.name);
                     $('#p_image').removeAttr('required');
                     $('#update_p_file').val(data.image);
                     $('.file-upload-wrapper').attr('data-text',data.image);
                     
                       $('#editProductModal').modal('show');
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
         
       //ajax for updating product details
       function editProductDetails()
       {
           var name=$('#product_name').val();
           var id=$('#product_id').val();
           
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
       
       
       function assignInspectionSteps(id,name)
       {
           
           $('#product-section').hide();
           $('#assign-section-heading').text( name + " Sub Steps");
           $.ajax({
               url: '/getInspectionSubsteps',
               data:{id:id,_token :CSRF_TOKEN},
               type: 'post',
               success: function (response) {
                  if(response.status===true)
                  {var data=response.data;
                   var assign_data=response.assign_data;
                    var html="";
                   for(let i = 0; i < data.length; i++) {
                       var heading=data[i].heading;
                       html+=`<tr>
                               <th>-</th>
                               <th>${heading}</th> 
                               </tr>
                               `;
                              
                               var substeps=data[i].sub_steps;
                       for(var j = 0; j < substeps.length; j++) {
                           var sub_step_name=substeps[j].sub_step_name;
                           html+=`
                               <tr>
                               <td>${sub_step_name}</td>
                               <td><input type="checkbox" id="${substeps[j].id}" name="${substeps[j].inspection_id}" class="steps"></td> 
                               </tr>`;
                       }
                   }
                   
                   $('#p_id').val(id);
                   $('#assign-step-section').show();
                   $('#assign_step_table').text('');
                   $('#assign_step_table').append(html);
                   for(let i = 0; i < assign_data.length; i++) {
                       var steps_data=JSON.parse(assign_data[i].inspection_steps);
                       for(let j = 0; j <steps_data.length; j++) {
                          
                           $('#'+ steps_data[j]).prop("checked" ,"checked");
                       }
                   }
       
                  
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