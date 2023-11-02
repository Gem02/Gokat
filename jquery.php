<script src="sweetalert.min.js"></script>

<script>

fetch_post();

function fetch_post(){
    var action = 'fetch_post';
    $.ajax({
    url:'action.php',
    method:"POST",
    data:{action:action},
    success:function(data){
        $('.feedposts').html(data);
    }
    })
}


$(document).on('click', '.followbtn', function(e){
    e.preventDefault();
    var poster_id = $(this).attr('id');
    var action = 'follow';
    
    $.ajax({
        url:"action.php",
        method:"POST",
        data:{poster_id:poster_id, action:action},
        success:function(data){
            $('.follow').html(data);
                fetch_post();
                toastr.success("Action was successful", "Success");
        }
    })
}); 

$(document).on('click', '.likebtn', function(e){
    e.preventDefault();
    var post_id = $(this).attr('id');
    var action = 'like';

    $.ajax({
        url:"action.php",
        method:"POST",
        data:{post_id:post_id, action:action},
        success:function(data) {
            fetch_post();
            toastr.success("Action was successful", "Success");
            
        }
    })
})

$(document).on('click', '.submitcomment', function(e){
        e.preventDefault();
        post_id = $(this).attr('id');
        var comment = $('#comment'+post_id).val();
        var action = 'submitcomment';
        if(comment != ''){
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{post_id:post_id, comment:comment, action:action},
                success:function(data)
                {

                    fetch_post();
                    toastr.success("Comment added successfully", "Success");
                }
            })
        }else {
            alert('Comment cannot be empty');
        }
});

$(document).on('click', '.deletepost', function(e){
    e.preventDefault();
    post_id = $(this).attr('id');
    var action = 'deletepost';
    swal({
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this  Post!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                    var post_id = $(this).attr("id");
                    var action = 'deletepost';
                    $.ajax({
                        url:'action.php',
                        method:'POST',
                        data:{post_id:post_id, action:action},
                        success:function(data){
                            toastr.success("Your post has been deleted successfully", "Success");
                            fetch_post();
                        }
                    })
                
            }else {
                swal("saved");
            }
        })
        
})


</script>