{{-- add ulasan --}}
@foreach($data as $item)
<div class="modal fade" id="add_ulasan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Ulasan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('ulasan.store')}}" method="post">
                @csrf
                <input type="hidden" name="makanan_id" value="{{$item->id}}">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="ulasan">Ulasan:</label>
                    <textarea class="form-control" id="ulasan" name="ulasan" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">beri rating</label>
                    <select name="rating" id="" class="form-control">
                        <option value="" disabled selected>pilih rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2 float-end" >Simpan</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  {{-- pembelian --}}
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>


{{-- pemesanan --}}
@foreach($data as $item)
  <div class="modal fade" id="pembelian{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Beri Ulasan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="makanan_id" value="{{ $item->id }}">
            <label for="jumlah_pesanan">Mau beli berapa makanannya</label>
            <input type="number" name="jumlah_pesanan" class="form-control" min="1" max="{{ $item->stock }}" required>
            <button type="submit" class="btn btn-primary mt-3">Beli</button>
          </form>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach