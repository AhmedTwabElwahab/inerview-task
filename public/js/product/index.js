let AddToCart;

$(document).ready(function()
{
    /**
     * this method to add Cart Item
     *
     * @param product_id
     * @constructor
     */

    AddToCart = function  (product_id, product_price)
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
                timer: 1500
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

});
