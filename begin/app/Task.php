<?php

namespace Begin;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description','completed'];

    /**
     * Get the user who created the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function user()
    {
        return $this->belongsTo('Begin\User');
    }
}
