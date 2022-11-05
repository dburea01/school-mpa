<?php
namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository
{
    public function all()
    {
        return Subject::orderBy('short_name')->get();
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->fill($data);

        $subject->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $subject->save();

        return $subject;
    }

    public function destroy(Subject $subject): void
    {
        $subject->delete();
    }

    public function insert(array $data): Subject
    {
        $subject = new Subject();
        $subject->fill($data);
        $subject->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $subject->save();

        return $subject;
    }
}
