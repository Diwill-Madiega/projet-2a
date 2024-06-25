

$(document).ready(function() {
    $('#operation_post').change(function() {
        var postId = $(this).val();  
        if (postId) {
            $.ajax({
                url: '/machines/' + postId,  
                type: 'GET',
                success: function(data) {
                    $('#operation_machine').html(data); 
                }
            });
        }
    });
});