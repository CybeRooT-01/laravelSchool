<?php

namespace App\Traits;

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
}
