/**
 * this method to add Cart Item
 *
 * @param product_id
 * @param product_price
 * @constructor
 */

let AddToCart = function  (product_id, product_price)
{
    axios({
        method: 'post',
        url: '/CartItem',
        data: {
            cart_id: null,
            product_id: Number(product_id),
            quantity: 1,
            total: Number(product_price)
        }
    }).then((response) =>
    {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Added to cart successfully!',
            showConfirmButton: false,
            showCloseButton: true,
            footer: '<a href="/cart"> Go to Shopping Cart</a>'
        })
    }, (error) =>
    {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        });
    });
};
