<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\School;

class SchoolRepository
{
    public function all($request)
    {
        $query = School::orderBy('name');

        if (\array_key_exists('school_name', $request)) {
            $query->where('name', 'ilike', '%'.$request['school_name'].'%');
        }

        if (\array_key_exists('city', $request)) {
            $query->where('city', 'ilike', '%'.$request['city'].'%');
        }

        if (\array_key_exists('country_id', $request)) {
            $query->where('country_id', '=', $request['country_id']);
        }

        if (\array_key_exists('school_type_id', $request) && !empty($request['school_type_id'])) {
            $query->where('school_type_id', '=', $request['school_type_id']);
        }

        if (\array_key_exists('school_status', $request) && !empty($request['school_status'])) {
            $query->where('school_status', '=', $request['school_status']);
        }

        if (\array_key_exists('sort', $request)) {
            $query->orderBy($request['sort']);
        }

        if (\array_key_exists('desc', $request)) {
            $query->orderBy($request['desc'], 'desc');
        }

        if (\array_key_exists('fields', $request)) {
            $fields = explode(',', $request['fields']);
            foreach ($fields as $field) {
                if ('users_count' === $field) {
                    $query->withCount('users');
                } else {
                    $query->addSelect(trim($field));
                }
            }
        }

        return $query->paginate(10);
    }

    public function get($schoolId, array $request): void
    {
    }

    public function update($schoolId, array $schoolData)
    {
        $school = School::find($schoolId);
        $school->fill($schoolData);
        $school->save();

        return $school;
    }

    public function destroy($schoolId): void
    {
        School::destroy($schoolId);
    }

    public function insert($schoolData)
    {
        $school = new School();
        $school->fill($schoolData);
        $school->save();

        return $school;
    }
}
