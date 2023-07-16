<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait JoinQueryParams
{

    public function joinClasses($query)
    {
        if (request()->has('join') && request()->get('join') === 'classes') {
            $query->with('classes');

            if (request()->has('eleve')) {
                $query->with('classes.inscriptions.eleve');
                if(request()->has('notes')){
                    $query->with('classes.inscriptions.notes');
                }
            }
        }
        return $query;
    }
    //     public function loadData($query, $relations)
    // {
    // foreach ($relations as $relation) {
    // // if ($this->hasJoin($relation)) {
    // // $query->with($relation);
    // // }
    // $query->when(
    // $this->hasJoin($relation),
    // // fn ($q) => is_subclass_of($query,Model::class) ?$q->with($relation): $q->load($relation)
    // fn ($q) => $query instanceof Model ? $query->load($relation) : $q->with($relation)
    // );
    // }
    // return $query;
    // }
    // public function loadData(Model|QueryBuilder|EloquentBuilder|HasMany $query, ?array $relations = null): Model|QueryBuilder|EloquentBuilder|HasMany
    // {

    //     $relations = $relations ?? $this->relationsAutorise ?? [];
    //     foreach ($relations as $relation) {
    //         $query->when(
    //             $this->hasJoin($relation),
    //             fn ($q) => $query instanceof Model ? $query->load($relation) : $q->with($relation)
    //         );
    //     }
    //     return $query;
    // }

    // public function hasJoin($relation): bool
    // {
    //     $join = request()->input('join');
    //     if (!$join) {
    //         return false;
    //     }
    //     $tabjoin = array_map('trim', explode(',', $join));
    //     return in_array($relation, $tabjoin);
    // }
}
