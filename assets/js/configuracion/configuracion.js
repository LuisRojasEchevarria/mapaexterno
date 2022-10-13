$(document).ready(function() {
    imprimirTabla(true, jQuery.parseJSON(decodeURIComponent($('#configuracion-data-input').val())));
    $('#configuracion-data-input').remove();

    $(document).on('keydown', function(e) {
        if (e.which === 8 && !$(e.target).is("input, select, textarea")) {
            e.preventDefault();
        }
    });

    function imprimirTabla(permisoEscritura, data) {
        var Tabla = generarTabla(data);
        $('#tabla-configuracion-container').html(Tabla);
        if ($.fn.dataTable.isDataTable('#tabla-consulta')) {
            $('#tabla-consulta').DataTable().clear().destroy();
        }

        $('#tabla-consulta').DataTable({
            "bDestroy": true,
            "paging": true,
            "pageLength": 15,
            "bScrollCollapse": false,
            "bAutoWidth": true,
            "sScrollX": '100%',
            "sScrollXInner": '100%',
            "bLengthChange": false,
            "bProcessing": true,
            "order": [
                [1, 'asc']
            ],
            "dom": "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12 text-center'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "language": {
                "lengthMenu": 'Mostrando _MENU_ entradas por página',
                "zeroRecords": 'No se encontraron registros',
                "info": '<strong class="text-gray">CONFIGURACION<strong> | Mostrando _END_ / _MAX_ registros',
                "infoEmpty": '<strong class="text-gray">CONFIGURACION</strong> | Mostrando _END_ / _MAX_ registros',
                "infoFiltered": '',
                "search": '',
                "paginate": {
                    "first": 'Pri',
                    "last": 'Ult',
                    "next": 'Sgte',
                    "previous": 'Ant'
                }
            },
            "columnDefs": [{
                    targets: [0],
                    width: '3%',
                    orderable: false
                },
                {
                    targets: [1],
                    orderable: false,
                    visible: false
                }
            ],
            buttons: [{
                text: '<div class="text-xl text-center text-gray-no-line-height"><i class="fa fa-refresh fa-spin fa-fw"></i></div>',
                className: 'btn-no-style btn-tiny loading-table-update'
            }]
        });

        $('.dataTables_filter input').addClass('form-control');
        $('.dataTables_filter input').attr('placeholder', 'Buscar...');
        $('.loading-table-update').css('display', 'none');
    }

    function generarTabla(data) {
        var tabla, tr;
        var vcolorcab = "background-color: #E6E6E6;";
        tabla = $('<table id="tabla-consulta" class="table table-condensed">' +
            '<thead>' +
            '<tr>'
            //0
            +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '"></th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ID</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">CODIGO</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">NOMBRE</th>' +

            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">DESCRIPCION</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">FLAG</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">TIPO</th>' +

            // '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">PRECIO MÍNIMO DE ABONO</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ACCIONES</th>'
            //                
            +
            '</tr>' +
            '</thead>' +
            '<tfoot>'
            //0
            +
            '<th class="no_filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            // '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>'
            //                
            +
            '</tfoot>' +
            '<tbody>' +
            '</tbody>' +
            '</table>');

        for (var i = 0; i < data.length; i++) {

            var btn_consultar = '<button type="button" class="btn btn-primary btn-xs btn-consultar"><i class="glyphicon glyphicon-list-alt"></i> Consultar</button>';
            var btn_modificar = '<button type="button" class="btn btn-success btn-xs btn-modificar"><i class="glyphicon glyphicon-pencil"></i> Modificar</button>';

            tr = $('<tr></tr>');
            tr.append('<td id="c01_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: center;"> </td>' +
                '<td id="c02_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].id + '</td>' +
                '<td id="c03_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].I_COD + '</td>' +
                '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + data[i].V_NOM + '</td>' +

                '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + data[i].V_DESC + '</td>' +
                '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + data[i].I_FLAG + '</td>' +
                '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + data[i].V_TIPO + '</td>' +


                // '<td id="c05_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + data[i].precio_minimo_abono + '</td>' +
                '<td id="c06_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + btn_consultar + btn_modificar + '</td>');
            tabla.find('tbody').append(tr);
        }
        return tabla;
    }
    //---------
    $(document).off('click.Nuevo').on('click.Nuevo', '#btn-nuevo', function() {

        var nuevoFormDialog = $('<div id="nuevo-configuracion-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Configuración</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');

        var formContent = $('<div/>');
        formContent.load(window.base_url + 'configuracion/nuevo', {}, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong>Contacto - Nuevo</strong>');

            var formNuevo = nuevoFormDialog.find('#form_nuevo_configuracion');
            nuevoFormDialog.find('#nuevo-configuracion-dialog-loading').hide();
            validar(formNuevo);
            nuevoFormDialog.on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
                $(this).empty();
                $(this).removeAttr('style');
            });

            nuevoFormDialog.on('click', '#nuevo-configuracion-aplicar-btn', function(e) {
                formNuevo.submit(function() {
                    return false;
                });

                nuevoFormDialog.find('#nuevo-configuracion-dialog-error').text('').hide();

                if (formNuevo.valid()) {
                    var disabledFields = formNuevo.find(':input:disabled');
                    disabledFields.removeAttr('disabled');
                    var formData = new FormData(formNuevo[0]);

                    disabledFields.attr('disabled', 'disabled');
                    nuevoFormDialog.find('#nuevo-configuracion-dialog-loading').show();

                    $.ajax({
                        type: 'POST',
                        data: formData,
                        url: window.base_url + 'configuracion/agregar',
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            if (result.substr(0, 3) === 'ERR') {
                                var serverError = result.substr(4);
                                nuevoFormDialog.find('#nuevo-configuracion-dialog-loading').hide();
                                mensajeFormulario(nuevoFormDialog.find('#nuevo-configuracion-dialog-error'), 'error', true, serverError);
                            } else {
                                nuevoFormDialog.modal('hide').data('bs.modal', null);
                                actualizarTabla(true, function() {});
                                mensajeSwal('guardar.ok');
                            }

                        }
                    });

                }
            });

        });

    });


    $(document).off('click.Consultar').on('click.Consultar', '.btn-consultar', function() {

        var vidtd = $(this).parents("tr").find("td").attr("id");
        var idSplit = vidtd.split("-");
        var vid = idSplit[2];
        // Formando Dialog
        var nuevoFormDialog = $('<div id="nuevo-acceso-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Configuración</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');

        var formContent = $('<div/>');
        formContent.load(window.base_url + 'configuracion/consultar', { id: vid }, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong>Configuración - Consulta</strong>');

            var formNuevo = nuevoFormDialog.find('#form_consultar_configuracion');
            nuevoFormDialog.find('#consultar-configuracion-dialog-loading').hide();

            nuevoFormDialog.on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
                $(this).empty();
                $(this).removeAttr('style');
            });
        });
    });

    $(document).off('click.Modificar').on('click.Modificar', '.btn-modificar', function() {
        var vidtd = $(this).parents("tr").find("td").attr("id");
        var idSplit = vidtd.split("-");
        var vid = idSplit[2];
        var nuevoFormDialog = $('<div id="modificar-configuracion-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Configuración</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');
        var formContent = $('<div/>');
        formContent.load(window.base_url + 'configuracion/modificar', { id: vid }, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong>Configuración - Modificar</strong>');
            var formNuevo = nuevoFormDialog.find('#form_modificar_configuracion');
            nuevoFormDialog.find('#modificar-configuracion-dialog-loading').hide();

            validar(formNuevo);

            nuevoFormDialog.on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
                $(this).empty();
                $(this).removeAttr('style');
            });
            //-----
            nuevoFormDialog.on('click', '#modificar-configuracion-aplicar-btn', function(e) {
                formNuevo.submit(function() {
                    return false;
                });
                nuevoFormDialog.find('#modificar-configuracion-dialog-error').text('').hide();
                if (formNuevo.valid()) {
                    var disabledFields = formNuevo.find(':input:disabled');
                    disabledFields.removeAttr('disabled');
                    var formData = new FormData(formNuevo[0]);
                    disabledFields.attr('disabled', 'disabled');
                    nuevoFormDialog.find('#modificar-configuracion-dialog-loading').show();

                    $.ajax({
                        type: 'POST',
                        data: formData,
                        url: window.base_url + 'configuracion/agregar1',
                        contentType: false,
                        processData: false,
                        success: function(result) {

                            if (result.substr(0, 3) === 'ERR') {
                                var serverError = result.substr(4);
                                nuevoFormDialog.find('#modificar-configuracion-dialog-loading').hide();
                                mensajeFormulario(nuevoFormDialog.find('#modificar-configuracion-dialog-error'), 'error', true, serverError);
                            } else {
                                nuevoFormDialog.modal('hide').data('bs.modal', null);
                                actualizarTabla(true, function() {});
                                mensajeSwal('guardar.ok');
                            }
                        }
                    });

                }
            });
            //-----
        });
    });

    //---------
    function actualizarTabla(permisoEscritura, callback) {
        $('<div class="modal-backdrop fade"></div>').appendTo(document.body);
        $('.loading-table-update').css('display', 'block');
        $.ajax({
            type: 'GET',
            data: 'primera_carga=false',
            url: window.base_url + 'configuracion',
            success: function(result) {
                var Data = jQuery.parseJSON(result)['configuracion_data'];
                imprimirTabla(permisoEscritura, Data);
                $('.loading-table-update').css('display', 'none');
                $('.modal-backdrop').fadeOut(300, function() { $(this).remove(); });
                callback();
            }
        });
    }

    function validar(dialogForm) {

        dialogForm.validate({
            rules: {},
            messages: {},
            submitHandler: function(form) {
                return false;
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                error.addClass("help-block");
                element.parents(".validar").addClass("has-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                if (!element.next("span")[0]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                }
            },
            success: function(label, element) {
                if (!$(element).next("span")[0]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parents(".validar").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents(".validar").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
        });
    }
    //---------
});
