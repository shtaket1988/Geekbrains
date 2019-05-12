$(function(){
    $('#more_products').click(function () {
        loadMore();
        return false;
    });
});

function loadMore(){
    page++;

    $.ajax({
        type : 'POST',
        dataType: "json",
        url : 'ajax.php',
        data: { 'page':page, 'counts':counts },
        success : function(data) {
            // Проверка окончания товаров
            if(data.deleteButton == true){
                $('#more_products').remove();
            }

            data.products.forEach(function(item, i, arr) {
                $("#products").append('<div class="product" id="product-'+item.id+'">'+item.name+'</div>');
            });

        }, error: function () {
            alert('Не удалось подключиться к серверу')
        }
    });
}