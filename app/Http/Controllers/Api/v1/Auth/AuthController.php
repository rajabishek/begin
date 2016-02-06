<?php

namespace Begin\Http\Controllers\Api\v1\Auth;

use Exception;
use Begin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Begin\Transformers\UserTransformer;
use Begin\Http\Controllers\ApiController;
use Begin\Exceptions\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Begin\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
        $this->middleware('auth:api', ['only' => ['validateToken','getUser']]);

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
        $user = Auth::user();

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

            if (!$token = Auth::attempt($credentials))
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
            
            $token = Auth::generateTokenById($user->id);
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