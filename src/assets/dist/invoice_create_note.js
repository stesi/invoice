$("#invoice_form_organization_to_id").on("change",function(e) {

    var organization_id = $("#invoice_form_organization_to_id").val();
    var date= $.datepicker.formatDate('yy/mm/dd', new Date());

    $.ajax({
        url : "/notes/invoice/automatic-note",
        type : "POST",
        data : {
            organization_id: organization_id,
            date: date

        },
        success : function(data) {
            var note=data.auto_note;
            $("#invoice-note").val(note);
        },
        error: function(xhr, textStatus, errorThrown){
            alert('bad url')
        }
    });
});