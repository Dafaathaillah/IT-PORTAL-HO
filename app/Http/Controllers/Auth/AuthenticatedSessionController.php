<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserAll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


function decodeJWT($token)
{
    try {
        $secretKey = env('JWT_SECRET');
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
        return (array) $decoded;
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): Response
    {
        $errorLoginUnamePasswr = $request->session()->get('errorLoginUnamePasswr', null);
        $errorMessage = $request->session()->get('errorMessage', null);
        $errorMessagePE = $request->session()->get('errorMessagePE', null);
        $errorLoginUnamePassnf = $request->session()->get('errorLoginUnamePassnf', null);
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'errorLoginUnamePasswr' => session('errorLoginUnamePasswr'),
            'errorMessage' => session('errorMessage'),
            'errorMessagePE' => session('errorMessagePE'),
            'errorLoginUnamePassnf' => session('errorLoginUnamePassnf'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $dataLogin = [
            'nrp' => $request->nrp,
            'password' => $request->password,
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ])->post('https://ict-auth.ppa-ho.net/auth', $dataLogin);

        if ($response['statusCode'] == 200) {
            $cookies = $response->cookies();
            foreach ($cookies as $cookie) {
                if ($cookie->getName() === 'access_token') {
                    $accessToken = $cookie->getValue();
                    break;
                }
            }
            if (isset($accessToken)) {
                // return dd($accessToken);
                $token = str_replace('Bearer ', '', $accessToken); // Hilangkan prefix "Bearer"
                $dataToArray = decodeJWT($token); // Panggil fungsi decode JWT

                $dataUser = User::where('nrp', $dataToArray['nrp'])->first();
                $dataUserAll = UserAll::where('nrp', $dataToArray['nrp'])->first();
                if ($dataUser) {
                    $dataUpdate = [
                        'password' => Hash::make($request->password),
                        'position' => $dataToArray['posisi'],
                        'department' => $dataToArray['dept'],
                        'email' => $dataToArray['email'],
                        'site' => $dataToArray['site'],
                    ];
                    $updateDatauser = User::firstWhere('nrp', $dataToArray['nrp'])->update($dataUpdate);
                    if ($dataUserAll) {
                        $dataUpdateUserAll = [
                            'nrp' => $dataToArray['nrp'],
                            'username' => $dataToArray['nama'],
                            'position' => $dataToArray['posisi'],
                            'department' => $dataToArray['dept'],
                            'email' => $dataToArray['email'],
                            'site' => $dataToArray['site'],
                        ];
                        $updateDatauserAll = UserAll::firstWhere('nrp', $dataToArray['nrp'])->update($dataUpdateUserAll);
                    } else {
                        $dataCreatedUserAll = [
                            'nrp' => $dataToArray['nrp'],
                            'username' => $dataToArray['nama'],
                            'position' => $dataToArray['posisi'],
                            'department' => $dataToArray['dept'],
                            'email' => $dataToArray['email'],
                            'site' => $dataToArray['site'],
                        ];
                        UserAll::create($dataCreatedUserAll);
                    }
                    $request->authenticate();

                    $request->session()->regenerate();

                    return redirect()->intended(route('home', absolute: false));
                } else {
                    $dataCreate = [
                        'name' => $dataToArray['nama'],
                        'nrp' => $dataToArray['nrp'],
                        'password' => Hash::make($request->password),
                        'position' => $dataToArray['posisi'],
                        'department' => $dataToArray['dept'],
                        'email' => $dataToArray['email'],
                        'site' => $dataToArray['site'],
                        'role' => 'guest', //masih default developer role
                    ];
                    User::create($dataCreate);

                    if (!$dataUserAll) {
                        $dataCreatedUserAll = [
                            'nrp' => $dataToArray['nrp'],
                            'username' => $dataToArray['nama'],
                            'position' => $dataToArray['posisi'],
                            'department' => $dataToArray['dept'],
                            'email' => $dataToArray['email'],
                            'site' => $dataToArray['site'],
                        ];
                        UserAll::create($dataCreatedUserAll);
                    } else {
                        $dataUpdateUserAll = [
                            'nrp' => $dataToArray['nrp'],
                            'username' => $dataToArray['nama'],
                            'position' => $dataToArray['posisi'],
                            'department' => $dataToArray['dept'],
                            'email' => $dataToArray['email'],
                            'site' => $dataToArray['site'],
                        ];
                        $updateDatauserAll = UserAll::firstWhere('nrp', $dataToArray['nrp'])->update($dataUpdateUserAll);
                    }

                    $request->authenticate();

                    $request->session()->regenerate();

                    return redirect()->intended(route('home', absolute: false));
                }
            }
        } elseif ($response['statusCode'] == 400) {
            $request->session()->flash('errorLoginUnamePasswr', 'NRP atau Password anda salah!');
            return redirect('/login');
        } elseif ($response['statusCode'] == 419) {
            $request->session()->flash('errorMessagePE', 'Terlalu banyak melakukan percobaan!');
            return redirect('/login');
        } elseif ($response['statusCode'] == 500) {
            $request->session()->flash('errorLoginUnamePassnf', 'Nrp tidak terdaftar!');
            return redirect('/login');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
        ])->delete('https://ict-auth.ppa-ho.net/auth/logout');
        if ($response['statusCode'] == 401) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        } elseif ($response['statusCode'] == 429) {
            $request->session()->flash('errorMessage', 'Terlalu banyak melakukan percobaan!');
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        }
    }
}
