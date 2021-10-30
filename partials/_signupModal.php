<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">SignUp for an iDiscuss Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/idiscuss forum project/partials/_handleSignup.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" aria-describedby="emailHelp">
              <!-- <div id="emailHelp" class="form-text"></div> -->
          </div>
          <div class="mt-3">
            <label for="userPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Your Password">
          </div>
          <div class="mb-3">
            <label for="cPassword" class="form-label">Re-type Password</label>
              <input type="password" class="form-control" id="csignupPassword" name="csignupPassword" placeholder="Your Re-type Password">We'll never share your password with anyone else.
          </div>
          <button type="submit" class="btn btn-primary">SignUp</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>