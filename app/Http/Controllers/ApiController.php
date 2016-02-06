<?php 

namespace Begin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Laravel\Lumen\Routing\Controller as BaseController;
use Begin\Exceptions\ValidationException;

class ApiController extends BaseController 
{
    /**
     * Default to status code of 200.
     *
     * @var integer
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator->errors());
    }

    /**
     * Gets the status code set on the instance for sending a response.
     *
     * @return void
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the status code on the instance.
     *
     * @return void
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond in json with the given data and headers.
     *
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Respond in json with the given data.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondWithSuccess($data = null)
    {
        if(is_null($data))
            return $this->respond(['success' => true]);

        return $this->respond(['success' => true,'data' => $data]);
    }

    /**
     * Respond in json with the given error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondWithError($errors)
    {
        $errors = is_string($errors) ? [$errors] : $errors;
        
        return $this->respond(['success' => false,'errors' => $errors]);
    }

    /**
     * Respond in json with not found error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondNotFound($errors = "Not Found.")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
                    ->respondWithError($errors);
    }

    /**
     * Respond in json with an internal error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondInternalError($errors = "An unknown error occured, try sometime later.")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError($errors);
    }

    /**
     * Respond in json with a bad request error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondBadRequest($errors)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)
                    ->respondWithError($errors);
    }

    /**
     * Respond in json indicating failure in valiudating the input.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondUnprocessableEntity($errors)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
                    ->respondWithError($errors);
    }

    /**
     * Respond in json with an unauthorised request error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondUnauthorizedRequest($errors)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)
                    ->respondWithError($errors);
    }

    /**
     * Respond in json with a forbidden request error.
     *
     * @param  array  $errors
     * @return \Illuminate\Http\Response
     */
    public function respondForbidden($errors = "You don't have permissions to access this."){
        
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)
                    ->respondWithError($errors);
    }
}