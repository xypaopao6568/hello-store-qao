<x-app-layout>
    <section class="login my-4">
        <div class="container">
            <div class="row">
                <div class="title-page">
                    <h4>Login</h4>
                </div>

                <div class="col-md-6 d-flex justify-content-end">

                    <form method="POST" action="{{ route('login') }}" class="col-md-8">
                        @csrf
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <x-jet-validation-errors class="mb-4" />
                        <div>
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="current-password" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn btn-block my-2">Login</button>
                        @if (Route::has('password.request'))
                            <div class="text-center my-3">
                                <a class="" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-md-6 d-flex justify-content-start">
                    <div class="row">

                        <div class="col-md-12 d-flex justify-content-center flex-column">
                            <h3 class="text-center w-100">Or Login With</h3>
                            <div class="row-social">
                                <a class="btn-social btn-fb" href="{{ url('auth/facebook') }}">
                                    <i class="fa fa-facebook-f"></i>
                                </a>
                                <a class="btn-social btn-tw" href="{{ url('auth/facebook') }}">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <h3 class="text-center w-100">Chưa có tài khoản?</h3>
                            <div class="row-social">
                                <a class="site-btn" href="{{ route('register') }}">
                                    Tạo Ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
