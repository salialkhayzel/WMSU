<div>
    <main class="d-flex align-items-center min-vh-100">
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
                <p class="login-card-description">Register an account using your Email</p>
                <ol class="mt-0">
                    <li>Use a valid personal email address that you can access for your activation link.</li>
                    <li>Ensure the email address is correct and can receive emails.</li>
                    <li>Provide accurate information to avoid delays in processing your application.</li>
                    <li>Verify the correctness of your school's name.</li>
                    <li>Remember, one sign-up per email address.</li>
                    <li>Activate your account via the email sent to you.</li>
                </ol>
                @if(!$sign_up)
                    @if($email_send)
                        <form wire:submit.prevent="send_verification_code()" >
                        @csrf
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email"  wire:model="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <button type="submit"   class="btn btn-block login-btn mb-4 button-color">Send Verification Code</button>
                        <a href="{{ route('login') }}" class="text-reset">Back to Login</a>
                       </form>
                    @else
                        <form wire:submit.prevent="verify_code()" >
                            @csrf
                            <div class="form-group">    
                                <label for="email" class="sr-only">Email</label>
                                <input type="number"  wire:model="code" class="form-control" placeholder="Enter code" min="100000" max="999999" required>
                            </div>
                            <button type="submit"  class="btn btn-block login-btn mb-4 button-color">Verify</button>
                            <a href="{{ route('login') }}" class="text-reset">Back to Login</a>
                       </form>
                    @endif
                @else
                <div class="alert alert-danger" role="alert">
                    <form wire:submit.prevent="sign_up()">
                        <div class="row ">
                            <div class="col-md-12 ">
                                <label for="firstName" class="form-label">Username</label>
                                <input type="text" style="{{$style}}"class="form-control"  wire:model="username" wire:keyup="verify_username()" required>
                            </div>
                            <div class="col-md-12 ">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" wire:model="firstname" required>
                            </div>
                            <div class="col-md-12 ">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" wire:model="middlename">
                            </div>
                            <div class="col-md-12 ">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" wire:model="lastname" required>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-7">
                                <label for="suffix" class="form-label">Suffix (if applicable)</label>
                                <select class="form-control" id="suffix" name="suffix">
                                    <option value="NA" selected>NA</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="III">III</option>
                                    <!-- Add more options as needed -->
                                </select>
                                <small class="form-text text-muted">Include any suffix associated with your name.</small>
                            </div>
                        </div>

                            <div class="row ">
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" min="8" wire:model="password"  wire:keyup="verify_password()"required>
                                </div>
                                <div class="col-md-12 ">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" min="8" wire:model="confirm_password"  wire:keyup="verify_confirm_password()"required>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 ">
                                    <label class="form-label"></label>
                                </div>
                                <div class="col-md-8 mb-4">
                                    <label for="birthDate" class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" wire:model="birthdate"  wire:change="verify_birthdate()"required>
                                </div>
                                <button type="submit" class="btn-block button-color ">{{$sign_up_button}}</button>
                            </div>
                        </form>
                    </div>
                @endif
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
