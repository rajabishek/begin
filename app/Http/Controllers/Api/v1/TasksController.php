<?php 

namespace Begin\Http\Controllers\Api\v1;

use Begin\Transformers\TaskTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Begin\Http\Controllers\ApiController;
use Tymon\JWTAuth\Facades\JWTAuth;

class TasksController extends ApiController 
{
    /**
     * Authenticated user.
     *
     * @var \Begin\User
     */
    protected $user;

    /**
     * Fractal manager to create the data.
     *
     * @var \League\Fractal\Manager
     */
    protected $fractal;

    /**
     * Task transformer.
     *
     * @var \Begin\Transformers\TaskTransformer
     */
    protected $taskTransformer;

    /**
     * Create a new TasksController instance.
     *
     * @param \Begin\Task $task
     * @param \League\Fractal\Manager $fractal
     * @param \Begin\Transformers\TaskTransformer $taskTransformer
     * @return void
     */
    function __construct(Manager $fractal, TaskTransformer $taskTransformer)
    {
        $this->fractal = $fractal;
        $this->taskTransformer = $taskTransformer;
    }

    /**
     * Get the authenticated user by parsing the token from the request.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    protected function getAuthenticatedUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    /**
     * Get the list of all tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->getAuthenticatedUser()->tasks()->all();

        $collection = new Collection($tasks, $this->taskTransformer);

        $data = $this->fractal->createData($collection)->toArray();

        return $this->respond($data);
    }

    /**
     * Get the specific task from the database.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->getAuthenticatedUser()->tasks()->findOrFail($id);

        $item = new Item($task, $this->taskTransformer);

        $data = $this->fractal->createData($item)->toArray();

        return $this->respond($data);
    }
}