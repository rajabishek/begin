<?php 

namespace Begin\Repositories\Eloquent;

use Begin\User;
use Begin\Task;
use Begin\Repositories\TaskRepositoryInterface;
use Begin\Repositories\UserRepositoryInterface;
use Begin\Exceptions\TaskNotFoundException;

class TaskRepository extends AbstractRepository implements TaskRepositoryInterface
{

    /**
     * User repository.
     *
     * @var \Begin\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new DbTaskRepository instance.
     *
     * @param  \Begin\Task  $task
     * @return void
     */
    public function __construct(Task $task, UserRepositoryInterface $users)
    {
        $this->model = $task;
        $this->users = $users;
    }

    /**
     * Create a new task for the given user.
     *
     * @param  \Begin\User $user
     * @param  array $data
     * @return \Begin\Task
     */
    public function create(User $user, array $data)
    {    
        $task = $this->getNew();

        $task->title = $data['title'];
        $task->description = $data['description'];
        
        $user->tasks()->save($task);

        $task->save();

        return $task;
    }

    /**
     * Update the task details.
     *
     * @param  \Begin\Task $task
     * @param  array $data
     * @return \Begin\Task
     */
    public function edit(Task $task, array $data)
    {
        if(isset($data['title']))
            $task->title = $data['title'];

        if(isset($data['description']))
            $task->description = $data['description'];

        if(isset($data['completed']))
            $task->completed = $data['completed'];

        $task->save();

        return $task;
    }

    /**
     * Find the task with the specified id for the given user
     *
     * @param  integer $taskId
     * @param  \Begin\User $user
     * @return \Begin\Task
     */
    public function findByIdForUser($taskId, User $user)
    {    
        $task = $user->tasks()->find($taskId);

        if(is_null($task))
            throw new TaskNotFoundException("The task you are looking for does not exist");

        return $task;
    }

    /**
     * Find all tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllForUser(User $user)
    {
        $tasks = $user->tasks()->orderBy('created_at','desc')
                               ->get();
        return $tasks;
    }

    /**
     * Find all pending tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllPendingForUser(User $user)
    {
        $tasks = $user->tasks()->where('completed',false)
                               ->orderBy('created_at','desc')
                               ->get();
        return $tasks;
    }

    /**
     * Find all completed tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllCompletedForUser(User $user)
    {
        $tasks = $user->tasks()->where('completed',true)
                               ->orderBy('created_at','desc')
                               ->get();
        return $tasks;
    }

    /**
     * Toggle the completion status for the given task.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function toggleCompletion(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        return $task;
    }

    /**
     * Mark the given task as completed.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function markAsCompleted(Task $task)
    {
        $task->completed = true;
        $task->save();

        return $task;
    }

    /**
     * Mark the given task as pending.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function markAsPending(Task $task)
    {
        $task->completed = false;
        $task->save();

        return $task;
    }
}
