<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\DestinationReview;
use App\BackendModel\EmailNotification;
use App\BackendModel\SocialLogin;
use App\Mail\DestinationReviewNotification;
use App\Mail\UserEmailVerification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if ($request->method() == 'GET')
            return view('frontend.login');
        else {
            $remember = false;
            if (isset($request->remember)) {
                $remember = true;
            }

            $check = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $remember);
            if ($check) {
                if (Auth::user()->email_status == 'inactive') {
                    Auth::logout();
                    return redirect()->back()->with('login-validation-message', 'You have not activated your account')->withInput();
                } else if (Auth::user()->status == 'inactive') {
                    Auth::logout();
                    return redirect()->back()->with('login-validation-message', 'You have been suspended !')->withInput();
                } else {
                    if ($request->session()->has('sessionForDestinationReview')) {
                        $reviewData = $request->session()->get('sessionForDestinationReview');
                        $reviewData['user_id'] = Auth::user()->id;
                        DestinationReview::create($reviewData);
                        if (EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null) {
                            Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($reviewData));
                        }
                        $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
                        $request->session()->forget('sessionForDestinationReview');
                        $request->session()->forget('sessionForDestinationReviewUrl');
                        return redirect($redirectUrl)->with('review-redirect-message', 'review');
                    }

                    if ($request->session()->has('redirectToFeedback')) {
                        $request->session()->forget('redirectToFeedback');
                        return redirect('feedback');
                    }

                    return redirect('my-account');
                }
            } else {
                return redirect()->back()->with('login-validation-message', 'Invalid credential')->withInput();
            }
        }
    }

    public function generateUniqueEmailVerificationToken()
    {
        $token = uniqid() . time() . uniqid();
        if (User::where('email_verification_token', $token)->count() > 0) {
            $this->generateUniqueEmailVerificationToken();
        }
        return $token;
    }


    public function register(Request $request)
    {
        if ($request->method() == 'GET')
            return view('frontend.register');
        else {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:user',
                'password' => 'required'
            ]);

            $token = $this->generateUniqueEmailVerificationToken();

            $data = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'email_verification_token' => $token
            ];


            $created = User::create($data);

            Mail::to($request->email)->send(new UserEmailVerification($data));

            if ($request->session()->has('sessionForDestinationReview')) {
                $reviewData = $request->session()->get('sessionForDestinationReview');
                $reviewData['user_id'] = $created->id;
                DestinationReview::create($reviewData);
                if (EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null) {
                    Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($reviewData));
                }
                $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
                $request->session()->forget('sessionForDestinationReview');
                $request->session()->forget('sessionForDestinationReviewUrl');
                return redirect($redirectUrl)->with('review-redirect-message', 'register-review');
            }

            return redirect('activate-your-account/' . $created->id)->with('reg-token', '1');
        }
    }

    public function sendEmail()
    {
//        $this->generateUniqueEmailVerificationToken();
//        return view('email-templates.user-email-verification');
//        Mail::to('es.niramal.basnet@gmail.com')->send(new UserEmailVerification());
//        Mail::raw('Hi, welcome user!', function ($message) {
//            $message->to('es.niramal.basnet@gmail.com')
//                ->subject('Test Email sending');
//        });
    }

    public function resendActivationLink(Request $request)
    {
        $email = $request->email;

        if (User::where('email', $email)->count() == 0) {
            return 'not-found';
        }

        $user = User::where('email', $email)->first();
        $token = $this->generateUniqueEmailVerificationToken();

        User::find($user->id)->update([
            'email_verification_token' => $token
        ]);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'email_verification_token' => $token
        ];

        Mail::to($request->email)->send(new UserEmailVerification($data));

        return 'success';
    }

    public function emailVerification(Request $request)
    {
        $token = $request->token;
        if (User::where('email_verification_token', $token)->count() == 0) {
            return redirect('token-expired');
        }

        $user = User::where('email_verification_token', $token)->first();

        User::find($user->id)->update([
            'email_status' => 'active'
        ]);

        Auth::login($user);

        if ($request->session()->has('sessionForDestinationReview')) {
            $reviewData = $request->session()->get('sessionForDestinationReview');
            $reviewData['user_id'] = $user->id;
            DestinationReview::create($reviewData);
            $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
            $request->session()->forget('sessionForDestinationReview');
            $request->session()->forget('sessionForDestinationReviewUrl');
            return redirect($redirectUrl)->with('review-redirect-message', 'review');
        }

        if ($request->session()->has('redirectToFeedback')) {
            $request->session()->forget('redirectToFeedback');
            return redirect('feedback');
        }

        return redirect('my-account');
    }

    public function tokenExpired()
    {
        return view('frontend.token-expired');
    }

    public function myAccount()
    {
        $user = Auth::user();
        return view('frontend.my-account', compact('user'));
    }

    public function updateMyAccount(Request $request)
    {
        $user = Auth::user();
        $originalEmail = $user->email;
        if ($request->email == $originalEmail) {
            $this->validate($request, [
                'name' => 'required'
            ]);
            User::find($user->id)->update([
                'name' => $request->name
            ]);

            return redirect('my-account');
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:user'
        ]);

        $token = $this->generateUniqueEmailVerificationToken();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verification_token' => $token,
            'email_status' => 'inactive'
        ];


        User::find($user->id)->update($data);

        Mail::to($request->email)->send(new UserEmailVerification($data));

        Auth::logout();

        return redirect('login')->with('login-validation-message', 'Visit your email and verify your account');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {
            User::find(Auth::id())->update(['password' => $request->new_password]);
            return redirect()->back()->withSuccess('Password successfully changed');
        } else {
            $errors = new MessageBag();
            $errors->add('current_password', 'Incorrect current password');
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }


    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider, Request $request)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $providerId = $providerUser->id;
        $providerEmail = $providerUser->email;
        $providerName = $providerUser->name;
        if (SocialLogin::where('provider_id', $providerId)->first() != null) {
            $userId = SocialLogin::where('provider_id', $providerId)->first()->user_id;
            $dbUser = User::find($userId);
            if ($dbUser->suspend == 'Yes') {
                Auth::logout();
                return redirect('login')->with('login-validation-message', 'You have been suspended !')->withInput();
            } else {
                Auth::login($dbUser);
                if ($request->session()->has('sessionForDestinationReview')) {
                    $reviewData = $request->session()->get('sessionForDestinationReview');
                    $reviewData['user_id'] = Auth::user()->id;
                    DestinationReview::create($reviewData);
                    if (EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null) {
                        Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($reviewData));
                    }
                    $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
                    $request->session()->forget('sessionForDestinationReview');
                    $request->session()->forget('sessionForDestinationReviewUrl');
                    return redirect($redirectUrl)->with('review-redirect-message', 'review');
                }

                if ($request->session()->has('redirectToFeedback')) {
                    $request->session()->forget('redirectToFeedback');
                    return redirect('feedback');
                }

                return redirect('my-account');
            }
        } else {
            $check = User::where('email', $providerEmail)->first();
            if ($check != null) {
                if ($check->suspend == 'Yes') {
                    Auth::logout();
                    return redirect('login')->with('login-validation-message', 'You have been suspended !')->withInput();
                } else {
                    Auth::login($check);
                    if ($request->session()->has('sessionForDestinationReview')) {
                        $reviewData = $request->session()->get('sessionForDestinationReview');
                        $reviewData['user_id'] = Auth::user()->id;
                        DestinationReview::create($reviewData);
                        if (EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null) {
                            Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($reviewData));
                        }
                        $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
                        $request->session()->forget('sessionForDestinationReview');
                        $request->session()->forget('sessionForDestinationReviewUrl');
                        return redirect($redirectUrl)->with('review-redirect-message', 'review');
                    }

                    if ($request->session()->has('redirectToFeedback')) {
                        $request->session()->forget('redirectToFeedback');
                        return redirect('feedback');
                    }

                    return redirect('my-account');
                }
            } else {
                $userArrayData = [
                    'name' => $providerName,
                    'email' => $providerEmail,
                    'avatar' => isset($providerUser->avatar) && $providerUser->avatar != '' && $providerUser->avatar != null ? $providerUser->avatar : null,
                    'email_status ' => 'active'
                ];

                $result = User::create($userArrayData);

                $providerInfo = [
                    'provider_id' => $providerId,
                    'user_id' => $result->id,
                    'provider_type' => $provider
                ];

                $providerResult = SocialLogin::create($providerInfo);

                Auth::login($result);

                if ($request->session()->has('sessionForDestinationReview')) {
                    $reviewData = $request->session()->get('sessionForDestinationReview');
                    $reviewData['user_id'] = Auth::user()->id;
                    DestinationReview::create($reviewData);
                    if (EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null) {
                        Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($reviewData));
                    }
                    $redirectUrl = $request->session()->get('sessionForDestinationReviewUrl');
                    $request->session()->forget('sessionForDestinationReview');
                    $request->session()->forget('sessionForDestinationReviewUrl');
                    return redirect($redirectUrl)->with('review-redirect-message', 'review');
                }

                if ($request->session()->has('redirectToFeedback')) {
                    $request->session()->forget('redirectToFeedback');
                    return redirect('feedback');
                }

                return redirect('my-account');
            }
        }
    }
}
