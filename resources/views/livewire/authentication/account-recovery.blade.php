<div>
  @if($valid)
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="{{ asset('images/slider/wm.jpg') }}" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="{{ asset('images/logo/logo.png') }}" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Recover Account</p>
              <form wire:submit.prevent="change_password()">
                @csrf
                <div class="form-group">
                    <label for="password" class="form-label">New password</label>
                    <input type="password" class="form-control" min="8" wire:model="password"  wire:keyup="verify_password()"required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Comfirm password</label>
                    <input type="password" class="form-control" min="8" wire:model="confirm_password"  wire:keyup="verify_confirm_password()"required>     
                </div>
                
                <button type="submit" class="btn btn-block login-btn mb-4 button-color" <?php if($recover_button !='Change Password'){echo 'disabled';};?>>{{$recover_button}}</button>
                <a href="{{ route('login') }}" class="forgot-password-link">Back to Login</a>
              </form>
              <nav class="login-card-footer-nav">
                <a href="#!">Terms of use.</a>
                <a href="#!">Privacy policy</a>
              </nav>
              <!-- Add the back to homepage button -->
              <a href="{{ route('home') }}" class="btn btn-block btn-outline-primary mt-3">Back to Homepage</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @else
    <div>
      <div class="container">
          <div class="header">
              <h1>WMSU Testing and Evaluation Center</h1>
              <p>Invalid link</p>
              <a href="{{ route('login') }}">Login</a>
          </div>
      </div>
  </div>

  @endif
</div>
