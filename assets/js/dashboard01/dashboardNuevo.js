$(document).ready(function() {

    $('#infraestructura').select2({
        placeholder: "Escoger...",
        allowClear: true,
        width: '100%',
        language: 'es',
        ajax: {
            url: window.base_url + 'Dashboard01/OpcionesSelect',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    tabla: 'infraestructura01',
                    columna: params.term,
                    valor: params.term,
                    page: params.page
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            cache: true
        },
        minimumInputLength: 0
    }).on('change', function() {

        var id = $('#infraestructura').val();
        if (id == null) {
            $('#h_infraestructura').val('');
            return;
        }
        $('#h_infraestructura').val( id );
        $('#proyecto').val('');

        $('#proyecto').select2({
            placeholder: "Escoger...",
            allowClear: true,
            width: '100%',
            language: 'es',
            ajax: {
                url: window.base_url + 'Dashboard01/OpcionesSelectP',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        tabla: 'proyecto01',
                        columna: params.term,
                        valor: params.term,
                        page: params.page,
                        parametro: $('#h_infraestructura').val()
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                cache: true
            },
            minimumInputLength: 0
        }).on('change', function() {
        });
    
    });

    //---------  VALORES POR DEFECTO
    $("#avance_proyecto").text('0%');
    $("#pescadores").text('0');
    $("#monto_inversion").text('0');
    $("#familiares").text('0');
    var base_url = $("#h_base_url").val();
    $("#foto_jefe_proyecto").attr("src", base_url + "upload/default.jpg");
    $("#fecha_prog_reinicio").text('PROG.');
    $("#fecha_ejec_reinicio").text('EJEC.');
    $("#fecha_prog_culminacion").text('PROG.');
    $("#fecha_ejec_culminacion").text('EJEC.');
    $("#fecha_prog_hs").text('PROG.');
    $("#fecha_ejec_hs").text('EJEC.');
    $("#fecha_prog_inaguracion").text('PROG.');
    $("#fecha_ejec_inaguracion").text('EJEC.');


    //--------- BUSQUEDA
    $(document).off('click.Buscar').on('click.Buscar', '#btn-buscar', function() {

        var vproyecto = $('#proyecto').val();
        var vinfraestructura = $('#infraestructura').val();

        if( vproyecto > 0 && vinfraestructura > 0 ){
            // console.log(vproyecto);
            // console.log(vinfraestructura);    

            var formData = new FormData();
            formData.append('infraestructura', vinfraestructura);
            formData.append('proyecto', vproyecto);

            $.ajax({
                type: 'POST',
                data: formData,
                url: window.base_url + 'Dashboard01/buscar',
                contentType: false,
                processData: false,
                success: function(result) {

                    var resp = jQuery.parseJSON(result)['fila_detalleinfraestructurayproyecto'];
                    var resp_equipo = jQuery.parseJSON(result)['fila_detalleequipoproyecto'];
                    // var data_equipo = jQuery.parseJSON(result['fila_detalleequipoproyecto']);
                    // console.log(data_equipo);

                    console.log(resp_equipo);
                    var vdet = '';
                    // $("#equipo").remove();
                    $('#equipo').empty();

                    if(resp_equipo.length > 0 ){
                      for (var i = 0; i < resp_equipo.length; i ++) {

                        var cont = i + 1;

                        vdet = '';
                        vdet += '<li id="li_equipo">';
                        vdet += '<img src="'+ window.base_url + 'upload/equipo/user0'+ cont +'.jpg" alt="User Image">';
                        vdet += '<a class="users-list-name" href="#">'+ resp_equipo[i].V_NOM + ' ' + resp_equipo[i].V_APE +'</a>';
                        vdet += '<span class="users-list-date">'+ resp_equipo[i].V_ESP +'</span>';
                        vdet += '</li>';

                        $("#equipo").append( vdet );
                      }
                    }

                    // return;

                    if (result.substr(0, 3) === 'ERR') {
                        var serverError = result.substr(4);
                        mensajeFormulario($('#nuevo-obra-error'), 'error', true, serverError);
                    } else {

                        $("#snip").text(resp['V_COD_SNIP']);
                        $("#coduniinv").text(resp['V_COD_UNI_INV']);
                        $("#proyinv").text(resp['V_NOM']);
                        $("#contratista").text(resp['CONTRATISTA']);
                        $("#supervisor").text(resp['SUPERVISOR']);
    
                        var vmonto_inversion = resp['N_MON_INVERSION'];
                        vmonto_inversion = (vmonto_inversion / 1000000);
                        vmonto_inversion = Math.trunc(vmonto_inversion) + ' M';
    
                        $("#avance_proyecto").text( resp['N_AVANCE_FIS'] + ' %');
                        $("#pescadores").text(resp['I_NUM_PESC']);
                        $("#monto_inversion").text(vmonto_inversion);
                        $("#familiares").text(resp['I_NUM_FAM']);

                        $("#jefe_proyecto").text(resp['JEFE_PROYECTO']);
                        var base_url = $("#h_base_url").val();
                        $("#foto_jefe_proyecto").attr("src", base_url + "upload/jefe/" + resp['FOTO_JEFE_PROYECTO'] );
    
                        var vnombredpa = resp['Infra_Nombre'];
                        var vlatitud = parseFloat(resp['Infra_Latitud']);
                        var vlongitud = parseFloat(resp['Infra_Longitud']);

                        initMap(vnombredpa,vlatitud,vlongitud);
                        
                        $("#fecha_prog_reinicio").text('PROG.' + resp['D_FEC_PRO_REINICIO']);
                        $("#fecha_ejec_reinicio").text('EJEC.' + resp['D_FEC_EJE_REINICIO']);
                        $("#fecha_prog_culminacion").text('PROG.' + resp['D_FEC_PRO_CULMINACION']);
                        $("#fecha_ejec_culminacion").text('EJEC.' + resp['D_FEC_EJE_CULMINACION']);
                        $("#fecha_prog_hs").text('PROG.' + resp['D_FEC_PRO_HABILITACION']);
                        $("#fecha_ejec_hs").text('EJEC.' + resp['D_FEC_EJE_HABILITACION']);
                        $("#fecha_prog_inaguracion").text('PROG.' + resp['D_FEC_PRO_INAGURACION']);
                        $("#fecha_ejec_inaguracion").text('EJEC.' + resp['D_FEC_EJE_INAGURACION']);

                        $("#area_total").text(resp['N_AREA_TOTAL']);
                        $("#area_construida_tierra").text(resp['N_AREA_CONSTRUIDA_TIERRA']);
                        $("#area_construida_mar").text(resp['N_AREA_CONSTRUIDA_MAR']);
                        $("#longitud_espigon").text(resp['N_LONG_ESPIGON']);

                                            
                        //BUSCAR DETALLES
                        var vid = resp['I_ID_OBRA'];
                        var formData = new FormData();
                        formData.append('id', vid);
                        
                        $.ajax({
                            type: 'POST',
                            data: formData,
                            url: window.base_url + 'Dashboard01/buscar_obra',
                            contentType: false,
                            processData: false,
                            success: function(result) {

                                var data_alcance = jQuery.parseJSON(result)['fila_detallealcance'];
                                if(data_alcance.length > 0 ){
                                  // console.log(data_alcance);

                                  imprimirTablaAvance(true, data_alcance);

                                }

                                var data_adjunto = jQuery.parseJSON(result)['fila_detalleadjunto'];

                                if(data_adjunto.length > 0 ){
                                  for (var i = 0; i < data_adjunto.length; i ++) {

                                    if( data_adjunto[i].I_UBICACION == 1 ){
                                      $("#imagen01").attr("src", window.base_url + 'upload/obra/' + data_adjunto[i].V_ADJ  );
                                    }

                                    if( data_adjunto[i].I_UBICACION == 2 ){
                                      $("#imagen02").attr("src", window.base_url + 'upload/obra/' + data_adjunto[i].V_ADJ  );
                                    }

                                    if( data_adjunto[i].I_UBICACION == 3 ){
                                      $("#imagen03").attr("src", window.base_url + 'upload/obra/' + data_adjunto[i].V_ADJ  );
                                    }

                                    if( data_adjunto[i].I_UBICACION == 4 ){
                                      $("#imagen04").attr("src", window.base_url + 'upload/obra/' + data_adjunto[i].V_ADJ  );
                                    }

                                    if( data_adjunto[i].I_UBICACION == 5 ){
                                      $("#imagen05").attr("src", window.base_url + 'upload/obra/' + data_adjunto[i].V_ADJ  );
                                    }
                                    
                                  }
                                }

                                var data = jQuery.parseJSON(result)['fila_detalleavancefisico'];
                                if( data.length > 0){

                                        // Curva S
                                        var sin = [], cos = []
                                        var data_programada = [], data_real = [], data_mes = []

                                        for (var i = 0; i < data.length; i ++) {
                                            sin.push([ data[i].I_NUM , data[i].N_PORCT_PROGRAMADO ])
                                            cos.push([ data[i].I_NUM , data[i].N_PORCT_REAL ])

                                            data_programada.push( data[i].N_PORCT_PROGRAMADO );
                                            data_real.push( data[i].N_PORCT_REAL );
                                            data_mes.push( data[i].D_FEC_VALORIZACION );
                                        }
  
                                        var line_data1 = {
                                          data : sin,
                                          color: '#3c8dbc'
                                        }
                                        var line_data2 = {
                                          data : cos,
                                          color: '#00c0ef'
                                        }

                                        $.plot('#line-chart', [line_data1, line_data2], {
                                          grid  : {
                                            hoverable  : true,
                                            borderColor: '#f3f3f3',
                                            borderWidth: 1,
                                            tickColor  : '#f3f3f3'
                                          },
                                          series: {
                                            shadowSize: 0,
                                            lines     : {
                                              show: true
                                            },
                                            points    : {
                                              show: true
                                            }
                                          },
                                          lines : {
                                            fill : false,
                                            color: ['#3c8dbc', '#f56954']
                                          },
                                          yaxis : {
                                            show: true
                                          },
                                          xaxis : {
                                            show: true
                                          }
                                        })

                                        //Initialize tooltip on hover
                                        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
                                          position: 'absolute',
                                          display : 'none',
                                          opacity : 0.8
                                        }).appendTo('body')
                                        $('#line-chart').bind('plothover', function (event, pos, item) {

                                          if (item) {
                                            var x = item.datapoint[0].toFixed(2),
                                                y = item.datapoint[1].toFixed(2)

                                            $('#line-chart-tooltip').html('N° ' + x + ' - ' + y + ' %')
                                              .css({ top: item.pageY + 5, left: item.pageX + 5 })
                                              .fadeIn(200)
                                          } else {
                                            $('#line-chart-tooltip').hide()
                                          }

                                        })
                                        /* END LINE CHART */

                                        // Comparación Mensual

                                        var areaBarData = {
                                            labels  : data_mes,
                                            datasets: [
                                              {
                                                label               : 'Programado',
                                                fillColor           : 'rgb(60, 141, 188)',
                                                strokeColor         : 'rgb(60, 141, 188)',
                                                pointColor          : 'rgb(60, 141, 188)',
                                                pointStrokeColor    : '#c1c7d1',
                                                pointHighlightFill  : '#fff',
                                                pointHighlightStroke: 'rgba(220,220,220)',
                                                data                : data_programada
                                              },
                                              {
                                                label               : 'Ejecutado',
                                                fillColor           : 'rgb(0, 192, 239)',
                                                strokeColor         : 'rgb(0, 192, 239)',
                                                pointColor          : 'rgb(0, 192, 239)',
                                                pointStrokeColor    : '#c1c7d1',
                                                pointHighlightFill  : '#fff',
                                                pointHighlightStroke: 'rgba(220,220,220)',
                                                data                : data_real
                                              }
                                            ],
                                            
                                            options: {
                                              responsive: true,
                                              legend: {
                                                position: 'bottom',
                                              },
                                              title: {
                                                display: false,
                                                text: 'Chart.js Doughnut Chart'
                                              },
                                              animation: {
                                                animateScale: true,
                                                animateRotate: true
                                              },
                                              tooltips: {
                                                callbacks: {
                                                  label: function(tooltipItem, data) {
                                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                                      return previousValue + currentValue;
                                                    });
                                                    var currentValue = dataset.data[tooltipItem.index];
                                                    var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
                                                    return precentage + "%";
                                                  }
                                                }
                                              }
                                            }
                                            
                                          }
                                      
                                          var barChartCanvas                   = $('#barChart02').get(0).getContext('2d')
                                          var barChart                         = new Chart(barChartCanvas)
                                          var barChartData                     = areaBarData
                                          
                                          var barChartOptions                  = {
                                            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                                            scaleBeginAtZero        : true,
                                            //Boolean - Whether grid lines are shown across the chart
                                            scaleShowGridLines      : true,
                                            //String - Colour of the grid lines
                                            scaleGridLineColor      : 'rgba(0,0,0,.05)',
                                            //Number - Width of the grid lines
                                            scaleGridLineWidth      : 1,
                                            //Boolean - Whether to show horizontal lines (except X axis)
                                            scaleShowHorizontalLines: true,
                                            //Boolean - Whether to show vertical lines (except Y axis)
                                            scaleShowVerticalLines  : true,
                                            //Boolean - If there is a stroke on each bar
                                            barShowStroke           : true,
                                            //Number - Pixel width of the bar stroke
                                            barStrokeWidth          : 2,
                                            //Number - Spacing between each of the X value sets
                                            barValueSpacing         : 5,
                                            //Number - Spacing between data sets within X values
                                            barDatasetSpacing       : 1,
                                            //String - A legend template
                                            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                                            //Boolean - whether to make the chart responsive
                                            responsive              : true,
                                            maintainAspectRatio     : true
                                          }
                                      
                                          barChartOptions.datasetFill = false
                                          barChart.Bar(barChartData, barChartOptions)

                                        //-------
                                        
                                        

                                        //-------

                                }else{


                                        // Curva S
                                        var sin = [], cos = []
                                        var data_programada = [], data_real = [], data_mes = []
    
                                        var line_data1 = {
                                            data : sin,
                                            color: '#3c8dbc'
                                        }
                                        var line_data2 = {
                                            data : cos,
                                            color: '#00c0ef'
                                        }

                                        $.plot('#line-chart', [line_data1, line_data2], {
                                            grid  : {
                                            hoverable  : true,
                                            borderColor: '#f3f3f3',
                                            borderWidth: 1,
                                            tickColor  : '#f3f3f3'
                                            },
                                            series: {
                                            shadowSize: 0,
                                            lines     : {
                                                show: true
                                            },
                                            points    : {
                                                show: true
                                            }
                                            },
                                            lines : {
                                            fill : false,
                                            color: ['#3c8dbc', '#f56954']
                                            },
                                            yaxis : {
                                            show: true
                                            },
                                            xaxis : {
                                            show: true
                                            }
                                        })

                                        //Initialize tooltip on hover
                                        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
                                            position: 'absolute',
                                            display : 'none',
                                            opacity : 0.8
                                        }).appendTo('body')
                                        $('#line-chart').bind('plothover', function (event, pos, item) {

                                            if (item) {
                                            var x = item.datapoint[0].toFixed(2),
                                                y = item.datapoint[1].toFixed(2)

                                            $('#line-chart-tooltip').html('N° ' + x + ' - ' + y + ' %')
                                                .css({ top: item.pageY + 5, left: item.pageX + 5 })
                                                .fadeIn(200)
                                            } else {
                                            $('#line-chart-tooltip').hide()
                                            }

                                        })
                                        /* END LINE CHART */

                                        // Comparación Mensual

                                        var areaBarData = {
                                            labels  : [],
                                            datasets: [
                                                {
                                                label               : 'Programado',
                                                fillColor           : 'rgb(60, 141, 188)',
                                                strokeColor         : 'rgb(60, 141, 188)',
                                                pointColor          : 'rgb(60, 141, 188)',
                                                pointStrokeColor    : '#c1c7d1',
                                                pointHighlightFill  : '#fff',
                                                pointHighlightStroke: 'rgba(220,220,220)',
                                                data                : []
                                                },
                                                {
                                                label               : 'Ejecutado',
                                                fillColor           : 'rgb(0, 192, 239)',
                                                strokeColor         : 'rgb(0, 192, 239)',
                                                pointColor          : 'rgb(0, 192, 239)',
                                                pointStrokeColor    : '#c1c7d1',
                                                pointHighlightFill  : '#fff',
                                                pointHighlightStroke: 'rgba(220,220,220)',
                                                data                : []
                                                }
                                            ],
                                            
                                            options: {
                                                responsive: true,
                                                legend: {
                                                position: 'bottom',
                                                },
                                                title: {
                                                display: false,
                                                text: 'Chart.js Doughnut Chart'
                                                },
                                                animation: {
                                                animateScale: true,
                                                animateRotate: true
                                                },
                                                tooltips: {
                                                callbacks: {
                                                    label: function(tooltipItem, data) {
                                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                                        return previousValue + currentValue;
                                                    });
                                                    var currentValue = dataset.data[tooltipItem.index];
                                                    var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
                                                    return precentage + "%";
                                                    }
                                                }
                                                }
                                            }
                                            
                                            }
                                        
                                            var barChartCanvas                   = $('#barChart02').get(0).getContext('2d')
                                            var barChart                         = new Chart(barChartCanvas)
                                            var barChartData                     = areaBarData
                                            
                                            var barChartOptions                  = {
                                            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                                            scaleBeginAtZero        : true,
                                            //Boolean - Whether grid lines are shown across the chart
                                            scaleShowGridLines      : true,
                                            //String - Colour of the grid lines
                                            scaleGridLineColor      : 'rgba(0,0,0,.05)',
                                            //Number - Width of the grid lines
                                            scaleGridLineWidth      : 1,
                                            //Boolean - Whether to show horizontal lines (except X axis)
                                            scaleShowHorizontalLines: true,
                                            //Boolean - Whether to show vertical lines (except Y axis)
                                            scaleShowVerticalLines  : true,
                                            //Boolean - If there is a stroke on each bar
                                            barShowStroke           : true,
                                            //Number - Pixel width of the bar stroke
                                            barStrokeWidth          : 2,
                                            //Number - Spacing between each of the X value sets
                                            barValueSpacing         : 5,
                                            //Number - Spacing between data sets within X values
                                            barDatasetSpacing       : 1,
                                            //String - A legend template
                                            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                                            //Boolean - whether to make the chart responsive
                                            responsive              : true,
                                            maintainAspectRatio     : true
                                            }
                                        
                                            barChartOptions.datasetFill = false
                                            barChart.Bar(barChartData, barChartOptions)

                                            //----------

                                }

                                // $('#avancefisico-data-input').val(result);
                                // var Data = jQuery.parseJSON(result);
                                // jQuery.parseJSON(decodeURIComponent(result));
                                // imprimirTablaAvance(true, Data);
                                // console.log(Data);
                            }
                        });


                    }

                }
            });

        }else{
            mensajeSwal('buscar.dashboard');
        }


    });


    function imprimirTablaAvance(permisoEscritura, data) {
      var Tabla = generarTablaAvance(data);
      $('#tabla-avance-container').html(Tabla);
      if ($.fn.dataTable.isDataTable('#tabla-avance')) {
          $('#tabla-avance').DataTable().clear().destroy();
      }

      $('#tabla-avance').DataTable({
          "bDestroy": true,
          "paging": true,
          "pageLength": 5,
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
              "info": '<strong class="text-gray">AVANCE</strong> | Mostrando _END_ / _MAX_ registros',
              "infoEmpty": '<strong class="text-gray">AVANCE</strong> | Mostrando _END_ / _MAX_ registros',
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

  function generarTablaAvance(data) {
    var tabla, tr;
    var vcolorcab = "background-color: #E6E6E6;";
    tabla = $('<table id="tabla-avance" class="table table-condensed">' +
        '<thead>' +
        '<tr>'
        //0
        +
        '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '"></th>' +
        '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ID</th>' +
        '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">DESCRIPCIÓN</th>' +
        '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">PORCENTAJE</th>' +
        '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">%</th>'
        // '<th style="text-align: center; vertical-align: middle;' + vcolorcab + '">ACCIONES</th>'
        //                
        +
        '</tr>' +
        '</thead>' +
        '<tfoot>'
        //0
        +
        '<th class="no_filtro"></th>' +
        '<th class="filtro"></th>' +
        // '<th class="filtro"></th>' +
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

          var btn_consultar = '<button type="button" class="btn btn-primary btn-xs btn-consultar"><i class="glyphicon glyphicon-list-alt"></i> Consultar</button>';
          var btn_modificar = '<button type="button" class="btn btn-success btn-xs btn-modificar-avance"><i class="glyphicon glyphicon-pencil"></i> Modificar</button>';
          var btn_borrar = '<button type="button" class="btn btn-danger btn-xs btn-borrar-avance"><i class="glyphicon glyphicon-trash"></i> Borrar</button>';

          var vdesc01 = data[i].V_DESC01;
          var vdesc02 = data[i].V_DESC02;
          var vdesc03 = data[i].V_DESC03;
          var vporcent = data[i].N_PORCT;

          if( vdesc01 == null ){ vdesc01 = '' }
          if( vdesc02 == null ){ vdesc02 = '' }
          if( vdesc03 == null ){ vdesc03 = '' }
          if( vporcent == null ){ vporcent = '' }

          if( vporcent != '' ){
            // vporcent = '<div class="progress-bar" style="width: ' + vporcent +'%" style="background-color: #00c0ef;"></div>';
          }

          tr = $('<tr></tr>');
          tr.append('<td id="c01_tabla-text-' + data[i].id + '-' + vporcent + '" class="no_edit_td_lock" style="text-align: center;"> </td>' +
              '<td id="c02_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + data[i].id + '</td>' +
              '<td id="c04_tabla-text-' + data[i].id + '" class="no_edit_td_lock" style="text-align: left;">' + vdesc02 + ' ' + vdesc03 + '</td>' +
              '<td id="c06_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;"> <div class="progress progress-xs"> <div class="progress-bar" style="width: '+ vporcent +'%" style="background-color: #00c0ef;"></div></div>  </td>' +
              '<td id="c07_tabla-text-' + data[i].id + '" class="no_edit_td" style="text-align: center;"> <span class="badge" style="background-color: #39CCCC;">' + vporcent + '%</span> </td>' );
              
          tabla.find('tbody').append(tr);
      }
      return tabla;
  }

    //--------- MAPA
    initMap('SEDE CENTRAL',-12.063266743004826,-77.0359750846559);

    function initMap(pnomre,platitud,plongitud) {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: platitud, lng: plongitud},
          zoom: 18,
          mapTypeId: google.maps.MapTypeId.SATELLITE
        });        


        var marker = new google.maps.Marker({
            position: {lat: platitud, lng: plongitud},
            map: map,
            title: pnomre,
            // icon: "https://reviblog.net/wp-content/uploads/2017/03/marcador.png",
          });

        marker.setMap(map); 

    //   google.maps.event.addListener(marker, 'click', function() {
    //     alert('Latitud = '+marker.getPosition().lat()+ ', Longitud = '+marker.getPosition().lng());
    //   });
        
    }

    //-------------------
});