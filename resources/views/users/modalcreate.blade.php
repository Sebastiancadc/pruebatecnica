  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('create') }}" method="POST">
                  <div class="modal-body">
                      @csrf
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Email</label>
                          <input type="email" class="form-control" id="exampleInputPassword1" name="email">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Rol</label>
                          <select class="form-select" aria-label="Default select example" name="role">
                              <option selected value=" ">Seleccione</option>
                              <option value="Administrador">Administrador</option>
                              <option value="Usuario">Usuario</option>
                              <option value="Gestor">Gestor</option>
                          </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="sumbit" class="btn btn-primary">Crear</button>
                  </div>
          </div>
          </form>
      </div>
  </div>
