<h2>Form Registrasi</h2>

<form method="POST" enctype="multipart/form-data">
@csrf
<input name="alamat" placeholder="Alamat"><br>
<input name="nama_orangtua" placeholder="Nama Orang Tua"><br>
<input type="file" name="akta"><br>
<input type="file" name="kk"><br>
<button>Daftar</button>
</form>
