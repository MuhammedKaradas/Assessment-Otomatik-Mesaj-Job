<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['unique_message_id', 'contact_id', 'template_id', 'status', 'queue_send_date', 'sent_date'];
}
