var table = window.LaravelDataTables["dataTableBuilder"].on( 'page.dt', function () {
    $('html, body').animate({
        scrollTop: $(".dataTables_wrapper").offset().top - 58
    }, 100);
} ).on('init.dt', function (e, settings) {
    $(".dataTables_wrapper table").addClass("d-hid");
} );

$('#topbar-search').on('search', function () {
    table.search($(this).val()).draw();    
});

$( '#topbar-entry' ).select2( {
    theme: "bootstrap-5",
    minimumResultsForSearch: -1,
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' )
} ).on('select2:select', function (e) {
    table.page.len(this.value).draw();
});

$('#topbar-entry').val(table.page.len(this.value)).trigger('change');
$('#topbar-search').val(table.search());

$("#student_id").select2( {
    dropdownParent: $('#addDialog'),
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    ajax: {         
        delay: 250,
        dataType: 'json'
    }
} ).on('change', clearErrorValidationUI).on('select2:select', function (e) {
    var data = e.params.data;
    $("#"+$(this).attr('id')).prev().val(data.text);
});

$("input").inputmask({placeholder: "", clearMaskOnLostFocus: true, clearIncomplete: true }).on('change', clearErrorValidationUI);

var modalFormAdd = new bootstrap.Modal('#addDialog');

function resetFormLevel() {
    $("#errorAddDialog").text("");
    $('#formAdd').trigger("reset");  
    $('#student_id').val(null).trigger('change');   
}

document.getElementById('addDialog').addEventListener('hide.bs.modal', event => {
    resetFormLevel();
})

document.getElementById('addDialog').addEventListener('show.bs.modal', event => {
    var method = $(event.relatedTarget).data('method');
    var route = $(event.relatedTarget).data('route');
    var data = $(event.relatedTarget).data('item');
    var student = $(event.relatedTarget).data('student');
    
    $('#formAdd').data("method", method);
    $('#formAdd').data("route", route);

    // binding data from json to form by key
    $.each(data, function(key, value) {
        $('#formAdd').find("[name='" + key + "']").val(value);
    });

    $('#check_date').val(data.check_date.text);

    $('#student_id').select2("trigger", "select", {
        data: {id: data.student_id, text: student}
    });

})

$('#formAdd').on("submit", function(e) {
    e.preventDefault();

    var method = $(this).data('method');
    var route = $(this).data('route');

    var formData = $(this).serializeArray().reduce(function(a, x) { a[x.name] = x.value; return a; }, {}); 

    $.ajax({
        url: route,
        type: method,
        data: formData,
        success: function(result) {
            if(!result.success) {
                $("#errorAddDialog").text(result.message);
            }else{
                table.ajax.reload();       
                modalFormAdd.hide();
            }
        }, error: function(e) {
            $("#errorAddDialog").text(e.responseJSON.message);
        }
    });
    
    return false; 
});

onDeleted = function(data) {
    table.ajax.reload(); 
}
  