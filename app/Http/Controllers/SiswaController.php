<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller

{
public function index(): View
{
    //get Data db
    $siswas = Db::table('siswas')
    ->join('users', 'siswas.id_user', '=', 'users.id')
    ->select(
        'siswas.*',
        'users.name',
        'users.email'
    )
    ->paginate(10);

if (request('cari')) {
    $siswas = $this->search(request('cari'));
}

return view('admin.siswa.index', compact('siswas'));
}
 public function create(): View
 {
    return view('admin.siswa.create');
 }


public function store(Request $request): RedirectResponse
{
    //validate form
    $validated = $request->validate([
        'name' => 'required|string|max:250',
        'email' => 'required|email|max:250|unique:users',
        'password' => 'required|min:8|confirmed',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'nis' => 'required|numeric',
        'tingkatan' => 'required',
        'jurusan' => 'required',
        'kelas' => 'required',
        'hp' => 'required|numeric'
    ]);

    //upload image
    $image = $request->file('image');
    $image->storeAs('public/siswas', $image->hashName());

    $id_akun = $this->insertAccount($request->name, $request->email, $request->password);

    //upload image
    $image = $request->file('image');
    $image->storeAs('public/siswas', $image->hashName());
    //jika config private rue dan .env public
    //$image->storeAs('siswas', $image->->hashName());

    $id_akun = $this->insertAccount($request->name, $request->email, $request->password);

    //create post
    Siswa::create([
        'id_user' => $id_akun,
        'image' => $image->hasName(),
        'nis' => $request->nis,
        'tingkatan' => $request->tingkatan,
        'jurusan' => $request->jurusan,
        'kelas' => $request->kelas,
        'hp' => $request->hp,
        'status' => 1
    ]);

    //redirect to index
    return redirect()->route('siswa.index')->with(['succes' => 'Data Berhasil Disimpan']);
}

public function insertAccount(string $name, string $email, string $password)
{
    user::create([
        'name' =>$name,
        'email' =>$email,
        'password' => Hash::make($password),
        'usertype' => 'siswa'
    ]);

    $id = DB::table('users')->where('email', $email)->value('id');

    return $id;
}


public function show(string $id): View
{
    //get Data db
    $siswa = DB::table('siswas')
    ->join('users','siswas.id_user', '=', 'users.id')
    ->select(
        'siswas.*',
        'users.name',
        'users.email'
    )
    ->where('siswas.id', $id)
    ->first();

    return view('admin.siswa.show', compact('siswa'));
}

public function search(string $cari)
{
$siswas = DB::table('siswas')
->join('users', 'siswas.id_user', '=', 'users.id')
->select(
    'siswas.*',
    'users.name',
    'users.email'
)->where('users.name', 'like', '%'. $cari. '%')
->orwhere('siswas.nis', 'like', '%'. $cari. '%')
->orwhere('users.email', 'like', '%'. $cari. '%')
->where(10);
return $siswas;
}

public function update(Request $request, $id): RedirectResponse
{
    //validate form
    $validated = $request->validate([
        'name'          => 'required|string|max:2048',
        'image'         => 'image|mimes:jpeg,png,jpg|max:2048',
        'nis'           => 'required|numeric',
        'tingkatan'     => 'required',
        'jurusan'       => 'required',
        'kelas'         => 'required',
        'hp'            => 'required|numeric',
        'status'        => 'required',
    ]);

    //get post by ID
    $datas = Siswa::findORFail($id);
    //edit akun
    $this->editAccount($request->name, $id);

    //check if image is uploaded
    if ($request->hasFile('image')) {
        //upload new image
        $image = $request->file('image');
        $image->storas('public/siswas', $image->hasName());
        //delete old image
        storage::delete('public/siswas/' . $datas->image);

        //update post with new image
        $datas->update([
            'image'         => $image->hasName(),
            'nis'           => $request->nis,
            'tingkatan'     => $request->tingkatan,
            'jurusan'       => $request->jurusan,
            'kelas'         => $request->kelas,
            'hp'            => $request->hp,
            'status'        => $request->status
        ]);
    } else{
        //update post without image
        $datas->update([
            'nis'           => $request->nis,
            'tingkatan'     => $request->tingkatan,
            'jurusan'       => $request->jurusan,
            'kelas'         => $request->kelas,
            'hp'            => $request->hp,
            'status'        => $request->status
        ]);
    }
    //redirect to index
    return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihubah!']);
}

public function editAccount(string $name, string $id)
{

    //get id user
    $siswa = DB::table('siswas')->where('id', $id)->value('id_user');
    $user = DB::findOrFail($siswa);

    //jika ada password
    $user->update([
        'name'     => $name
    ]);
}

//Hapus data
public function destory($id): RedirectResponse
{
    //delete pelanggar
    $this->destroyUser($id);

    //get post ny ID
    $post = Siswa::findOrFail($id);

    //delete image
    storage::delete('public/siswas/' . $post->image);

    //delete post
    $post->delete();
    
    //redirect to index
    return redirect()->route('siswa,index')->with(['success' => 'Data Berhasil Dihapus!']);
}

public function destroyUser(string $id)
{
    //get id user
    $siswa = DB::table('siswas')->where('id', $id)->value('id_user');
    $user = User::findOrFail($siswa);

    //delete post
    $user->delete();
}
}