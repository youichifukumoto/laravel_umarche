<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//クエリビルダー
use iLLuminate\Support\Facades\Auth;

class SecondaryCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $secondaryCategories = SecondaryCategory::all();

        return view('admin.SecondaryCategory.index', compact('secondaryCategories'));
    }


    public function create()
    {
        return view('admin.secondaryCategory.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'sort_order' => ['required', 'integer'],
        ]);


        $primary = PrimaryCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()
            ->route('admin.primaryCategory.index')
            ->with([
                'message' => 'セカンドカテゴリー登録を実施しました。',
                'status' => 'info'
            ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $secondaryCategory = SecondaryCategory::findOrFail($id);
        return view('admin.secondaryCategory.edit', compact('secondaryCategory'));
    }


    public function update(Request $request, $id)
    {
        $secondaryCategory = SecondaryCategory::findOrFail($id);
        $secondaryCategory->name = $request->name;
        $secondaryCategory->sort_order = $request->sort_order;
        $secondaryCategory->save();

        return redirect()
            ->route('admin.secondaryCategory.index')
            ->with([
                'message' => 'セカンドカテゴリー情報を更新しました。',
                'status' => 'info'
            ]);
    }


    public function destroy($id)
    {
        SecondaryCategory::findOrFail($id)->delete();

        return redirect()
            ->route('admin.secondaryCategory.index')
            ->with([
                'message' => 'セカンドのカテゴリー名を削除しました。',
                'status' => 'alert'
            ]);
    }
}
