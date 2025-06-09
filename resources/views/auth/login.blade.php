<x-client>
    <div class="container justify-center flex items-center py-10">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-black">
                    <div class="">
                        <form method="POST" action="{{ route('bootstrap') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Mail') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control indent-2 text-black rounded-md border border-gray-600 focus:outline-gasendra-yellow-primary @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Pass') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control indent-2 text-black rounded-md border border-gray-600 focus:outline-gasendra-yellow-primary @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onclick="reveal()">
                                        <label class="form-check-label" for="remember">
                                            {{ __('Reveal') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Ingat akses') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="p-2 bg-gasendra-yellow-primary hover:bg-slate-700 rounded-lg text-white hover:text-white duration-150 w-full font-medium">
                                        {{ __('Masuk') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client>

@section('script')
    <script>
        function reveal() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
