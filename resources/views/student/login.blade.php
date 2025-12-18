<h2>Login Siswa</h2>

<form method="POST">
@csrf
<input name="nama" placeholder="Nama"><br>
<input name="no_ujian" placeholder="No Ujian"><br>
<button>Masuk</button>
</form>

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif
