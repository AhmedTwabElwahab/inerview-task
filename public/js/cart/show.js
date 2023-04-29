/**
 * update cartItem.
 *
 * @param item_id
 * @param type
 */
let updateCart = function  (item_id,type)
{
    axios({
        method: 'post',
        url: '/CartItem/update',
        data: {
            item_id: Number(item_id),
            quantity: 1,
            type: type,
        }
    }).then((response) =>
    {
        console.log(response);
    }, (error) =>
    {
        console.log(error);
    });
};

$(document).ready(function()
{
    update_cart_total();
});

/**
 * Remove item From Cart
 *
 * @param id
 */
let remove_item_cart = function (id)
{
    let form       = $('form[id=delete_form'+id+']');
    event.preventDefault();
    Swal.fire({
        title: 'Do you want to delete the item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) =>
    {
        if (result.isConfirmed)
        {
            Swal.fire(
                'Deleted!',
                'Your item has been deleted.',
                'success'
            );
            form.submit();
        }
    })
}
/**
 * update total row.
 *
 * @param id
 */
let update_total = function (id)
{
    let quantity       = $('input[id=quantity'+id+']').val();
    let price          = $('div[id=price'+id+']');
    let total          = $('div[id=total'+id+']');
    //update total of row.
    total.text(quantity * parseInt(price.text()));
    //update total of cart.
    update_cart_total();
}
/**
 * func to update cart total.
 */
let update_cart_total = function ()
{
    let all_total      = $('div[class=total_row]');
    let total_cart     = $('div[id=total_Cart]');
    let final_total    = 0;

    $.each( all_total, function()
    {
        final_total += parseInt($(this).text());
    });
    total_cart.text(final_total);
}
/**
 * decrease quantity item.
 *
 * @param id
 */
let decrease = function (id)
{
    let quantity       = $('input[id=quantity'+id+']');
    if ( Number( quantity.val() ) -1 < 0 )
    {
        return 0;
    }
    quantity.val( Number( quantity.val() ) -1 );
    update_total(id);
    updateCart(id,"DEC");

}
/**
 * add one in item quantity.
 *
 * @param id
 */
let increase = function (id)
{
    let quantity       = $('input[id=quantity'+id+']');
    quantity.val( Number( quantity.val() ) +1 );
    update_total(id);
    updateCart(id,"INC");
}

