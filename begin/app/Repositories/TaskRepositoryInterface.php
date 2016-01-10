<?php 

namespace Begin\Repositories;

use Begin\User;
use Begin\Task;

interface TaskRepositoryInterface
{
    /**
     * Create a new task for the given user.
     *
     * @param  \Begin\User $user
     * @param  array $data
     * @return \Begin\Task
     */
    public function create(User $user, array $data);

    /**
     * Update the task details.
     *
     * @param  \Begin\Task $task
     * @param  array $data
     * @return \Begin\Task
     */
    public function edit(Task $task, array $data);

    /**
     * Find the task with the specified id for the given user
     *
     * @param  integer $taskId
     * @param  \Begin\User $user
     * @return \Begin\Task
     */
    public function findByIdForUser($taskId, User $user);

    /**
     * Find all tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllForUser(User $user);

    /**
     * Find all pending tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllPendingForUser(User $user);

    /**
     * Find all completed tasks for the given user.
     *
     * @param  \Begin\User $user
     * @return \Begin\Task[]
     */
    public function findAllCompletedForUser(User $user);

    /**
     * Toggle the completion status for the given task.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function toggleCompletion(Task $task);

    /**
     * Mark the given task as completed.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function markAsCompleted(Task $task);

    /**
     * Mark the given task as pending.
     *
     * @param  \Begin\Task $task
     * @return \Begin\Task
     */
    public function markAsPending(Task $task);
}