<div class="container">
    <div class="row justify-content-center">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form action="{{ route("{$type}.login") }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                placeholder="Enter your email" 
                                value="{{ old('email') }}" 
                                required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password" 
                                required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input @error('remember') is-invalid @enderror" 
                                id="remember" 
                                name="remember" 
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>

            <!-- Forgot Password Link -->
            <div class="text-center mt-3">
                <a href="/password/reset">Forgot Password?</a>
            </div>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="{{ route("{$type}.create") }}">Register here</a></p>
            </div>
        </div>
    </div>
</div>
