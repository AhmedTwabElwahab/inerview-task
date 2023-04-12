removeItem = function (item_ID)
{
    axios.delete(`/CartItem/${item_ID}`,)
        .then((response) =>
        {
            console.log(response);
        }, (error) =>
        {
            console.log(error);
        });
};
$(document).ready(function()
{
    /**
     * remove row in table Cart
     */
    // $('#Cart').on('click','tbody tr td button#remove_row',function ()
    // {
    //     $(this).parents('tr').remove();
    // });
});
