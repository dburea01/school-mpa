<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreAppreciationRequest;
use App\Models\Appreciation;
use App\Repositories\AppreciationRepository;

class AppreciationController extends Controller
{
    private $appreciationRepository;

    public function __construct(AppreciationRepository $appreciationRepository)
    {
        $this->authorizeResource(Appreciation::class);
        $this->appreciationRepository = $appreciationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('appreciations.appreciations', [
            'appreciations' => $this->appreciationRepository->all(),
        ]);
    }

    public function create()
    {
        $appreciation = new Appreciation();
        $appreciation->status = 'ACTIVE';

        return view('appreciations.appreciation_form', [
            'appreciation' => $appreciation,
        ]);
    }

    public function store(StoreAppreciationRequest $request)
    {
        try {
            $appreciation = $this->appreciationRepository->insert($request->all());

            return redirect('/appreciations')
            ->with('success', trans('appreciation.appreciation_created', ['name' => $appreciation->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit(Appreciation $appreciation)
    {
        return view('appreciations.appreciation_form', [
            'appreciation' => $appreciation,
        ]);
    }

    public function update(StoreAppreciationRequest $request, Appreciation $appreciation)
    {
        try {
            $this->appreciationRepository->update($appreciation, $request->all());

            return redirect('/appreciations')
            ->with('success', trans('appreciation.appreciation_updated', ['name' => $appreciation->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Appreciation $appreciation)
    {
        try {
            $this->appreciationRepository->destroy($appreciation);

            return redirect('appreciations')
            ->with('success', trans('appreciation.appreciation_deleted', ['name' => $appreciation->name]));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
