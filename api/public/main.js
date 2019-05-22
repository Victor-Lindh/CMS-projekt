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
}




  loadView(views.startUp);


  const loginForm = document.querySelector('#loginform')
  loginForm.addEventListener('submit', event => {
    event.preventDefault();
    
    const formData = new FormData(loginForm);
    fetch('/api/login', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        // loadView(views.startUp)
        console.log(response);
        console.log(fail);
        // throw Error(response.statusText)
        return Error(response.statusText)
        // return console.log(response.statusText);
    } else {
      console.log('bra');
        loadView(views.loggedIn)
        return response.json()
      }
    })
    .catch(error => {
      console.error(error)
    })
    
    // fetch ('api/users')
    // .then (response => response.json())
    // .then (data => {
    //   console.log(data)
    // });
  });



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