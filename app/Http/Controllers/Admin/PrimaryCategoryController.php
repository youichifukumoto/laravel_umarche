<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use Illuminate\Support\Facades\DB;//クエリビルダー
use Illuminate\Validation\Rules;
use Throwable;
use Illuminate\Support\Facades\Log;

class PrimaryCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    public function index()
    {
        $primaryCategories = PrimaryCategory::select('id','name', 'sort_order', 'created_at')->get();
        return view('admin.primaryCategory.index', compact('primaryCategories'));
    }




    public function create()
    {
        return view('admin.primaryCategory.create');
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'sort_order' => ['required', 'integer'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $primary = PrimaryCategory::create([
                    'name' => $request->name,
                    'sort_order' => $request->sort_order,
                ]);

                SecondaryCategory::create([
                    'name' => '',
                    'sort_order' => 1,
                    'primary_category_id' => $primary->id,
                ]);

            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('admin.secondaryCategory.index')
            ->with([
                'message' => 'プライマリーカテゴリー登録を実施しました。',
                'status' => 'info'
            ]);

    }


    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $primaryCategory = PrimaryCategory::findOrFail($id);
        return view('admin.primaryCategory.edit', compact('primaryCategory'));
    }



    public function update(Request $request, $id)
    {
        $primaryCategory = PrimaryCategory::findOrFail($id);
        $primaryCategory->name = $request->name;
        $primaryCategory->sort_order = $request->sort_order;
        $primaryCategory->save();

        return redirect()
            ->route('admin.primaryCategory.index')
            ->with([
                'message' => 'メインカテゴリー情報を更新しました。',
                'status' => 'info'
            ]);
    }


    public function destroy($id)
    {
        PrimaryCategory::findOrFail($id)->delete();

        return redirect()
            ->route('admin.primaryCategory.index')
            ->with([
                'message' => 'メインのカテゴリー名を削除しました。',
                'status' => 'alert'
            ]);
    }
}
