<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <span class="logo d-flex align-items-center w-auto">
                        <span class="d-none d-lg-block">Welcome back!</span>
                    </span>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        </div>
                        <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Enter your username" required>
                                    <div class="invalid-feedback">Please enter your username.</div>
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" placeholder="****" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            {{-- <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                            </div> --}}
                            <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                            {{-- <div class="col-12">
                                <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                            </div> --}}
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </section>
</x-guest-layout>
