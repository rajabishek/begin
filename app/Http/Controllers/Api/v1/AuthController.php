<?php

namespace Begin\Http\Controllers\Api\v1;

use Exception;
use Begin\User;
use Begin\Http\Controllers\ApiController;
use Begin\Exceptions\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exception\HttpResponseException;

class AuthController extends ApiController
{
    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        try
        {
            $this->validate($request, [
                'email' => 'required|email|max:255', 
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (!$token = JWTAuth::attempt($credentials))
                    return $this->respondUnauthorizedRequest($this->getFailedLoginMessage());
    
            return $this->respond(['success' => true, 'token' => $token]);
        }
        catch(ValidationException $e)
        {
            return $this->respondBadRequest($e->getErrors()->all());
        }
        catch (JWTException $e)
        {
            return $this->respondInternalError('Sorry could not create a token.');
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'Invalid credentials.';
    }

    /**
     * Validate the given json web token.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateToken() 
    {
        // jwt.refresh should have already authenticated this token
        return $this->respond(['sucess' => true]);
    }

    /**
     * Handle a registration request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        try
        {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:4',
            ]);

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);
            
            $token = JWTAuth::fromUser($user);
            return $this->respond(['success' => true, 'token' => $token]);
        }
        catch(ValidationException $e)
        {
            return $this->respondBadRequest($e->getErrors()->all());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }
}
