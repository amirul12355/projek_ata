<!-- Modal untuk Lain-lain -->
<div class="modal fade" id="lainLainModal{{ $record->bil }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dokumen Lain-lain untuk Lot {{ $record->no_lot }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Bahagian A -->
                <h5>Bahagian A</h5>
                <form action="{{ route('atab.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dokumen</th>
                                <th>Muat Naik Fail</th>
                                <th>Fail Yang Dimuat Naik</th> <!-- Kolum baru untuk fail yang dimuat naik -->
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 4; $i++)
                                <tr>
                                    <td>Dokumen A{{ $i }}</td>
                                    <td><input type="file" name="dokumen_a{{ $i }}" class="form-control"></td>
                                    <td>
                                        @if (isset($record->lain_lain['bahagian_a'][$i - 1]))
                                            <!-- Paparkan pautan untuk fail yang telah dimuat naik -->
                                            <a href="{{ asset('storage/' . $record->lain_lain['bahagian_a'][$i - 1]) }}" target="_blank">
                                                Lihat Fail
                                            </a>
                                        @else
                                            <span class="text-muted">Tiada fail</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>

                    <!-- Bahagian B -->
                    <h5>Bahagian B</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dokumen</th>
                                <th>Muat Naik Fail</th>
                                <th>Fail Yang Dimuat Naik</th> <!-- Kolum baru untuk fail yang dimuat naik -->
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 14; $i++)
                                <tr>
                                    <td>Dokumen B{{ $i }}</td>
                                    <td><input type="file" name="dokumen_b{{ $i }}" class="form-control"></td>
                                    <td>
                                        @if (isset($record->lain_lain['bahagian_b'][$i - 1]))
                                            <!-- Paparkan pautan untuk fail yang telah dimuat naik -->
                                            <a href="{{ asset('storage/' . $record->lain_lain['bahagian_b'][$i - 1]) }}" target="_blank">
                                                Lihat Fail
                                            </a>
                                        @else
                                            <span class="text-muted">Tiada fail</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
