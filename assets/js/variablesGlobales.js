// variablesGlobales.js
// Variables utilizadas en toda el sistema

// Formulario para mostrar animación Loading en cargas de otros formularios
window.loadingForm = '<div class="modal-header bg-primary">' +
                            '<h5 id="loading-dialog-modal_title" class="modal-title"></h5>' +
                       '</div>' +
                       '<div class="modal-body">' +
                            '<div id="loading-dialog-body_container" class="vertical-alignment-container text-xl text-center text-gray-no-line-height">' +
                                '<i class="vertical-align-center fa fa-refresh fa-spin fa-fw"></i>' + 
                            '</div>' +
                       '</div>';
               
// Formulario para mostrar opciones de confirmación
window.confirmarForm = '<div class="modal-header bg-primary">' +
                            '<button type="button" class="close" id="confirmar-dialog-cerrar-btn" data-dismiss="modal">&times;</button>' +
                            '<h5 id="confirmar-dialog-modal_title" class="modal-title"></h5>' +
                        '</div>' +
                        '<div class="modal-body"></div>' +
                        '<div class="modal-footer">' +
                            '<div id="confirmar-dialog-error" class="alert-custom alert alert-danger" style="width: 70%;"></div>' +
                            '<div id="confirmar-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>' +
                            '<button type="button" class="btn btn-primary btn-tiny" id="confirmar-dialog-aplicar-btn">Aplicar</button>' +
                            '<button type="button" class="btn btn-default btn-tiny" id="confirmar-dialog-cancelar-btn" data-dismiss="modal">Cancelar</button>' +
                        '</div>';
               
// Formulario para visualizar y modificar imagen
window.imagenForm = '<div class="modal-header bg-primary">' +
                        '<button type="button" class="close" id="imagen-dialog-cerrar-btn" data-dismiss="modal">&times;</button>' +
                        '<h5 id="imagen-dialog-modal_title" class="modal-title"></h5>' +
                    '</div>' +
                    '<div class="modal-body"></div>' +
                    '<div class="modal-footer">' +
                        '<form id="form_imagen" class="form-horizontal" role="form" method="post" action="">' +
                            '<input type="file" id="imagen-cargada" name="imagen-cargada" style="display: none;" accept=".jpg,.png,.bmp">' +
                        '</form>' +
                        '<div id="imagen-dialog-error" class="alert-custom alert alert-danger" style="width: 70%;"></div>' +
                        '<div id="imagen-dialog-loading" class="loading-custom text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>' +
                        '<button type="button" id="imagen-dialog-actualizar-btn" class="btn btn-primary btn-tiny">Actualizar</button>' +
                        '<button type="button" id="image-dialog-cancelar-btn" class="btn btn-default btn-tiny" data-dismiss="modal">Cerrar</button>' +
                    '</div>';
               
// Errores servidor GPS (traducidos español)
window.gpsErrorServidor = {
    0 : 'Operación exitosa',
    1 : 'Sesión inválida',
    2 : 'Nombre de servicio inválido',
    3 : 'Solicitud inválida',
    4 : 'Entrada inválida',
    5 : 'Error al ejecutar solicitud',
    6 : 'Error desconocido. Intente nuevamente',
    7 : 'Acceso denegado',
    8 : 'Usuario o contraseña inválida',
    9 : 'Autorización de servidor no disponible',
    10 : 'Llegó al límite de solicitudes permitidas',
    1001 : 'No ha mensajes para el intervalo seleccionado',
    1002 : 'Item ya existe o está denegado. Error al crearlo',
    1003 : 'Solo una solicitud permitida en el momento',
    1004 : 'Límite de mensajes excedido',
    1005 : 'Tiempo de ejecución superado',
    1011 : 'Sesión expirada',
    2014 : 'Usuario seleccionado no puede ser vinculado a nueva cuenta',
    2015 : 'Eliminación de sensor denegada'
};