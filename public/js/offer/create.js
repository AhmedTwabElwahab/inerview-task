let add_row                 = $('a[id=ADD_ROW]');
let product_id              = $('select[id=product_id_input]');
let value                   = $('input[id=value_input]');
let min_quantity_input      = $('input[id=min_quantity_input]');
let type_id                 = $('select[id=type_id_input]');
let Table                   = $('table[id=offers]');


let products              = $('input[id=product_id_input]');

$(document).ready(function()
{
    /**
     * Add product row in offer table.
     */
    add_row.on('click',function ()
    {
        Table.find('tbody').append(
            "<tr><td><input type='hidden' name='product_id[]' value='" + product_id.val() + "'  readonly>"+product_id.find('option:selected').text()+"</td>"+
            "<td><input type='hidden' name='discount_value[]' value='" + value.val() + "'  readonly>"+value.val()+"</td>"+
            "<td><input type='hidden' name='min_order_value[]' value='" + min_quantity_input.val() + "'  readonly>"+min_quantity_input.val()+"</td>"+
            "<td><input type='hidden' name='discount_type_id[]' value='" + type_id.val() + "'  readonly>"+type_id.find('option:selected').text()+"</td>"+
            "<td><button  id='remove_row' type=\"button\"  style=\"color: red\" class='btn p-0'><i class='fa fa-trash'></i></button></td></tr>"
        );

    });

    /**
     * remove row in table Cart
     */
    Table.on('click','tbody tr td button#remove_row',function ()
    {
        $(this).parents('tr').remove();
    });
});
