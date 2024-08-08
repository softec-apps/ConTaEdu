<!-- Password Reset Modal -->
<div class="modal fade" id="passwordResetModal" tabindex="-1" aria-labelledby="passwordResetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="passwordResetModalLabel">Restablecer Contraseña</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="passwordResetForm" method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="mb-3">
                      <x-input-label for="reset-email" :value="__('Email')" />
                      <x-text-input id="reset-email" class="form-control" type="email" name="email" required
                          placeholder="Introduce tu email" />
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                  <div class="text-center">
                      <button type="button" class="btn app-btn-primary" id="reset-password-btn">Enviar enlace de restablecimiento</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const resetPasswordBtn = document.getElementById('reset-password-btn');
      const passwordResetForm = document.getElementById('passwordResetForm');
      
      resetPasswordBtn.addEventListener('click', function (event) {
          event.preventDefault(); // Previene el comportamiento por defecto del formulario
          const formData = new FormData(passwordResetForm);
          fetch(passwordResetForm.action, {
              method: 'POST',
              body: formData,
              headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': formData.get('_token') // Agrega el token CSRF para seguridad
              }
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Enlace de restablecimiento enviado a tu correo electrónico.');
                  const modal = bootstrap.Modal.getInstance(document.getElementById('passwordResetModal'));
                  modal.hide();
              } else {
                  alert('Hubo un error al enviar el enlace. Inténtalo de nuevo.');
                  console.log(data.errors); // Muestra los errores en la consola para depuración
              }
          })
          .catch(error => {
              console.error('Error:', error);
          });
      });
  });
  </script>
