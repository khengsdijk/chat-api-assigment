<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    public $timestamps = false;

    protected $fillable = [
        'sender', 'receiver', 'content', 'timestamp'
    ];
}
