  <!-- Modal -->
  <div class="modal fade" id="exampleModaldelete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModaldelete"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('delete', $user->id)}}" method="POST">
                  @csrf
                  <div class="modal-body">
                      <p>Esta seguro de eliminar este usuario?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="sumbit" class="btn btn-danger">Eliminar</button>
                  </div>
          </div>
          </form>
      </div>
  </div>
