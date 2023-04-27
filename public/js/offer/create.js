let add_row                 = $('a[id=ADD_ROW]');
let product_id              = $('select[id=product_id_input]');
let value                   = $('input[id=value_input]');
let min_quantity_input      = $('input[id=min_quantity_input]');
let type_id                 = $('select[id=type_id_input]');
let Table                   = $('table[id=offers]');


let products              = $('input[id=product_id_input]');

$(document).ready(function()
{

    function Search()
    {
        let ret = false;
        let product_name =  product_id.find('option:selected').text().toLowerCase();
        console.log(product_name);
       Table.filter(function()
        {
            if ($(this).text().toLowerCase().indexOf(product_name) > -1)
            {
                // let td_Quantity = Number($(this).find('td:nth-of-type(3)').children().val()); //quantity
                // let td_discount = Number($(this).find('td:nth-of-type(2)').children().val()); //quantity
                //
                // let CurrentQuantity     = $(this).find('td:nth-of-type(3)').children();
                // let CurrentDiscount     = $(this).find('td:nth-of-type(2)').children();
                //
                // CurrentQuantity.val(td_Quantity + Number(min_quantity_input.val()));
                // CurrentDiscount.val(td_discount + Number(value.val()));

                ret = true;
            }
            return ret;
        });
        return ret;
    }

    /**
     * Add product row in offer table.
     */
    add_row.on('click',function ()
    {
        if (product_id.val() === '' || value.val() === '' || min_quantity_input.val() === '' || type_id.val() === '')
        {
            Swal.fire({
                icon: 'info',
                title: 'You must add discount.',
                text:  'You must fill in all fields!',
            });
            return 0;
        }
        if (Search() === true)
        {
            Swal.fire({
                icon: 'info',
                title: 'The discount has already been added.',
                text:  'It should not be added again',
            });
            return 0;
        }

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
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'The discount has been successfully deleted',
            showConfirmButton: false,
            timer: 1500
        })
    });
});
