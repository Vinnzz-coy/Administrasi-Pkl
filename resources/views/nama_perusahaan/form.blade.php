<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>
        <label class="font-medium">Nama DUDI</label>
        <input type="text" name="nama" value="{{ old('nama', $dudi->nama ?? '') }}"
               class="w-full mt-1 rounded-lg border-gray-300">
    </div>

    <div>
        <label class="font-medium">Pimpinan</label>
        <input type="text" name="pimpinan" value="{{ old('pimpinan', $dudi->pimpinan ?? '') }}"
               class="w-full mt-1 rounded-lg border-gray-300">
    </div>

    <div>
        <label class="font-medium">Pembimbing</label>
        <input type="text" name="pembimbing" value="{{ old('pembimbing', $dudi->pembimbing ?? '') }}"
               class="w-full mt-1 rounded-lg border-gray-300">
    </div>

    <div>
        <label class="font-medium">Jabatan</label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $dudi->jabatan ?? '') }}"
               class="w-full mt-1 rounded-lg border-gray-300">
    </div>

    <div class="md:col-span-2">
        <label class="font-medium">Alamat</label>
        <textarea name="alamat" rows="3"
                  class="w-full mt-1 rounded-lg border-gray-300">{{ old('alamat', $dudi->alamat ?? '') }}</textarea>
    </div>

    <div>
        <label class="font-medium">Daya Tampung</label>
        <input type="number" name="daya_tampung" min="0"
               value="{{ old('daya_tampung', $dudi->daya_tampung ?? 0) }}"
               class="w-full mt-1 rounded-lg border-gray-300">
    </div>

</div>
