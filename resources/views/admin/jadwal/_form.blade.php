<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Kelas<span class="text-danger">*</span></label>
        <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
            <option value="">- Pilih Kelas -</option>
            @foreach ($kelas as $k)
                <option value="{{ $k->id }}"
                    {{ (string) old('kelas_id', $jadwal->kelas_id ?? '') === (string) $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
        @error('kelas_id')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Mapel<span class="text-danger">*</span></label>
        <select name="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror" required>
            <option value="">- Pilih Mapel -</option>
            @foreach ($mapel as $m)
                <option value="{{ $m->id }}"
                    {{ (string) old('mapel_id', $jadwal->mapel_id ?? '') === (string) $m->id ? 'selected' : '' }}>
                    {{ $m->nama }}
                </option>
            @endforeach
        </select>
        @error('mapel_id')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Guru<span class="text-danger">*</span></label>
    <select name="guru_id" class="form-select @error('guru_id') is-invalid @enderror" required>
        <option value="">- Pilih Guru -</option>
        @foreach ($guru as $g)
            <option value="{{ $g->id }}"
                {{ (string) old('guru_id', $jadwal->guru_id ?? '') === (string) $g->id ? 'selected' : '' }}>
                {{ $g->nama }}
            </option>
        @endforeach
    </select>
    @error('guru_id')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Hari<span class="text-danger">*</span></label>
        <select name="hari" class="form-select @error('hari') is-invalid @enderror" required>
            <option value="">- Pilih Hari -</option>
            @foreach ($hari as $h)
                <option value="{{ $h }}" {{ old('hari', $jadwal->hari ?? '') === $h ? 'selected' : '' }}>
                    {{ $h }}
                </option>
            @endforeach
        </select>
        @error('hari')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Jam Mulai<span class="text-danger">*</span></label>
        <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror"
            value="{{ old('jam_mulai', isset($jadwal) ? substr($jadwal->jam_mulai, 0, 5) : '') }}" required>
        @error('jam_mulai')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Jam Selesai<span class="text-danger">*</span></label>
        <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror"
            value="{{ old('jam_selesai', isset($jadwal) ? substr($jadwal->jam_selesai, 0, 5) : '') }}" required>
        @error('jam_selesai')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Ruang</label>
    <input type="text" name="ruang" class="form-control @error('ruang') is-invalid @enderror"
        value="{{ old('ruang', $jadwal->ruang ?? '') }}" placeholder="Contoh: Kelas 1A / Ruang 2">
    @error('ruang')
        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
    @enderror
</div>
