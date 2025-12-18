<h2>Daftar Soal</h2>
<a href="/admin/soal/create">Tambah Soal</a>

@foreach($soal as $s)
<div>
    <img src="{{ asset('storage/'.$s->gambar_soal) }}" width="150">
    Jawaban: {{ strtoupper($s->jawaban_benar) }}
</div>
<hr>
@endforeach
