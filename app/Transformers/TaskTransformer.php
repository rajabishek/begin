<?php 

namespace Begin\Transformers;

use Begin\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract 
{
    public function transform(Task $task)
    {
        return [
            'id'           => $task->id,
            'title'         => $task->title,
            'description'  => $task->description,
        ];
    }
}