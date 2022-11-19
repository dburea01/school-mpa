<?php
namespace App\Http\Controllers;

use App\Models\UserSubject;
use App\Http\Requests\StoreUserSubjectRequest;
use App\Models\User;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\DB;

class UserSubjectController extends Controller
{
    private $userSubjectRepository;
    private $subjectRepository;

    public function __construct(
        SubjectRepository $subjectRepository
    ) {
        $this->subjectRepository = $subjectRepository;
        $this->authorizeResource(UserSubject::class);
    }

    public function index(User $user)
    {
        return view('user_subjects.user_subjects', [
            'user' => $user,
            'userSubjects' => $this->userSubjectRepository->getSubjects($user),
            'subjects' => $this->subjectRepository->all(),
        ]);
    }

    public function store(User $user, StoreUserSubjectRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->userSubjectRepository->destroyAllSubjects($user);
            if ($request->has('subjects')) {
                foreach ($request->subjects as $subjectId => $value) {
                    $this->userSubjectRepository->insert($user, $subjectId);
                }
            }
            DB::commit();
            return redirect("/users/$user->id/user-subjects")
            ->with('success', trans('user_subjects.modification_done'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
