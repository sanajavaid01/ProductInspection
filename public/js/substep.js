
function addSubStepSection()
{
         $('#sub-steps-section').hide();
         $('#add-substep-section').find('form')[0].reset();
         $('#add-substep-section').show();
}

function showSubStepSection()
{
    $('#add-substep-section').hide();
    $('#sub-steps-section').show();
}
     

  // Loads datatble for substep table
function SubStepDatatable()
{     var inspection_id= $('#f_inspection_id').val();
        var table = $('#subStepTable').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        bInfo: false,
        ajax: {
            'type': 'GET',
        'url': "/datatable/substep",
        'data': {
            inspection_id: inspection_id,
          
        }},
        columns: [
            {data: 'sub_step_name', name: 'sub_step_name'},
            {data: 'edit', name: 'edit',orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
        ]
    });
}

//reloads inspection datatable
function ReloadSubStepDatatable()
{
    $('#subStepTable').dataTable().fnDestroy();
    SubStepDatatable();
}

function subSteps(id,heading)
{
    $('#substep-heading').text(heading+' Sub Steps');
    $('#substep-button').text('New '+heading+' Sub Steps');
    $('#f_inspection_id').val(id);
    $('#inspection-section').hide();
    $('#sub-steps-section').show();
    $('#subStepTable').dataTable().fnDestroy();
    SubStepDatatable();

 
}

//add substep function
function addSubStep()
{
    
    var name=$('#sub_step_name').val();
    var inspection_id=$('#f_inspection_id').val();
   
    if(name == null || name == ''  || name==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Sub step name should not be empty.',
                });

    }
    else
    {
        $.ajax({
        url: '/addSubStep',
        type: 'POST',
        data: { sub_step_name:name,inspection_id:inspection_id,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            ReloadSubStepDatatable();
            showSubStepSection();
            
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
// opening edit sub step modal
function editSubStep(id,name)
{
     $('#sub_step_name1').val(name);
     $('#substep_id').val(id);
     $('#editSubStepModal').modal('show'); 
}
  
//ajax for updating product details
function editSubStepDetails()
{
    var name=$('#sub_step_name1').val();
    var id=$('#substep_id').val();
  
    if(name == null || name == ''  || name==undefined)
    {
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Sub Step Name should not be empty.',
                });

    }
    else
    {
        $.ajax({
        url: '/updateSubStep',
        type: 'POST',
        data: { id:id,sub_step_name:name,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            ReloadSubStepDatatable()
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

// ajax for deleteing substep detail
function deleteSubStep(id)
{
       
    $.ajax({
        url: '/deleteSubStep',
        type: 'delete',
        data: { id:id,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            ReloadSubStepDatatable()
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

function AssignStepsToProduct()
{
    var sub_step_array=[];
    var product_id=$('#p_id').val();
    $('.steps').each(function(i, obj) {
        if($( this ).is(':checked')){
            sub_step_array.push({inspection_id:this.name,step_id:this.id});
        }
    });

   
    $.ajax({
        url: '/assignStepsToProduct',
        type: 'post',
        data: { product_id:product_id,sub_step_array:sub_step_array,_token :CSRF_TOKEN} ,
        success: function (response) {
           if(response.status===true)
           {
            showProductSection1();
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
    console.log(sub_step_array);

    
}