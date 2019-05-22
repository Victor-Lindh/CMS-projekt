<section id="register" class="form-container hidden">
    <h2>Register</h2>
<form id="registerform" method="POST" action="?action=register">
    <div class="form-group input-group-lg">
        <label for="username">Username</label>
        <input class="form-control" type="text" id="username" name="username" />
        <label for="password">Password</label>
        <input class="form-control" type="password" id="password" name="password" />
    </div>
    <div class="form-check">
        <input class="btn btn-primary" id="submit" type="submit" value="SUBMIT" />
        <p id="errorfield-username" class="error hidden">Wrong input in username</p>
        <p id="errorfield-password" class="error hidden">Wrong input in password</p>
    </div>
</form>
</section>