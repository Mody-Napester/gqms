$(document).ready(function(){
    // Default Datatable
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf']
    });

    // Key Tables

    $('#key-table').DataTable({
        keys: true
    });

    // Responsive Datatable
    $('#responsive-datatable').DataTable();

    // Multi Selection Datatable
    $('#selection-datatable').DataTable({
        select: {
            style: 'multi'
        }
    });

    table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $('form').parsley();

    // Select2
    $(".select2").select2();

    $('body').on('click', '.select-all', function () {
        var target = $(this).attr('data-select2-target');
        $("#"+target+" > option").prop("selected",true);
        $("#"+target).select2();
    });

    $('body').on('click', '.de-select-all', function () {
        var target = $(this).attr('data-select2-target');
        $("#"+target+" > option").prop("selected",false);
        $("#"+target).select2();
    });

    // General Update
    $('body').on('click', '.update-modal', function (event) {
        event.preventDefault();
        var url, targetModal;
        url = $(this).attr('href');
        targetModal = $('#update-modal');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#editModalLabel').text(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {
                
            }
        });

        // Show modal
        targetModal.modal();
    });

    // General Update
    $('body').on('click', '.history-modal', function (event) {
        event.preventDefault();
        var url, targetModal;
        url = $(this).attr('href');
        targetModal = $('#deskQueueHistoryModal');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#deskQueueHistoryModalLabel').text(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {

            }
        });

        // Show modal
        targetModal.modal();
    });

    // General Confirm Delete
    $('body').on('click', ".confirm-delete", function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        $('#confirm-delete-form').attr('action', link);
        $("#confirm_delete_modal").modal({backdrop: true});
    });

});