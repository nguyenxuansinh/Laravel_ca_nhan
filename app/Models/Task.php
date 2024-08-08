<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = ['name','content','status'];
    
    public function scopesearch_and_list(Builder $query, string $searchTerm = null, string $selectedValue = null): LengthAwarePaginator
    {
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($selectedValue)) {
            $query->where('status', $selectedValue);
        }

        return $query->paginate(10);
    }
    public function scopesearch_and_list2(Builder $query, $key_search = []): LengthAwarePaginator
    {
        if (!empty($key_search['searchTerm'])) {
            $query->where(function ($query) use ($key_search) {
                $query->where('name', 'like', '%' . $key_search['searchTerm'] . '%')
                      ->orWhere('content', 'like', '%' . $key_search['searchTerm'] . '%');
            });
        }
    
        if (!empty($key_search['selectedValue'])) {
            $query->where('status', $key_search['selectedValue']);
        }

        return $query->paginate(10);
    }
}
