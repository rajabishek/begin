<?php 

namespace Begin\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Begin\Transformers\TaskTransformer;
use Begin\Http\Controllers\ApiController;
use Begin\Repositories\TaskRepositoryInterface;
use Begin\Exceptions\ValidationException;
use Begin\Exceptions\TaskNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TasksController extends ApiController 
{
    /**
     * Task repository.
     *
     * @var \Begin\Repositories\TaskRepositoryInterface
     */
    protected $tasks;

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
     * @param \Begin\Repositories\TaskRepositoryInterface $tasks
     * @param \Begin\Transformers\TaskTransformer $taskTransformer
     * @return void
     */
    function __construct(TaskRepositoryInterface $tasks, TaskTransformer $taskTransformer)
    {
        
        $this->middleware('auth:api');

        $this->tasks = $tasks;
        $this->taskTransformer = $taskTransformer;
    }

    /**
     * Get the authenticated user by parsing the token from the request.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    protected function getAuthenticatedUser()
    {
        return Auth::user();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'title' => 'required|max:255', 
                'description' => 'required',
            ]);

            $data = $request->only('title','description');
            $user = $this->getAuthenticatedUser();
            $task = $this->tasks->create($user, $data);

            return $this->respondWithSuccess($this->taskTransformer->transform($task->toArray()));
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

    /**
     * Get the list of all pending tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $user = $this->getAuthenticatedUser();
            $tasks = $this->tasks->findAllForUser($user);

            return $this->respondWithSuccess($this->taskTransformer->transformCollection($tasks->toArray()));
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Get the list of all pending tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPending()
    {
        try
        {
            $user = $this->getAuthenticatedUser();
            $tasks = $this->tasks->findAllPendingForUser($user);

            return $this->respondWithSuccess($this->taskTransformer->transformCollection($tasks->toArray()));
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Get the list of all pending tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompleted()
    {
        try
        {
            $user = $this->getAuthenticatedUser();
            $tasks = $this->tasks->findAllCompletedForUser($user);

            return $this->respondWithSuccess($this->taskTransformer->transformCollection($tasks->toArray()));
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $user = $this->getAuthenticatedUser();
            $task = $this->tasks->findByIdForUser($id, $user);
            
            return $this->respondWithSuccess($this->taskTransformer->transform($task->toArray()));
        }
        catch(TaskNotFoundException $e)
        {
            return $this->respondNotFound($e->getMessage());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $this->validate($request, [
                'title' => 'required|max:255', 
                'description' => 'required|max:255', 
                'completed' => 'boolean',
            ]);

            $data = $request->only('title','description','completed');
            $user = $this->getAuthenticatedUser();
            
            $task = $this->tasks->findByIdForUser($id, $user);
            $task = $this->tasks->edit($task, $data);
            
            return $this->respondWithSuccess($this->taskTransformer->transform($task->toArray()));
        }
        catch(ValidationException $e)
        {
            return $this->respondUnprocessableEntity($e->getErrors()->all());
        }
        catch(TaskNotFoundException $e)
        {
            return $this->respondNotFound($e->getMessage());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $user = $this->getAuthenticatedUser();
            
            $task = $this->tasks->findByIdForUser($id, $user);
            $task->delete();
            
            return $this->respondWithSuccess($this->taskTransformer->transform($task->toArray()));
        }
        catch(TaskNotFoundException $e)
        {
            return $this->respondNotFound($e->getMessage());
        }
        catch(Exception $e)
        {
            return $this->respondInternalError();
        }
    }
}