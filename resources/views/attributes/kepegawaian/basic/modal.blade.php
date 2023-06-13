<!-- delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="txt-opd">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route($url_delete, $item->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label>Keterangan *</label>
                        <textarea name="alasan_menghapus" id="alasan_menghapus" class="form-control" required></textarea>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i>
                            Batal</button>
                        <button type="submit" class="btn btn-warning btn-lihat-detail"><i class="fas fa-info-circle"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete -->

@push('scripts')
<script>
$(document).ready(function () {
    $('.btn-delete').click(function(){
        $('#modal-delete').modal('show');
    });
});
</script>
@endpush