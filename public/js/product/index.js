let AddToCart;

$(document).ready(function()
{

    /**
     * this method to add Cart Item
     *
     * @param product_id
     * @constructor
     */

    AddToCart = function  (product_id)
    {
        axios({
            method: 'post',
            url: '/interview-task/inerview-task/public/CartItem',
            data: {
                cart_id: null,
                product_id: Number(product_id),
                quantity: 1
            }
        }).then((response) =>
        {
            console.log(response);
        }, (error) =>
        {
            console.log(error);
        });
    };

});
