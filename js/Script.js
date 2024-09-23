$(document).ready(function(){
    // Handle click on delete button
    $('button').click(function(){
        const id = $(this).attr('id');
        
        $.post("app/delete.php", 
            {
                id: id
            },
            (data)  => {
                if(data){
                    $(this).parent().hide(600);
                }
            }
        );
    });
    
    // Handle click on update button
    $(".check-box").click(function(e){
        const id = $(this).attr('data-todo-id');
        
        $.post('app/update.php', 
            {
                d: id
              },
              (data) => {
                  if(data != 'error'){
                    const h2 = $(this).next();
                    if(data === '1'){
                        h2.removeClass('checked');
                    }else {
                        h2.addClass('checked');
                    }
                }
            }
        );
    });

    // Handle click on edit button
    $('.edit-btn').click(function() {
        const id = $(this).attr('edit-todo-id');
        const title = $(this).siblings('h2').text();
        $('input[name="title"]').val(title); 
        $('form').attr('action', 'app/edit.php?id=' + id); 
    });
    
});