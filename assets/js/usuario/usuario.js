
$(document).ready(function() {
    imprimirTabla(true, jQuery.parseJSON(decodeURIComponent($('#usuario-data-input').val())));
    $('#usuario-data-input').remove();

    $(document).on('keydown', function(e) {
        if (e.which === 8 && !$(e.target).is("input, select, textarea")) {
            e.preventDefault();
        }
    });

    function imprimirTabla(permisoEscritura, data) {
        var Tabla = generarTabla(data);
        $('#tabla-usuario-container').html(Tabla);
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
                "info": '<strong class="text-gray">USUARIOS</strong> | Mostrando _END_ / _MAX_ registros',
                "infoEmpty": '<strong class="text-gray">USUARIOS</strong> | Mostrando _END_ / _MAX_ registros',
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
            },
            {
                text: '<i class="fa fa-fw fa-file-excel-o"></i> Reporte',
                className: 'btn-tiny exportar-excel-reporte-btn'
            }
        ]
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
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">N°</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">N° DOC.</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">NOMBRES Y APELLIDOS</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">USUARIO</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ROL</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">CARGO</th>' +
            '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ESTADO</th>' +
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
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>' +
            '<th class="filtro"></th>'
            //                
            +
            '</tfoot>' +
            '<tbody>' +
            '</tbody>' +
            '</table>');

        for (var i = 0; i < data.length; i++) {

            var btn_consultar = '<button type="button" class="btn btn-primary btn-xs btn-consultar" data-toggle="tooltip" data-placement="top" title="Consultar"><i class="glyphicon glyphicon-list-alt" style="font-size: 28px;"></i> </button>';
            var btn_modificar = '<button type="button" class="btn btn-success btn-xs btn-modificar"  data-toggle="tooltip" data-placement="top" title="Modificar"><i class="glyphicon glyphicon-pencil" style="font-size: 28px;"></i> </button>';
            var vest = '';
            var numdoc = '';
            var vcargo = '';
            var vtipo_permiso = $("#permiso_usuario").val();

            if(vtipo_permiso == 'LECTURA'){
                btn_modificar = '';
            }

            if(data[i].I_EST == 1 ){ vest = 'ACTIVO' }else{  vest = 'BLOQUEADO'}
            if(data[i].V_NUM_DOC == null){numdoc = ''}else{numdoc = data[i].V_NUM_DOC;}
            if(data[i].V_CARGO == null){vcargo = ''}else{vcargo = data[i].V_CARGO;}

            var correlativo = i + 1;

            tr = $('<tr></tr>');
            tr.append('<td id="c01_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: center;"> </td>' +
                '<td id="c02_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].id + '</td>' +
                '<td id="c03_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + correlativo + '</td>' +
                '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: right;">' + numdoc + '</td>' +
                '<td id="c05_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: left;">' + data[i].V_NOMAPE + '</td>' +
                '<td id="c06_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].V_USUARIO + '</td>' +
                '<td id="c07_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].V_ROL + '</td>' +
                '<td id="c08_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + vcargo + '</td>' +
                '<td id="c08_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + vest + '</td>' +
                '<td id="c09_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;">' + btn_consultar + btn_modificar + '</td>');
            tabla.find('tbody').append(tr);
        }
        return tabla;
    }

    //---------
    $(document).off('click.Nuevo').on('click.Nuevo', '#btn-nuevo', function() {

        var nuevoFormDialog = $('<div id="nuevo-usuario-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center modal-lg"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Usuario</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');

        var formContent = $('<div/>');
        formContent.load(window.base_url + 'usuario/nuevo', {}, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong><h3>Usuario - Nuevo</h3></strong>');

            var formNuevo = nuevoFormDialog.find('#form_nuevo_usuario');
            nuevoFormDialog.find('#nuevo-usuario-dialog-loading').hide();
            validar(formNuevo);
            nuevoFormDialog.on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
                $(this).empty();
                $(this).removeAttr('style');
            });

            nuevoFormDialog.on('click', '#nuevo-usuario-aplicar-btn', function(e) {
                formNuevo.submit(function() {
                    return false;
                });

                nuevoFormDialog.find('#nuevo-usuario-dialog-error').text('').hide();

                if (formNuevo.valid()) {
                    var disabledFields = formNuevo.find(':input:disabled');
                    disabledFields.removeAttr('disabled');
                    var formData = new FormData(formNuevo[0]);

                    disabledFields.attr('disabled', 'disabled');
                    nuevoFormDialog.find('#nuevo-usuario-dialog-loading').show();

                    $.ajax({
                        type: 'POST',
                        data: formData,
                        url: window.base_url + 'usuario/agregar',
                        contentType: false,
                        processData: false,
                        success: function(result) {

                            if (result.substr(0, 3) === 'ERR') {
                                var serverError = result.substr(4);
                                nuevoFormDialog.find('#nuevo-usuario-dialog-loading').hide();
                                mensajeFormulario(nuevoFormDialog.find('#nuevo-usuario-dialog-error'), 'error', true, serverError);
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
        var nuevoFormDialog = $('<div id="nuevo-acceso-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center modal-lg"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Usuario</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');

        var formContent = $('<div/>');
        formContent.load(window.base_url + 'usuario/consultar', { id: vid }, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong><h3>Usuario - Consulta</h3></strong>');

            var formNuevo = nuevoFormDialog.find('#form_consultar_usuario');
            nuevoFormDialog.find('#consultar-usuario-dialog-loading').hide();

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
        var nuevoFormDialog = $('<div id="modificar-usuario-dialog" class="modal fade" role="dialog"><div class="vertical-alignment-container"><div class="modal-dialog vertical-align-center modal-lg"><div class="modal-content"></div></div></div></div>');
        var loadingContent = $(window.loadingForm);
        loadingContent.find('#loading-dialog-body_container').css('height', '210px');
        loadingContent.find('.modal-title').html('<strong>Usuario</strong>');
        nuevoFormDialog.find('.modal-content').html(loadingContent);
        nuevoFormDialog.modal('show');
        var formContent = $('<div/>');
        formContent.load(window.base_url + 'usuario/modificar', { id: vid }, function() {
            nuevoFormDialog.find('.modal-content').html(formContent);
            nuevoFormDialog.find('.modal-title').html('<strong><h3>Usuario - Modificar</h3></strong>');
            var formNuevo = nuevoFormDialog.find('#form_modificar_usuario');
            nuevoFormDialog.find('#modificar-usuario-dialog-loading').hide();

            validar(formNuevo);

            nuevoFormDialog.on('hidden.bs.modal', function() {
                $(this).removeData('bs.modal');
                $(this).empty();
                $(this).removeAttr('style');
            });
            //-----
            nuevoFormDialog.on('click', '#modificar-usuario-aplicar-btn', function(e) {
                formNuevo.submit(function() {
                    return false;
                });
                nuevoFormDialog.find('#modificar-usuario-dialog-error').text('').hide();
                if (formNuevo.valid()) {
                    var disabledFields = formNuevo.find(':input:disabled');
                    disabledFields.removeAttr('disabled');
                    var formData = new FormData(formNuevo[0]);
                    disabledFields.attr('disabled', 'disabled');
                    nuevoFormDialog.find('#modificar-usuario-dialog-loading').show();

                    $.ajax({
                        type: 'POST',
                        data: formData,
                        url: window.base_url + 'usuario/agregar1',
                        contentType: false,
                        processData: false,
                        success: function(result) {

                            if (result.substr(0, 3) === 'ERR') {
                                var serverError = result.substr(4);
                                nuevoFormDialog.find('#modificar-usuario-dialog-loading').hide();
                                mensajeFormulario(nuevoFormDialog.find('#modificar-usuario-dialog-error'), 'error', true, serverError);
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

    // Evento para exportar a Excel
    $(document).off('click.ExportarExcel').on('click.ExportarExcel', '.exportar-excel-reporte-btn', function() {
        var vid = $('#id').val();
        var dataStr='id='+vid;

        $.ajax({
            type: 'POST',
            url: window.base_url + 'usuario/exportarExcel',
            data: dataStr,
            cache: false,         
            success: function(result) {

                var downloadAnchor = $("<a>");
                downloadAnchor.attr('href', result);
                $('body').append(downloadAnchor);
                downloadAnchor.attr('download', 'reporte_usuarios.xlsx');
                downloadAnchor[0].click();
                downloadAnchor.remove();
            }
        });

    });
    
    //---------
    function actualizarTabla(permisoEscritura, callback) {
        $('<div class="modal-backdrop fade"></div>').appendTo(document.body);
        $('.loading-table-update').css('display', 'block');
        $.ajax({
            type: 'GET',
            data: 'primera_carga=false',
            url: window.base_url + 'usuario',
            success: function(result) {
                var Data = jQuery.parseJSON(result)['usuario_data'];
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