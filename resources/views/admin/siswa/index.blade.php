<!DOCTYPE html>
<html lang-"en">

<head>
    <meta charset-"UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <title>Data user</title>
</heard>

<body>
    <h1>Data user<h1/>
        <a href="{{  route('admin/dashboard') }}">Menu utama</a><br>
    href="{{  route('logout') }}" onclick="event,preventDefault"(); document,getElmentByld('logout-from').submit();">logout</a>
    <br><br>
    <form id="" logout-form" action="{{  route('logout') }}" method="POST">        @csrf
    @csrf
    </form>
    <br><br>
    <form action="" method="get">
        <label>cari :</label>
        <input type="text" name="cari">
        <input type="submit" value="cari">
    </form>
    <br><br>
    <a href=""Tambah User</a>

        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{  Session::get('success') }}
        </div>
        @endif

        table class="table">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        @forelse ($users as $user)
        <tr>
            <td>{{  $user->name }}</td>
            <td>{{  $user->email }}</td>
            <td>{{ $user->usertype }}</td>
            <td>
                <a href="{{ $user->id }}" class="btn btn-sm btn-primary">EDIT</a>
            </td>
        </tr>
        @empity
        <tr>
            <td>
                <p>data tidak ditemukan</p>
            </td>
            <td>
                <a href="{{  route('akun.indrx') }}">kembali</a>
            </td>
        </tr>
        @endforolse
    </table>
    {{ $users->links() }}   

</body>

</html>


