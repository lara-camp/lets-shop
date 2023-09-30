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
        $this->app->instance(LoginResponse::class,
            new class implements LoginResponse {
                public function toResponse($request)
                {
                    return redirect()->route("page.home");
                }
            }
        );

        $this->app->instance(RegisterResponse::class,
            new class implements RegisterResponse {
                public function toResponse($request)
                {
                    return redirect()->route("verification.notice");
                }
            }
        );

        $this->app->instance(VerifyEmailResponse::class,
            new class implements VerifyEmailResponse {
                public function toResponse($request)
                {
                    return redirect()->route("page.home");
                }
            }
        );

        $this->app->instance(EmailVerificationNotificationSentResponse::class,
            new class implements EmailVerificationNotificationSentResponse {
                public function toResponse($request)
                {
                    return redirect()->route("verification.notice")
                        ->with("status", "verification-link-sent");
                }
            }
        );

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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.
                $request->ip()
            );

            return Limit::perMinute(100)->by($throttleKey);
        });
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::loginView(function () {
            return Inertia::render("Auth/User/UserLogin", [
                "status" => session('status') ?? '',
            ]);
        });
        Fortify::RegisterView(function () {
            return Inertia::render("Auth/User/UserRegister");
        });
        Fortify::verifyEmailView(function () {
            return Inertia::render("Auth/VerifyEmail", [
                "status" => session('status') ?? '',
                "email"  => Auth::user()->email ?? '',
            ]);
        });
        Fortify::requestPasswordResetLinkView(function () {
            return Inertia::render("Auth/ForgotPassword", [
                'status' => session('status') ?? '',
            ]);
        });
        Fortify::resetPasswordView(function () {
            return Inertia::render("Auth/ResetPassword", [
                'reset_token' => request()->route('token'),
                'email'       => request()->email,
            ]);
        });
    }
}
