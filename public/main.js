const views = {
  startUp: ['#chooseTemp', '#welcomeTemp', '#loginTemp','#registerTemp'],
  loggedIn: ['#greetingTemp'],
  register: ['#registerTemp'],
  card: ['#cardTemp'],
  welcome: ['#welcomeTemp'],
  choose: ['#chooseTemp']
}

const loadView = view => {
  const target = document.querySelector('main')
  target.innerHTML = ''

  view.forEach(template => {
      const markup = document.querySelector(template).innerHTML
      const div = document.createElement('div')
      div.innerHTML = markup
      target.append(div)
  })
  // bindEvent

  bindEvents();
}

const bindEvents = () => { 
  const entryForm = document.querySelector('#entry-form');
  if (entryForm) {
    entryForm.addEventListener('submit', event => {
      event.preventDefault();
      
      const formData = new FormData(entryForm);
      fetch('/api/entry/send', {
        method: 'POST',
        body: formData
      }) .then(response => {
        if (!response.ok) {
          return Error(response.statusText);
        } else {
          loadView(views.loggedIn);
          
          console.log('hej');
          
        }
        
      }).then(data => {
        console.log(data);
      })
      .catch(error => {
        console.error(error);
      })
    });
  }
}



loadView(views.startUp);
  const loginForm = document.querySelector('#loginform')
  loginForm.addEventListener('submit', event => {
    event.preventDefault();
    
    const formData = new FormData(loginForm);
    // console.log(loginForm.username.val);
    fetch('/api/login', {
      method: 'POST',
      body: formData
    }) .then(response => {
      if (!response.ok) {
        return Error(response.statusText);
      } else {
        loadView(views.loggedIn);
        
        const logutBtn = document.querySelector("#logout-btn");
        logutBtn.addEventListener("click", function(){
          fetch('/api/logout')
          .then(function(response) {
            return response.json();
          })
          .then(function() {
            location.reload();
          })
          return response.json();
        })
        
        
        
        
        return response.json();
      }
    }).then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error(error);
    })
  });
  
  
  
  
  
  // fetch ('api/users')
  // .then (response => response.json())
  // .then (data => {
    //   console.log(data)
    // });
    // });
    
    
      
      
      
      
      const api = {
        ping() {
          return fetch('/api/ping')
          .then(response => {
            return !response.ok
            ? new Error(response.statusText)
            : response.json()
          })
          .catch(error => console.error(error))
        }
        
        
        // function renderPost() {
          
          
          //   view.forEach(selector => {
            
            //     const postContainer = document.getElementById('welcome').innerHTML
            //     const div = document.createElement('div')
            //     div.innerHTML = 
            //     `<h1>$title{}</h1>
            //     <p>$content{}</p>
            //     <p>$comments{}</p>
            //     `
            //     target.append(div)
            //   })
            // }
            
            
            // document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
          }
        // }