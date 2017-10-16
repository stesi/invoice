var form_wrapper=$('.invoice-form');

form_wrapper.on("change",".invoice_row_qty",function(e) {
    getTotal($(this));
});
form_wrapper.on("change",".invoice_row_uprice",function(e) {
    getTotal($(this));
});
form_wrapper.on("change",".invoice_row_discount",function(e) {
    getTotal($(this));
});

function getTotal(elem){
    var tr = elem.closest("tr");
    $tot= 0;
    $qty= $(".invoice_row_qty",tr).val();
    $unit_price= $(".invoice_row_uprice",tr).val();
    $discount= $(".invoice_row_discount",tr).val();
    $sub_total=($qty*$unit_price)-(($qty*$unit_price)*$discount/100);
    $('.invoice_row_subtotal',tr).val($sub_total);
}
