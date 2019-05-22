setTimeout(function(){ 

  
  
  function validateUsername(username) {      // Validates the name
    username = $("#username").val();
    console.log(username);
    let usernameVal = /^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/;
    
    return usernameVal.test(username)
  }
  function validatePassword(password) {      // Validates the name
    password = $("#password").val();
    console.log(password);
    let passwordVal = /^(?=.{8,})/;
    
    return passwordVal.test(password)
  }
  $('#submit-login').on('click', function () {   // Clicking the button will check the validation of the input field
    if(!validateUsername()) {
      $('#errorfield-username').removeClass('hidden');  // Remove the element while input is valid
    }else{
      $('#errorfield-username').addClass('hidden'); // Will execute if exp: number
      
    }
    if(!validatePassword()) {
      $('#errorfield-password').removeClass('hidden');  // Remove the element while input is valid
    }else{
      $('#errorfield-password').addClass('hidden'); // Will execute if exp: number
      
    }
    
  });
  // document.getElementById("submit").addEventListener("click", function(event){
    //   event.preventDefault()
    // });
    
    $(function(){
      $('#username').bind('input', function(){
        $(this).val(function(_, v){
          return v.replace(/\s+/g, '');
        });
      });
    });
    $(function(){
      $('#password').bind('input', function(){
        $(this).val(function(_, v){
          return v.replace(/\s+/g, '');
        });
      });
    });
    
    
    $('#login-btn').on('click', function() {
      $('#login').show(1000);
      $('#register').hide(100);
      $('#home').hide(100);
    }) 
    $('#home-btn').on('click', function() {
      $('#login').hide(100);
      $('#register').hide(100);
      $('#home').show(1000);
    });
    $('#register-btn').on('click', function() {
      $('#login').hide(100);
      $('#home').hide(100);
      $('#register').show(1000);
    });
    
    
    
    
  }, 500);