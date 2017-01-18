<?php

namespace App\Entities\Elp;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'op_elp_headers';

    public $incrementing = false;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /*protected $visible = [
        'issue_number',
    ];*/

    protected $casts = [
        'issued' => 'boolean',
    ];

    protected $appends = [
        'type_text',
    ];

    public function getTypeTextAttribute()
    {
        return ($this->type === 'I' ? 'Emisión' : 'Cotización');
    }
}
