<div>
    <section class="vh-100 mt-2 px-3 p-2">
        <div class="container py-2 h-75 shadow-lg p-3 mb-5 bg-body rounded">
            {{-- message here --}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            {{-- it ends here --}}
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-4 col-lg-4 ">
                    <img src="{{ asset('assets/images/updated.png') }}" class="img-fluid" alt="dmmmsu-logo">
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 offset-xl-1">
                    <form wire:submit.prevent="addUser">
                        @csrf

                        <div class="row g-3 mb-1">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" id="name"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
                                    wire:model.live='name'>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="username">Username</label>
                                <input type="text" id="username"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    name="username" wire:model.live='username' />
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                    name="email" wire:model.live='email'>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="role">User type</label>
                                <select id="role"
                                    class="form-select form-select-sm  @error('role') is-invalid @enderror" name="role"
                                    wire:model.live='role'>
                                    <option value="1">Admin</option>
                                    <option value="0">Staff</option>
                                    <option value="2">Campus In-charge - NLUC</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                        name="password" wire:model.live="password">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="bi bi-eye-slash" id="password-visibility-icon"></i>
                                    </span>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="cpassword">Confirm password</label>
                                <div class="input-group">
                                    <input type="password" id="cpassword" class="form-control form-control-sm @error('cpassword') is-invalid @enderror"
                                        name="cpassword" wire:model.live="cpassword">
                                    <span class="input-group-text" onclick="toggleConfirmPasswordVisibility()">
                                        <i class="bi bi-eye-slash" id="confirm-password-visibility-icon"></i>
                                    </span>
                                </div>
                                @error('cpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Submit button -->
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-success btn-md btn-rounded">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('password-visibility-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.replace('bi-eye', 'bi-eye-slash');
    }
}

function toggleConfirmPasswordVisibility() {
    const confirmPasswordInput = document.getElementById('cpassword');
    const confirmPasswordIcon = document.getElementById('confirm-password-visibility-icon');

    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        confirmPasswordIcon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        confirmPasswordInput.type = 'password';
        confirmPasswordIcon.classList.replace('bi-eye', 'bi-eye-slash');
    }
}

    </script>
</div>