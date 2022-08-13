<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destinations extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'property_id', 'bu_git_id'];

    protected $searchableFields = ['*'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function buGit()
    {
        return $this->belongsTo(BuGit::class);
    }
}
