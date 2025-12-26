<?php
namespace App\Http\Controllers\Auth;

            use App\Http\Controllers\Controller;
            use App\Models\User;
            use Illuminate\Http\RedirectResponse;
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Str;
            use Laravel\Socialite\Facades\Socialite;

            class SocialLoginController extends Controller
            {
                /**
                 * Redirect to Google OAuth.
                 */
                public function redirectToGoogle(): RedirectResponse
                {
                    return Socialite::driver('google')->redirect();
                }

                /**
                 * Handle Google callback.
                 */
                public function handleGoogleCallback(): RedirectResponse
                {
                    $googleUser = Socialite::driver('google')->stateless()->user();

                    $user = User::updateOrCreate(
                        ['email' => $googleUser->getEmail()],
                        [
                            'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'مستخدم جديد',
                            'password' => bcrypt(Str::random(32)),
                        ]
                    );

                    Auth::login($user, true);

                    $target = $user->role === 'admin' ? route('dashboard', absolute: false) : route('home', absolute: false);

                    return redirect()->intended($target);
                }
            }
