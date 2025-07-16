<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .slide-in {
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .pulse-glow {
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-10 rounded-full floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white opacity-5 rounded-full floating-animation"
            style="animation-delay: -3s;"></div>
        <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white opacity-10 rounded-full floating-animation"
            style="animation-delay: -1s;"></div>
    </div>

    <div class="w-full max-w-md">
        <div class="text-center mb-8 slide-in">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-2xl mb-6 pulse-glow">
                <img src="{{ asset('theme/assets/img/logo.png') }}" alt="Company Logo"
                    class="w-12 h-12 rounded-full object-cover">
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Diskominfo</h1>
            <p class="text-white/80">Sign in to your account to continue</p>
        </div>

        <div class="glass-effect rounded-2xl p-8 shadow-2xl slide-in" style="animation-delay: 0.2s;">
            <div id="sessionStatus"
                class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg hidden">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Login successful!</span>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" id="email" name="email" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-white/40 transition-all duration-300 input-focus"
                        placeholder="Enter your email">
                    <div class="mt-2 text-red-300 text-sm hidden" id="emailError">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        <span>Please enter a valid email address</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white text-sm font-medium mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-white/40 transition-all duration-300 input-focus pr-12"
                            placeholder="Enter your password">
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60 hover:text-white transition-colors">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <div class="mt-2 text-red-300 text-sm hidden" id="passwordError">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        <span>Password is required</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <button type="submit"
                        class="w-full bg-white text-gray-800 py-3 px-4 rounded-lg font-semibold hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white/30 transform transition-all duration-300 hover-lift shadow-lg"
                        id="submitBtn">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </button>
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}"
                                class="text-white/80 hover:text-white text-sm underline transition-colors duration-300">
                                <i class="fas fa-key mr-1"></i>
                           
                            </a>
                        </div>
                    @endif
                </div>
            </form>


            <div class="text-center mt-8">
                <p class="text-white/60 text-sm">
                    © 2025 Diskominfo. All rights reserved.
                </p>
            </div>
        </div>

        <script>
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    eyeIcon.className = 'fas fa-eye';
                } else {
                    eyeIcon.className = 'fas fa-eye-slash';
                }
            });

            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            form.addEventListener('submit', function(e) {
                let isValid = true;

                emailError.classList.add('hidden');
                passwordError.classList.add('hidden');

                if (!emailInput.value || !validateEmail(emailInput.value)) {
                    emailError.classList.remove('hidden');
                    isValid = false;
                }

                if (!passwordInput.value) {
                    passwordError.classList.remove('hidden');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });

            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-white/30');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-white/30');
                });
            });
        </script>
</body>

</html>
