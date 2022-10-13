$(function () {
    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    // var detalleavancefisico = localStorage.getItem("grafico_detalleavancefisico");

    // if(detalleavancefisico != ''){

    //   if( detalleavancefisico.length > 0 ){

    //     var vprogramado = [];
    //     var vreal = [];
  
    //     for (var i = 0; i < detalleavancefisico.length; i++) {
    //         vprogramado.push[i, detalleavancefisico[i].N_PORCT_PROGRAMADO ];
    //     }
  
    //     console.log(vprogramado);
  
    //   }
  
    // }


    // var sin = [], cos = []
    // for (var i = 0; i < 14; i += 0.5) {
    //   sin.push([i, Math.sin(i)])
    //   cos.push([i, Math.cos(i)])
    // }

    // var line_data1 = {
    //   data : sin,
    //   color: '#3c8dbc'
    // }
    // var line_data2 = {
    //   data : cos,
    //   color: '#00c0ef'
    // }

    // $.plot('#line-chart', [line_data1, line_data2], {
    //   grid  : {
    //     hoverable  : true,
    //     borderColor: '#f3f3f3',
    //     borderWidth: 1,
    //     tickColor  : '#f3f3f3'
    //   },
    //   series: {
    //     shadowSize: 0,
    //     lines     : {
    //       show: true
    //     },
    //     points    : {
    //       show: true
    //     }
    //   },
    //   lines : {
    //     fill : false,
    //     color: ['#3c8dbc', '#f56954']
    //   },
    //   yaxis : {
    //     show: true
    //   },
    //   xaxis : {
    //     show: true
    //   }
    // })

    // //Initialize tooltip on hover
    // $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
    //   position: 'absolute',
    //   display : 'none',
    //   opacity : 0.8
    // }).appendTo('body')
    // $('#line-chart').bind('plothover', function (event, pos, item) {

    //   if (item) {
    //     var x = item.datapoint[0].toFixed(2),
    //         y = item.datapoint[1].toFixed(2)

    //     $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
    //       .css({ top: item.pageY + 5, left: item.pageX + 5 })
    //       .fadeIn(200)
    //   } else {
    //     $('#line-chart-tooltip').hide()
    //   }

    // })
    /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    // var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
    //   [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
    //   [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
    // $.plot('#area-chart', [areaData], {
    //   grid  : {
    //     borderWidth: 0
    //   },
    //   series: {
    //     shadowSize: 0, // Drawing is faster without shadows
    //     color     : '#00c0ef'
    //   },
    //   lines : {
    //     fill: true //Converts the line chart to area chart
    //   },
    //   yaxis : {
    //     show: false
    //   },
    //   xaxis : {
    //     show: false
    //   }
    // })

    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    // var bar_data = {
    //   data : [['January', 10], ['February', 8], ['March', 4], ['April', 13], ['May', 17], ['June', 9]],
    //   color: '#3c8dbc'
    // }
    // $.plot('#bar-chart', [bar_data], {
    //   grid  : {
    //     borderWidth: 1,
    //     borderColor: '#f3f3f3',
    //     tickColor  : '#f3f3f3'
    //   },
    //   series: {
    //     bars: {
    //       show    : true,
    //       barWidth: 0.5,
    //       align   : 'center'
    //     }
    //   },
    //   xaxis : {
    //     mode      : 'categories',
    //     tickLength: 0
    //   }
    // })
    /* END BAR CHART */

    /*
     * DONUT CHART
     * -----------
     */

    // var donutData = [
    //   { label: 'Series2', data: 30, color: '#3c8dbc' },
    //   { label: 'Series3', data: 20, color: '#0073b7' },
    //   { label: 'Series4', data: 50, color: '#00c0ef' }
    // ]
    // $.plot('#donut-chart', donutData, {
    //   series: {
    //     pie: {
    //       show       : true,
    //       radius     : 1,
    //       innerRadius: 0.5,
    //       label      : {
    //         show     : true,
    //         radius   : 2 / 3,
    //         formatter: labelFormatter,
    //         threshold: 0.1
    //       }

    //     }
    //   },
    //   legend: {
    //     show: false
    //   }
    // })
    /*
     * END DONUT CHART
     */

  })