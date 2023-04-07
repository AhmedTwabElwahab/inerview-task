$(document).ready(function()
{

    /**
     * remove row in table Cart
     */
    $('#Cart').on('click','tbody tr td button#remove_row',function ()
    {
        $(this).parents('tr').remove();
    });
});
