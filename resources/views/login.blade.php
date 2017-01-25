<div class="well authenticate">
  <div style="max-width:200px;margin:auto;"><img src="assets/images/logo.jpg" width="100%"></div>
    <form id="loginForm" method="POST" action="/login/auth" novalidate="novalidate">
        <div :class="errors['user.email']||errors['response']?'form-group has-error':'form-group'">
            <label for="username" class="control-label">Username</label>
            <input v-model="user.email" type="text" class="form-control" id="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
            <div class="text-right">@{{errors['user.email']}}</div>
        </div>
        <div :class="errors['user.password']||errors['response']?'form-group has-error':'form-group'">
            <label for="password" class="control-label">Password</label>
            <input v-model="user.password" type="password" class="form-control" id="password" value="" required="" title="Please enter your password">
            <div class="text-right">@{{errors['user.password']}}</div>
        </div>
        <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
        <div :class="errors['user.remember']||errors['response']?'form-group has-error':'form-group'">
          <div class="checkbox">
              <label>
                  <input v-model="user.remember" type="checkbox" id="remember"> Remember login
              </label>
              <p class="help-block" v-if="!errors['response']">(if this is a private computer)</p>
              <p class="help-block text-right" v-if="errors['response']">*** @{{errors['response']}}</p>
          </div>
          <div class="text-right">@{{errors['user.remember']}}</div>
        </div>
        <button v-on:click.prevent="login" type="submit" class="btn btn-success btn-block">Login</button>
    </form>
</div>