<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use Laravel\Fortify\Contracts\EmailVerificationNotificationSentResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Define custom responses for Fortify actions

        // Redirect after login
        $this->app->instance(LoginResponse::class,
            new class implements LoginResponse {
                public function toResponse($request)
                {
                    return redirect()->route("page.home");
                }
            }
        );

        // Redirect after registration
        $this->app->instance(RegisterResponse::class,
            new class implements RegisterResponse {
                public function toResponse($request)
                {
                    return redirect()->route("verification.notice");
                }
            }
        );

        // Redirect after email verification
        $this->app->instance(VerifyEmailResponse::class,
            new class implements VerifyEmailResponse {
                public function toResponse($request)
                {
                    return redirect()->route("page.home");
                }
            }
        );

        // Notify about email verification link resent
        $this->app->instance(EmailVerificationNotificationSentResponse::class,
            new class implements EmailVerificationNotificationSentResponse {
                public function toResponse($request)
                {
                    return redirect()->route("verification.notice")
                        ->with("status", "verification-link-sent");
                }
            }
        );

        // Redirect after password reset
        $this->app->instance(ResetPasswordViewResponse::class,
            new class implements ResetPasswordViewResponse {
                public function toResponse($request)
                {
                    return redirect()->route("page.home");
                }
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configure Fortify features

        // Use custom classes for user creation, profile update, password update, and password reset
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Set up rate limiting for login attempts
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.
                $request->ip()
            );

            return Limit::perMinute(50)->by($throttleKey);
        });

        // Set up rate limiting for two-factor authentication
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(50)->by($request->session()->get('login.id'));
        });

        // Define custom views for Fortify actions

        // Login view
        Fortify::loginView(function () {
            return Inertia::render("Auth/User/UserLogin", [
                "status" => session('status') ?? '',
            ]);
        });

        // Registration view
        Fortify::RegisterView(function () {
            return Inertia::render("Auth/User/UserRegister");
        });

        // Email verification view
        Fortify::verifyEmailView(function () {
            return Inertia::render("Auth/VerifyEmail", [
                "status" => session('status') ?? '',
                "email"  => Auth::user()->email ?? '',
            ]);
        });

        // Password reset link request view
        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render("Auth/ForgotPassword", [
                'status' => session('status') ?? '',
            ]);
        });

        // Password reset view
        Fortify::resetPasswordView(function () {
            return Inertia::render("Auth/ResetPassword", [
                'reset_token' => request()->route('token'),
                'email'       => request()->email,
            ]);
        });
    }
}
