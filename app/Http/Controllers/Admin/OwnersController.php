<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner; //エロくアント
use App\Models\Brand;
use Illuminate\Support\Facades\DB;//クエリビルダー
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Throwable;
use Illuminate\Support\Facades\Log;

class OwnersController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:admin');
    }


    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')->orderBy('id', 'desc')->paginate(10);
        return view('admin.owners.index', compact('owners'));
    }


    public function create()
    {
        return view('admin.owners.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', 'min:8',  Rules\Password::defaults()],
        ]);

        try{
            DB::transaction(function () use($request) {
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Brand::create([
                    'owner_id'=>$owner->id,
                    'brand_name'=>'ブランド名を入力して下さい。',
                    'information'=>'',
                    'filename'=>'',
                    'is_selling'=>true,
                ]);
            }, 2);
        }
        catch(Throwable $e){
           Log::error($e);
           throw $e;
        }

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'メーカー登録を実施しました。',
            'status' => 'info'
            ]);

    }




    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.owners.edit', compact('owner'));
    }




    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password =hash::make($request->password);
        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'メーカー情報を更新しました。',
            'status' => 'info'
            ]);
    }


    public function destroy($id)
    {
        Owner::findOrFail($id)->delete(); //ソフトデリート

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message'=> 'メーカー情報を削除しました。',
            'status'=>'alert'
        ]);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwners = Owner::onlyTrashed()->orderBy('id', 'desc')->get();
        return view('admin.expired-owners', compact('expiredOwners'));
    }


    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.expired-owners.index')
        ->with([
            'message' => 'メーカー情報を完全に削除しました。',
            'status' => 'alert'
        ]);
    }

    public function expiredOwnerRestore($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.owners.index')
        ->with([
            'message' => 'メーカー情報を復元しました。',
            'status' => 'info'
        ]);
    }
}
