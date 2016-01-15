<?php 

namespace Begin\Transformers;

use Begin\Task;

class TaskTransformer extends Transformer 
{
    /**
     * Transform the given task
     *
     * @param array $task
     * @return array
     */
    public function transform($task)
    {
        return [
            'id' => intval($task['id']),
            'title' => $task['title'],
            'description' => $task['description'],
            'completed' => isset($task['completed']) ? (bool)$task['completed'] : false,
        ];
    }
}