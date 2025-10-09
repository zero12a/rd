
    <html><body onload="alert('on load');">
    <form class="form-signin" onsubmit="return false;" method="post">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email or Id</label>
      <input type="text"  name="F_EMAIL" id="F_EMAIL" class="form-control" placeholder="Email or Id" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password"  name="F_PASSWD" id="F_PASSWD" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" id="btnLogin" name="btnLogin">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
  </html>  
