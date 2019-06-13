const views = {
  startUp: ['#chooseTemp', '#welcomeTemp', '#loginTemp', '#registerTemp','#cardUsers', '#cardTemp'],
  loggedIn: ['#headerHome','#greetingTemp','#cardUsers', '#cardTemp'],
  homeHeader:['#headerHome', '#welcomeTemp', '#loginTemp', '#registerTemp','#cardUsers', '#cardTemp']
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

  bindEvents();
} // loadView slutar här

//Functions____________________________________Functions______________________________Functions
// added like btn on line 43
// addLike fn on line 60

function getLatestUserPosts(posts) {
  let place = document.querySelector('#card-contain');
  let res = "";
  posts.forEach(part => {
    res += `
    <div class="card">
      <div class="card-body-login">
        <h2>${part.title}</h2>
        <p>${part.content}</p>
        <i>${part.createdAt}</i>
        <i>${part.entryID}</i>
        <br>
        <button class='remove' data-entryid=${part.entryID}>Delete</button>
        <form class="hidden update-form" id='form-edit${part.entryID}' data-entryid=${part.entryID}>
          <input name="title" type="text" class="post-edit form-control" aria-label="Default"
          aria-describedby="title-grp" value="${part.title}">
          <textarea name="content" class="post-edit form-text form-control" aria-label="With textarea">${part.content}</textarea>
          <button class='send-update' type='submit' id='updateid-${part.entryID}' data-entryid='${part.entryID}'>Update</button>
        </form>
        <button class='edit' data-entryid=${part.entryID} id='editid-${part.entryID}'>Edit</button>
        <button class='likeBtn' data-entryid=${part.entryID} id='likeid-${part.entryID}'><i class="far fa-thumbs-up"></i></button>
        <div>
        <form data-entryid=${part.entryID} id="comment-form${part.entryID}" class="comment-forms">
        <textarea class="comments" rows="5" cols="15" name="comments" id="comments${part.entryID}"></textarea>
        <br>
        <input type="submit" data-entryid="${part.entryID}" value="Submit">
        </div>
        </form>
      </div>
      
    </div>`;
  });
  place.innerHTML = res;
  loadAllBtn();

} // render all on frontpage

function getLatestPosts(posts) {
  let place = document.querySelector('#card-contain');
  let res = "";
  posts.forEach(part => {
    res += `
    <div class="card">
      <div class="card-body-login">
        <h2>${part.title}</h2>
        <p>${part.content}</p>
        <i>${part.createdAt}</i>
      </div>

    </div>`;
  });
  place.innerHTML = res;
};
function getLatestPostsLoggedIn(posts) {
  let place = document.querySelector('#card-contain');
  let res = "";
  posts.forEach(part => {
    res += `
    <div class="card">
      <div class="card-body-login">
        <h2>${part.title}</h2>
        <p>${part.content}</p>
        <i>${part.createdAt}</i>
        <i>${part.entryID}</i>
        <button class='remove' data-entryid=${part.entryID}>Delete</button>
        <form class="hidden update-form" id='form-edit${part.entryID}' data-entryid=${part.entryID}>
          <input name="title" type="text" class="post-edit form-control" aria-label="Default"
          aria-describedby="title-grp" value="${part.title}">
          <textarea name="content" class="post-edit form-text form-control" aria-label="With textarea">${part.content}</textarea>
          <button class='send-update' type='submit' id='updateid-${part.entryID}' data-entryid='${part.entryID}'>Update</button>
        </form>
        <button class='edit' data-entryid=${part.entryID} id='editid-${part.entryID}'>Edit</button>
        <button class='likeBtn' data-entryid=${part.entryID} id='likeid-${part.entryID}'><i class="far fa-thumbs-up"></i></button>
        <form class="comment-forms" data-entryid=${part.entryID} id="comment-form${part.entryID}">
        <textarea class="comments" rows="5" cols="15" name="comments" id="comments${part.entryID}"></textarea>
        <input type="submit" data-entryid="${part.entryID}" value="Submit">
        <ul class="comment-list" id="comment-list${part.entryID}"></ul>
        </div>
        </form>
      </div>
      
    </div>`;
  });
  place.innerHTML = res;
  loadAllBtn();
  fetchAllComments();
  getAndRenderAllUsers();
  commentStopProp();
};
// render all inside login


const fetchUserPosts = () => {
  fetch('/api/entry/userposts')
    .then(response => response.json())
    .then(json => getLatestUserPosts(json))
    .catch(err => console.log(err))
}

const fetchUserPostsLoggedIn = () => {
  fetch('/api/entry/userposts/loggedIn')
    .then(response => response.json())
    .then(json => getLatestUserPosts(json))
    .catch(err => console.log(err))
}

function loadAllBtn() {
   
     // add eventlistener for the like btn
     const likeBtnArray = document.querySelectorAll(".likeBtn");
     if(likeBtnArray){
   
       for (let i = 0; i < likeBtnArray.length; i++) {
         likeBtnArray[i].addEventListener("click", event => {
           event.preventDefault();
           const entryID = likeBtnArray[i].getAttribute("data-entryid");
           addLike(entryID);
         });
       }
     }

  let editbtns = document.querySelectorAll('.edit');
  if(editbtns){

    editbtns.forEach(editbutton => {
      editbutton.addEventListener("click", function (e) {
        e.preventDefault();
        const entryid = e.target.dataset.entryid;
        let formEdit = document.getElementById('form-edit' + entryid)

        if (formEdit.style.display == "block") {
          formEdit.style.display = "none";
        } else {
          formEdit.style.display = "block";
        }
      }) //eventlistener slutar här
    })  // forEach slutar här
  }

  let removeBtns = document.querySelectorAll('.remove');
  if(removeBtns){
    removeBtns.forEach(removeBtn => {
      removeBtn.addEventListener("click", function (e) {
        e.preventDefault();
        const entryid = e.target.dataset.entryid;


        fetch(`/api/userposts/remove/${entryid}`, {
          method: 'delete'
        })
          .then(response => response.json())
          .then(json => {

            console.log(json);
        })
          loadView(views.homeHeader);
          getAndRenderAllUsers();
          fetchUserPosts();
          fetchAllComments();
      });
    });
  }

  let updateForms = document.querySelectorAll('.update-form');

  if(updateForms){

    updateForms.forEach(updateForm => {
      updateForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const dataUpdateid = e.target.dataset.entryid; // Send Update btn
        const formData = new FormData(updateForm);
        fetch(`/api/entry/update/${dataUpdateid}`, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => console.log(data))
        loadView(views.homeHeader);
        getAndRenderAllUsers();
        fetchUserPosts();
        fetchAllComments();
      }) // Eventlistner slutar här
    }); // forEach slutar här
  }
} // END OF loadAllBtn A function to get rid of async problems and to get rid of duplets.

const fetchAllComments = () => {
  fetch('/api/comments')
    .then(response => response.json())
    .then(json => getAllComments(json))
    .catch(err => console.log(err))
}

  function getAndRenderAllUsers() {
    fetch('/api/users').then(resp => resp.json()).then(json => getAllUsers(json));
  }

function getLatestPosts(posts) {
  let place = document.querySelector('#card-contain');
  let res = "";
  posts.forEach(part => {
    res += `
    <div class="card">
    <h2>${part.title}</h2>
    <div class="card-body">
     <p>${part.content}</p>
     <i>Skrivet av ${part.username} | ${part.createdAt}</i>
     <ul class="comment-list" id="comment-list${part.entryID}"></ul>
     </div>
    </div>`;
  });
  // <ul class="comment-list" id="comment-list${part.entryID}"></ul>
  place.innerHTML = res;
  fetchAllComments();

  commentStopProp();
  let cards = document.querySelectorAll('.card');
  cards.forEach(card => card.addEventListener('click', (e) => {
    
    if (card.lastElementChild.style.display === "block") {
      card.lastElementChild.style.display = "none";
    } else {
      card.lastElementChild.style.display = "block";
    }
    }  // foreach slutar här
    ));
    getAndRenderAllUsers();
};
function commentStopProp(){

  let comments = document.getElementsByName("comments");
  if(comments){
    comments.forEach(comment => {
      comment.addEventListener("click", function(e){
        e.stopPropagation();
      })
    })
  }
}

function getAllComments(comments) {
  let commentLists = document.querySelectorAll('.comment-list');

    // for (let i = 0; i < commentLists.length; i++) {
      
      comments.forEach(comment => {
        let res = "";
        res += `
          
                <li><span>By: ${comment.username}<br><br>
                          ${comment.content}<br><br>
                      At: ${comment.createdAt}</span>
                </li>
        `;
    let commentID = document.getElementById('comment-list' + comment.entryID)

     if(commentID.id = 'comment-list' + comment.entryID){
       commentID.innerHTML += res;
     }}
);
}

// addLike fn
function addLike(entryID) {
  fetch('/api/like/' + entryID, {
    method: 'POST'
  })
    .then(response => {
      if (!response.ok) {
        return Error(response.statusText);
      } else {
        return fetch('/api/like', {
          method: 'GET'
        })
      }
    })
    .then(response => {
      return !response.ok ? new Error(response.statusText) : response.json();
    })
    .then(data => {
      getLatestUserPosts(data);
    })
    .catch(error => {
      console.error(error);
    });
}
// ************** END OF like fn  ***********************

//Bindevents____________________________________Bindevents______________________________Bindevents

const bindEvents = () => {


 

  let loginBtn = document.getElementById('login-btn');
  if(loginBtn){

    loginBtn.addEventListener('click', function(){
    document.getElementById("login").style.display = "block";
    document.getElementById("register").style.display = "none";
    document.getElementById("home").style.display = "none";
  })};

  let homeBtn = document.getElementById('home-btn');
  if(homeBtn){

  homeBtn.addEventListener('click', function(){
    document.getElementById("login").style.display = "none";
    document.getElementById("register").style.display = "none";
    document.getElementById("home").style.display = "block";
  })};

  let registerBtn = document.getElementById('register-btn');
  if(registerBtn){
  registerBtn.addEventListener('click', function(){
    document.getElementById("login").style.display = "none";
    document.getElementById("register").style.display = "block";
    document.getElementById("home").style.display = "none";
  })};

  const entryForm = document.querySelector('#entry-form');
  if (entryForm) {
    entryForm.addEventListener('submit', event => {
      event.preventDefault();

      const formData = new FormData(entryForm);
      fetch('/api/entry/send', {
        method: 'POST',
        body: formData
      }).then(response => {
        if (!response.ok) {
          return Error(response.statusText);
        } else {
          fetchUserPosts();
        }
      }).then(data => {
        console.log(data);
      })
        .catch(error => {
          console.error(error);
        })
    });
    };

    let comments = document.querySelectorAll('.comment-forms');

    if(comments){
      comments.forEach(comment => {
        comment.addEventListener("submit", function (e) {
          e.preventDefault();
          
          const formData = new FormData(comment);
          fetch(`/api/comments/send`, {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => console.log(data))
          .catch(error => {
            console.error(error);
          })
  
        }) // Eventlistner slutar här
      }); // forEach slutar här
    }

    const logutBtn = document.querySelector("#logout-btn");
    if(logutBtn){
      logutBtn.addEventListener("click", function () {
        fetch('/api/logout')
        .then(function () {            
          loadView(views.startUp);
          
          
        })
          
      })  // eventlistener slutar här
            
    } // if-logoutBtn slutar här


    let editbtns = document.querySelectorAll('.edit');
    if(editbtns){

      editbtns.forEach(editbutton => {
        editbutton.addEventListener("click", function (e) {
          e.preventDefault();
          const entryid = e.target.dataset.entryid;
          let formEdit = document.getElementById('form-edit' + entryid)

          if (formEdit.style.display == "block") {
            formEdit.style.display = "none";
          } else {
            formEdit.style.display = "block";
          }
        }) //eventlistenern slutar här
      })  // forEach slutar här
    }

    let removeBtns = document.querySelectorAll('.remove');
    if(removeBtns){
      removeBtns.forEach(removeBtn => {
        removeBtn.addEventListener("click", function (e) {
          e.preventDefault();
          const entryid = e.target.dataset.entryid;


          fetch(`/api/userposts/remove/${entryid}`, {
            method: 'delete'
          })
          .then(response => response.json())
          .then(json => {
            console.log(json);

          })
          loadView(views.homeHeader);
          getAndRenderAllUsers();
          fetchUserPosts();

        });
      });
    }



let updateForms = document.querySelectorAll('.update-form');

  if(updateForms){
    updateForms.forEach(updateForm => {
      updateForm.addEventListener("submit", function (e) {
        e.preventDefault();
        console.log(updateForms);

        const dataUpdateid = e.target.dataset.entryid; // Send Update btn
        const formData = new FormData(updateForm);
        fetch(`/api/entry/update/${dataUpdateid}`, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => console.log(data))

      }) // Eventlistner slutar här
    }); // forEach slutar här
  }

  const loginForm = document.querySelector('#loginform')
  if(loginForm){

    loginForm.addEventListener('submit', event => {
      event.preventDefault();

      const formData = new FormData(loginForm);
      fetch('/api/login', {
        method: 'POST',
        body: formData
      }).then(response => {
        if (!response.ok) {
          return Error(response.statusText);
        }
        else {

          loadView(views.loggedIn)
          getAndRenderAllUsers();
          fetchUserPosts();
          getAllComments();
          fetchAllComments();
        }
      // }).then(data => {
      //   console.log(data);
      })
      .catch(error => {
        console.error(error);
      })
    }); // loginForm-eventlistener slutar här
  }

  const regForm = document.querySelector('#registerform')
  if(regForm){

    regForm.addEventListener('submit', event => {
      event.preventDefault();
      loadView(views.startUp);
      getAndRenderAllUsers();
      fetchUserPosts();

      const formData = new FormData(regForm);

      fetch('/api/register', {
        method: 'POST',
        body: formData
      }).then(response => {
        if (!response.ok) {
          return Error(response.statusText);
        }
        else {
          return response.json();

        } // else slutar här
      }).then(data => {
        console.log(data)

      });
    }); // registerformulär-eventlistener slutar här
  }

  let homeHeaderBtn = document.getElementById('home-header');
  if(homeHeaderBtn){
    homeHeaderBtn.addEventListener('click', function() {
      loadView(views.homeHeader);
        fetch('/api/entry/frontposts')
        .then(response => response.json())
        .then(json => getLatestPostsLoggedIn(json));
      
    }); // eventlistner slutar här
  }

  let userBlogBtn = document.getElementById('user-blog');
  if(userBlogBtn){
    userBlogBtn.addEventListener('click', function() {
        loadView(views.loggedIn);
        getAndRenderAllUsers();
        fetchUserPosts();
    }); // eventlistner slutar här
  }

} // Bind events slutar här

  loadView(views.startUp);


  fetch('/api/entry/frontposts')

  .then(response => response.json())
  .then(json => getLatestPosts(json));


  function getAllUsers(users) {
  let all = document.querySelector('#users');
  let ress = "";
  users.forEach(user => {
    ress += `
    ${user.username} |
    `
  });

  all.innerHTML = ress;
}


const api = {
  ping() {
    return fetch('/api/ping')
    .then(response => {
      if(response.ok) {

        loadView(views.loggedIn);
        getAndRenderAllUsers();
        fetchUserPosts();

    }
    })
  }
}


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