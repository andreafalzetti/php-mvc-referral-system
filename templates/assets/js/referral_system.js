$(function() {

    $('body').on('click', 'table.clients tr', function(e) {
        var id = $(this).data('user-id');
        if(typeof id !== "undefined" && id !== null) {
            window.location.href = "./client/" + id;
        }
        console.info("Click on User.Id = " + id);
    });
    
    $('#random_client').click(function(e){
       $.ajax({
          url: 'https://randomuser.me/api/',
          dataType: 'json',
          success: function(data){
              console.log(data);
              if(typeof data.results !== "undefined") {
                  if(data.results.length > 0) {
                      var user = data.results[0];
                      
                      if($("#title option[value='"+ucfirst(user.name.title)+"']").length > 0) {
                          $('#title').val(ucfirst(user.name.title));
                      }
                      $('#first_name').val(ucfirst(user.name.first));
                      $('#last_name').val(ucfirst(user.name.last));
                      $('#address_line_1').val(ucfirst(user.location.street));
                      $('#address_postcode').val(user.location.postcode);
                      $('#address_city').val(ucfirst(user.location.city));
                      $('#address_country').val(ucfirst(user.location.state));
                      $('#dob').val(user.dob);
                      $('#email').val(user.email);
                      $('#mobile').val(user.cell);
                  }
              }
          }
        });
        e.preventDefault();
    });
    
    $('#accept').click(function(e){
        var that = this;    
        var user_id = $('#user-id').val();
        $(this).prop('disabled', true);
        $.ajax({
            type: 'PUT',
            headers: {
              'Content-Type':'application/json'
            },
            dataType: 'json',
            url: baseUrl + '/client/' + user_id,
            data: JSON.stringify({
              status: 1
            }),
            processData: false,
            success: function(resp) {
                console.log(resp);
                if(resp.result) {
                    $('#accept').hide();
                    $('#reject').show();
                }
                $(that).prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {              
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
          });
        
        e.preventDefault();
    });
    
    $('#reject').click(function(e){
        var that = this;
        var user_id = $('#user-id').val();
        $(this).prop('disabled', true);
        $.ajax({
            type: 'PUT',
            headers: {
              'Content-Type':'application/json'
            },
            dataType: 'json',
            url: baseUrl + '/client/' + user_id,
            data: JSON.stringify({
              status: -1
            }),
            processData: false,
            success: function(resp) {
                console.log(resp);
                if(resp.result) {
                    $('#reject').hide();
                    $('#accept').show();                    
                }
                $(that).prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {              
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
          });
        
        e.preventDefault();
    });    
    
});

function ucfirst (str) {
    return typeof str !="undefined"  ? (str += '', str[0].toUpperCase() + str.substr(1)) : '' ;
}