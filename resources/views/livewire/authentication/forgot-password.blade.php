<div>
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
              <p class="login-card-description">Forgot Password</p>
              <form wire:submit.prevent="recover_account()">
                @csrf
                <div class="form-group">
                  <label for="email" class="sr-only">Email</label>
                  <input type="email"  wire:model="email" class="form-control" placeholder="Enter Recovery Email" required>
                </div>
                <button type="submit" class="btn btn-block login-btn mb-4 button-color">Recover account</button>
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
</div>
