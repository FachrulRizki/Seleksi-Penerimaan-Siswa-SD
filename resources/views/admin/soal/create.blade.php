<h2>Tambah Soal</h2>

<form method="POST" action="{{ url('/admin/soal') }}" enctype="multipart/form-data">
@csrf
<input type="file" name="gambar_soal"><br>
<input name="a" placeholder="Pilihan A"><br>
<input name="b" placeholder="Pilihan B"><br>
<input name="c" placeholder="Pilihan C"><br>
<input name="d" placeholder="Pilihan D"><br>
<select name="jawaban_benar">
    <option value="a">A</option>
    <option value="b">B</option>
    <option value="c">C</option>
    <option value="d">D</option>
</select><br>
<button>Simpan</button>
</form>
