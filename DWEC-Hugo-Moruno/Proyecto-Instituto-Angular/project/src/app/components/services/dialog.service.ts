import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class DialogService {

  private HTML_MODAL_ALERT = `
  <div class="modal fade" id="modalAlert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                CUERPO
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
  </div>
`;

private HTML_MODAL_CONFIRM = `
  <div class="modal fade" id="modalConfirmar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarBackdropLabel">Advertencia</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              CONTENIDO
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button id="botonAceptar" type="button" class="btn btn-danger">Aceptar</button>
          </div>
      </div>
    </div>
  </div>
`;


private HTML_TOAST = `
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
  <div id="__Toast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>`

  constructor() { }

  /**
   * Muestra un mensaje
   * 
   * @param message 
   * @param title 
   */
  mostrarMensaje(message: string, title: string = 'Warning') : void {

    if(!$('#modalAlert').length) {

      $('body').append( this.HTML_MODAL_ALERT );           
    }    

    _mostrarAlert();

    function _mostrarAlert() {
      $('#modalAlert .modal-title').text(title);
      $('#modalAlert .modal-body').text(message);
  
      $('#modalAlert').modal('show');  
    }
  }

    solicitarConfirmacion(mensaje: string, titulo: string, accion: any) {
    
    if(!$('#modalConfirmar').length) {

      $('body').append( this.HTML_MODAL_CONFIRM );          
    } 
  
    _solicitarConfirmacion();
    
    function _solicitarConfirmacion() {

      $('#modalConfirmar .modal-title').text(titulo);
      $('#modalConfirmar .modal-body').text(mensaje);
  
      $('#modalConfirmar #botonAceptar').on('click', (event: any) => {

        event.stopPropagation();

        accion();
  
        $('#modalConfirmar #botonAceptar').off('click');
      
        $('#modalConfirmar').modal('hide');    
      });
  
      $('#modalConfirmar').modal('show');  
    }
  }

  /**
   * Muestra un mensaje en formato Toast
   * 
   * @param mensaje 
   */
   mostrarToast(mensaje: string) : void {

    if(!$('#__Toast').length) {

      $('body').append( this.HTML_TOAST );           
    }    

    _mostrarToast();

    function _mostrarToast() {
      $('#__Toast .toast-body').text(mensaje);  
      $('#__Toast').toast('show');  
    }
  }


}
