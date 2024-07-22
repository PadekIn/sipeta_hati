<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <article class="sign-up">
        <h1 class="sign-up__title">Welcome back!</h1>
        <p class="sign-up__subtitle">Sign in to your account to continue</p>
        <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
            @csrf
            <label class="form-label-wrapper">
                <p class="form-label">Username</p>
                <input name="username" class="form-input" type="username" placeholder="Enter your username" :value="old('username')" required />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </label>
            <label class="form-label-wrapper">
                <p class="form-label">Password</p>
                <input name="password" class="form-input" type="password" placeholder="Enter your password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>
            <label class="form-checkbox-wrapper">
                <input name="remember" class="form-checkbox" id="remember_me" type="checkbox" />
                <span class="form-checkbox-label">Remember me next time</span>
            </label>
            <button type="submit" class="form-btn primary-default-btn transparent-btn">
                Sign in
            </button>
        </form>
    </article>
</x-guest-layout>
