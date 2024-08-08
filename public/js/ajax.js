$(document).ready(function() {
  
    
    $(document).on('submit', '#search-form', function() {
        event.preventDefault();
        let formData = $(this).serialize(); 
                
        $.ajax({
            url:$(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                console.log(response.content);
                $('#content').html(response.content);
                
                      
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                $('#content').html('<p>An error occurred. Please try again.</p>');
                }
        });
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                console.log(response);
                $('#content').html(response.content);
                $('.pagination-links').html(response.pagination);
            }
        });
     
    });
    

    
   
    
   
    
    
    
   
    
    
    
    
    
   
    
    
});