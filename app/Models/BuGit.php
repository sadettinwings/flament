<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuGit extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['owner_id'];

    protected $searchableFields = ['*'];

    protected $table = 'bu_gits';

    public function destinations()
    {
        return $this->hasOne(Destinations::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function users()
    {
        return $this->morphMany(User::class, 'userable');
    }
}
