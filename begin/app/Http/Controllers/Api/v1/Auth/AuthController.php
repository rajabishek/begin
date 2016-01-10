<?php

namespace Begin\Http\Controllers\Api\v1\Auth;

use Exception;
use Begin\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Begin\Http\Controllers\ApiController;
use Begin\Exceptions\ValidationException;
use Begin\Repositories\UserRepositoryInterface;
use Begin\Transformers\UserTransformer;

class AuthController extends ApiController
{
    /**
     * User repository.
     *
     * @var \Begin\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new AuthController instance.
     *
     * @param \Begin\Repositories\UserRepositoryInterface $tasks
     * @return void
     */
    function __construct(UserRepositoryInterface $users)
    {
        $this->middleware('jwt.auth', ['only' => ['validateToken','getUser']]);

        $this->users = $users;
    }

    /**
     * Get the authenticated user.
     *
     * @param \Begin\Transformers\UserTransformer $userTransformer
     * @return \Illuminate\Http\Response
     */
    public function getUser(UserTransformer $userTransformer)
    {
        $user = JWTAuth::parseToken()->authenticate();

        return $this->respondWithSuccess($userTransformer->transform($user->toArray()));
    }

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
    
            return $this->respondWithSuccess(compact('token'));
        }
        catch(ValidationException $e)
        {
            return $this->respondUnprocessableEntity($e->getErrors()->all());
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
        return $this->respondWithSuccess();
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
                'email' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:4',
            ]);

            $data = $request->only('name','email','password');
            $user = $this->users->create($data);
            
            $token = JWTAuth::fromUser($user);
            return $this->respondWithSuccess(compact('token'));
        }
        catch(ValidationException $e)
        {
            return $this->respondUnprocessableEntity($e->getErrors()->all());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }
}
