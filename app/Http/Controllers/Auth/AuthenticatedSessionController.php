<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
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
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
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
        ])->post('https://apikong.transformore.net/ict/auth/v1/auth', $dataLogin);

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
                if ($dataUser) {
                    $dataUpdate = [
                        'password' => Hash::make($request->password),
                        'position' => $dataToArray['posisi'],
                        'department' => $dataToArray['dept'],
                        'email' => $dataToArray['email'],
                        'site' => $dataToArray['site'],
                    ];
                    $updateDatauser = User::firstWhere('nrp', $dataToArray['nrp'])->update($dataUpdate);

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
                        'role' => 'ict_developer', //masih default developer role
                    ];
                    User::create($dataCreate);

                    $request->authenticate();

                    $request->session()->regenerate();

                    return redirect()->intended(route('home', absolute: false));
                }
            }
        } else {
            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(route('home', absolute: false));
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
        ])->delete('https://apikong.transformore.net/ict/auth/v1/auth/logout');
        if ($response['statusCode'] == 401) {
            Auth::guard('web')->logout();
    
            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/login');
        }
    }
}
