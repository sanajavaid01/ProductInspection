
 //////////////////////////////////Inpection functions///////////////
    // Loads datatble for inspection table
    function InspectionDatatable()
    {
            var table = $('#inspectionTable').DataTable({
            processing: true,
            serverSide: true,
            bFilter: false,
            bInfo: false,
            ajax: "/datatable/inspection",
            columns: [
                {data: 'heading', name: 'heading'},
                {data: 'substeps', name: 'substeps'},
                {data: 'edit', name: 'edit',orderable: false, searchable: false},
                {data: 'delete', name: 'delete', orderable: false, searchable: false},
            ]
        });
    }
    
    //reloads inspection datatable
    function ReloadInspectionDatatable()
    {
        $('#inspectionTable').dataTable().fnDestroy();
                InspectionDatatable();
    }
    
    
    //add inspection section
         function addInspectionSection()
         {
             $('#inspection-section').hide();
             $('#add-inspection-section').find('form')[0].reset();
             $('#add-inspection-section').show();
         }
        
    
         function showInpectionSection()
         {
            $('#inspection-section').show();
            $('#add-inspection-section').hide();
         }
         
    //add inspection function
    function addInspection()
    {
        var CSRF_TOKEN = "{{csrf_token()}}";
        var heading=$('#heading').val();
        if(heading == null || heading == ''  || heading==undefined)
        {
            Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Heading should not be empty.',
                    });
    
        }
        else
        {
            $.ajax({
            url: '/addInspection',
            type: 'POST',
            data: { heading:heading,_token :CSRF_TOKEN} ,
            success: function (response) {
               if(response.status===true)
               {
                showInpectionSection();
                ReloadInspectionDatatable();
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
    // opening edit inspection modal
    function editInspection(id,heading)
    {
         $('#heading1').val(heading);
         $('#inspection_id').val(id);
         $('#editInspectionModal').modal('show'); 
    }
      
    //ajax for updating ispection details
    function editInspectionDetails()
    {
        var heading=$('#heading1').val();
        var id=$('#inspection_id').val();
        var CSRF_TOKEN = "{{csrf_token()}}";
        if(heading == null || heading == ''  || heading==undefined)
        {
            Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Heading should not be empty.',
                    });
    
        }
        else
        {
            $.ajax({
            url: '/updateInspection',
            type: 'POST',
            data: { id:id,heading:heading,_token :CSRF_TOKEN} ,
            success: function (response) {
               if(response.status===true)
               {
                ReloadInspectionDatatable()
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
    
    // ajax for deleteing inspection detail
    function deleteInspection(id)
    {
            var CSRF_TOKEN = "{{csrf_token()}}";
        $.ajax({
            url: '/deleteInspection',
            type: 'delete',
            data: { id:id,_token :CSRF_TOKEN} ,
            success: function (response) {
               if(response.status===true)
               {
                ReloadInspectionDatatable()
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


    