<h2>Ujian Seleksi</h2>

<form method="POST">
@csrf

@foreach($soal as $s)
<div>
    <img src="{{ asset('storage/'.$s->gambar_soal) }}" width="300"><br>

    <label><input type="radio" name="jawaban[{{ $s->id }}]" value="a"> {{ $s->a }}</label><br>
    <label><input type="radio" name="jawaban[{{ $s->id }}]" value="b"> {{ $s->b }}</label><br>
    <label><input type="radio" name="jawaban[{{ $s->id }}]" value="c"> {{ $s->c }}</label><br>
    <label><input type="radio" name="jawaban[{{ $s->id }}]" value="d"> {{ $s->d }}</label>
</div>
<hr>
@endforeach

<button>Kirim Jawaban</button>
</form>

@if(session('gagal'))
<script>alert('Tidak Lulus');</script>
@endif
