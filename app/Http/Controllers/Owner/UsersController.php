<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Models\User; //エロくアント
use Illuminate\Support\Facades\DB; //クエリビルダー
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }


    public function index()
    {
        $users = User::select('id', 'owner_id', 'name', 'email', 'betting_rate', 'created_at')
        ->where('owner_id', Auth::id())
        ->orderBy('id','desc')
        ->paginate(20);

        return view('owner.users.index', compact('users'));

    }



    public function create()
    {
        $ownerId = Owner::findOrFail(Auth::id());

        return view('owner.users.create', compact('ownerId'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'betting_rate' => ['required', 'integer', 'max:100'],
            'password' => ['required','string', 'confirmed', 'min:8', Rules\Password::defaults()],
        ]);

        User::create([
            'owner_id' => Owner::findOrFail(Auth::id())->id,
            'name' => $request->name,
            'email' => $request->email,
            'betting_rate' => $request->betting_rate,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('owner.users.index')
        ->with([
            'message' => 'ショップ新規登録を実施しました。',
            'status' => 'info'
        ]);

    }


    public function show($id)
    {
        //
    }




    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('owner.users.edit', compact('user'));
    }





    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->betting_rate = $request->betting_rate;
        $user ->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('owner.users.index')
        ->with([
            'message' => 'ショップ情報を更新しました。',
            'status' => 'info'
        ]);
    }



    public function destroy($id)
    {
        User::findOrFail($id)->delete(); //ソフトデリート

        return redirect()
        ->route('owner.users.index')
        ->with([
            'message' => 'ショップ情報を削除しました。',
            'status' => 'alert'
        ]);
    }

    public function expiredUserIndex()
    {
        $expiredUsers = User::onlyTrashed()
        ->where('owner_id', Auth::id())->get();
        return view('owner.expired-users', compact('expiredUsers'));
    }


    public function expiredUserRestore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('owner.users.index')
        ->with([
            'message' => 'ショップ情報を復元しました。',
            'status' => 'info'
        ]);
    }

    public function expiredUserRestoreAll()
    {
        $user = User::onlyTrashed()->restore();

        return redirect()->route('owner.users.index')
        ->with([
            'message' => 'ショップ情報を全件復元しました。',
            'status' => 'info'
        ]);
    }



    public function expiredUserDestroy($id)
    {
        User::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('owner.expired-users.index')
        ->with([
            'message' => 'ショップ情報を完全に削除しました。',
            'status' => 'alert'
        ]);
    }
}
