<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StepRequest;
use App\Models\Step;
use Carbon\Carbon;

class StepController extends Controller
{
    //
    public function __construct()
    {
        view()->share([]);
    }

    public function index(Request $request)
    {
        //
//        $steps = Step::orderByDesc('id')->paginate(15);
        return view('backend/modules/steps/index');
    }

    public function create()
    {
        //
        return view('backend/modules/steps/add');

    }

    public function store(StepRequest $request)
    {
        //
        $data = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        $data['created_at'] = Carbon::now();

        try {
            Step::insert($data);
            return redirect()->back()->with('success', '処理に成功しました。');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', 'エラーが発生しました');
        }

    }

    public function edit($id)
    {
        //
        $step = Step::find($id);
        if(!$step) {
            return redirect()->route('steps.index')->with('danger', 'エラーが発生しました');
        }
        return view('backend/modules/steps/edit', compact('step'));
    }

    public function update(StepRequest $request, $id)
    {
        $step = Step::find($id);
        if(!$step) {
            return redirect()->route('steps.index')->with('danger', 'エラーが発生しました');
        }

        $data = $request->except('_token');
        $data['updated_at'] = Carbon::now();
        $data['created_at'] = Carbon::now();

        try {
            $step->update($data);
            return redirect()->back()->with('success', '処理に成功しました。');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', 'エラーが発生しました');
        }
    }

    public function destroy($id)
    {
        $step = Step::find($id);
        if(!$step) {
            return redirect()->route('steps.index')->with('danger', 'エラーが発生しました');
        }

        try {
            $step->delete();
            return redirect()->back()->with('success', '処理に成功しました。');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', 'エラーが発生しました');
        }
    }
}
