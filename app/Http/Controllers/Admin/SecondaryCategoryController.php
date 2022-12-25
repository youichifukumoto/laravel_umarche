<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrimaryCategory;
use App\Models\Owner;
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
        $secondaryCategories = SecondaryCategory::select('id', 'primary_category_id', 'name', 'sort_order', 'created_at')->orderBy('id', 'desc')->paginate(10);


        return view('admin.SecondaryCategory.index', compact('secondaryCategories'));
    }


    public function create()
    {
        $primaries = PrimaryCategory::select('id', 'name')->get();
        return view('admin.secondaryCategory.create', compact('primaries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'primary_category_id' => ['required', 'string', 'max:30'],
            'name' => ['required', 'string', 'max:30'],
            'sort_order' => ['required', 'integer'],
        ]);


       secondaryCategory::create([
            'primary_category_id' =>$request->primary_category_id,
            'name' => $request->name,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()
            ->route('admin.secondaryCategory.index')
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
