$(function () {

    'use strict';
  
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
  
    // -----------------------
    // - MONTHLY SALES CHART -
    // -----------------------
  
      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
      // This will get the first returned node in the jQuery collection.
      var salesChart       = new Chart(salesChartCanvas);

      var valoraciones = ['Enero1', 'Febrero2', 'Marzo3', 'Abril', 'Mayo', 'Junio', 'Julio'];
      var avanceprogramado = [65, 59, 80, 81, 56, 55, 40];
      var avancereal = [28, 48, 40, 19, 86, 27, 90];
    
      var salesChartData = {
        labels  : valoraciones,
        datasets: [
          {
            label               : 'Avance Programado',
            fillColor           : 'rgb(32, 37, 90)', //210, 214, 222
            strokeColor         : 'rgb(32, 37, 90)', //210, 214, 222
            pointColor          : 'rgb(32, 37, 90)', //210, 214, 222
            pointStrokeColor    : '#c1c7d1', 
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgb(220,220,220)',
            data                : avanceprogramado
          },
          {
            label               : 'Avance Real',
            fillColor           : 'rgba(52,108,155)',
            strokeColor         : 'rgba(52,108,155)',
            pointColor          : 'rgba(52,108,155)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(52,108,155)',
            data                : avancereal
          }
        ]
      };
    
      var salesChartOptions = {
        // Boolean - If we should show the scale at all
        showScale               : true,
        // Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        // String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        // Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        // Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        // Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        // Boolean - Whether the line is curved between points
        bezierCurve             : true,
        // Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        // Boolean - Whether to show a dot for each point
        pointDot                : false,
        // Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        // Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        // Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        // Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        // Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        // String - A legend template
        legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        // Boolean - whether to make the chart responsive to window resizing
        responsive              : true        
      };
    
      // Create the line chart
      salesChart.Line(salesChartData, salesChartOptions);
  
    



    // ---------------------------
    // - END MONTHLY SALES CHART -
    // ---------------------------
  
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 28770504,
        color    : '#25415a',
        highlight: '#25415a',
        label    : 'Costo Actualizado'
      },
      {
        value    : 24663999,
        color    : '#346c9b',
        highlight: '#346c9b',
        label    : 'Devengado acumulado'
      },
      // {
      //   value    : 1702440.22,
      //   color    : '#3b83bd',
      //   highlight: '#3b83bd',
      //   label    : 'Saldo'
      // },
      // {
      //   value    : 600,
      //   color    : '#6496c8',
      //   highlight: '#6496c8',
      //   label    : 'Safari'
      // },
      // {
      //   value    : 300,
      //   color    : '#a5bfde',
      //   highlight: '#a5bfde',
      //   label    : 'Opera'
      // },
      // {
      //   value    : 100,
      //   color    : '#c4d4e9',
      //   highlight: '#c4d4e9',
      //   label    : 'Navigator'
      // }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
    // -----------------
    // - END PIE CHART -
    // -----------------


    //-------------
    //- BAR CHART -
    //-------------

    var areaBarData = {
      labels  : ['2015','2017','2018','2019','2020'],
      datasets: [
        {
          label               : '2015',
          fillColor           : 'rgb(32, 37, 90)',
          strokeColor         : 'rgb(32, 37, 90)',
          pointColor          : 'rgb(32, 37, 90)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220)',
          data                : [0.06,6.54,10.45,9.44,3.94]
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

    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
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


        //-------------
    //- BAR CHART01
    //-------------

    var areaBarData = {
      labels  : ['2016','2017','2020'],
      datasets: [
        {
          label               : '2015',
          fillColor           : 'rgb(32, 37, 90)',
          strokeColor         : 'rgb(32, 37, 90)',
          pointColor          : 'rgb(32, 37, 90)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220)',
          data                : [5,8.15,12.30]
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

    var barChartCanvas                   = $('#barChart01').get(0).getContext('2d')
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


    //-------------
    //- BAR CHART02
    //-------------

    var areaBarData = {
      labels  : ['Marzo 2019','Abril 2019','Mayo 2020','Junio 2020'],
      datasets: [
        {
          label               : 'Programado',
          fillColor           : 'rgb(32, 37, 90)',
          strokeColor         : 'rgb(32, 37, 90)',
          pointColor          : 'rgb(32, 37, 90)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220)',
          data                : [5,10.15,17.5,30.3]
        },
        {
          label               : 'Ejecutado',
          fillColor           : 'rgb(52, 108, 155)',
          strokeColor         : 'rgb(52, 108, 155)',
          pointColor          : 'rgb(52, 108, 155)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220)',
          data                : [3.5,8.15,12.30,24.9]
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


    /* jQueryKnob */

    $(".knob").knob({
      /*change : function (value) {
        //console.log("change : " + value);
        },
        release : function (value) {
        console.log("release : " + value);
        },
        cancel : function () {
        console.log("cancel : " + this.value);
        },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a = this.angle(this.cv)  // Angle
              , sa = this.startAngle          // Previous start angle
              , sat = this.startAngle         // Start angle
              , ea                            // Previous end angle
              , eat = sat + a                 // End angle
              , r = true;

          this.g.lineWidth = this.lineWidth;

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3);

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value);
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3);
            this.g.beginPath();
            this.g.strokeStyle = this.previousColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
            this.g.stroke();
          }

          this.g.beginPath();
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
          this.g.stroke();

          this.g.lineWidth = 2;
          this.g.beginPath();
          this.g.strokeStyle = this.o.fgColor;
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
          this.g.stroke();

          return false;
        }
      }
    });
    /* END JQUERY KNOB */

    /* jVector Maps
     * ------------
     * Create a world map with markers
     */
    // $('#world-map-markers').vectorMap({
    //   map              : 'world_mill_en',
    //   normalizeFunction: 'polynomial',
    //   hoverOpacity     : 0.7,
    //   hoverColor       : false,
    //   backgroundColor  : 'transparent',
    //   regionStyle      : {
    //     initial      : {
    //       fill            : 'rgba(210, 214, 222, 1)',
    //       'fill-opacity'  : 1,
    //       stroke          : 'none',
    //       'stroke-width'  : 0,
    //       'stroke-opacity': 1
    //     },
    //     hover        : {
    //       'fill-opacity': 0.7,
    //       cursor        : 'pointer'
    //     },
    //     selected     : {
    //       fill: 'yellow'
    //     },
    //     selectedHover: {}
    //   },
    //   markerStyle      : {
    //     initial: {
    //       fill  : '#00a65a',
    //       stroke: '#111'
    //     }
    //   },
    //   markers          : [
    //     { latLng: [41.90, 12.45], name: 'Vatican City' },
    //     { latLng: [43.73, 7.41], name: 'Monaco' },
    //     { latLng: [-0.52, 166.93], name: 'Nauru' },
    //     { latLng: [-8.51, 179.21], name: 'Tuvalu' },
    //     { latLng: [43.93, 12.46], name: 'San Marino' },
    //     { latLng: [47.14, 9.52], name: 'Liechtenstein' },
    //     { latLng: [7.11, 171.06], name: 'Marshall Islands' },
    //     { latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis' },
    //     { latLng: [3.2, 73.22], name: 'Maldives' },
    //     { latLng: [35.88, 14.5], name: 'Malta' },
    //     { latLng: [12.05, -61.75], name: 'Grenada' },
    //     { latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines' },
    //     { latLng: [13.16, -59.55], name: 'Barbados' },
    //     { latLng: [17.11, -61.85], name: 'Antigua and Barbuda' },
    //     { latLng: [-4.61, 55.45], name: 'Seychelles' },
    //     { latLng: [7.35, 134.46], name: 'Palau' },
    //     { latLng: [42.5, 1.51], name: 'Andorra' },
    //     { latLng: [14.01, -60.98], name: 'Saint Lucia' },
    //     { latLng: [6.91, 158.18], name: 'Federated States of Micronesia' },
    //     { latLng: [1.3, 103.8], name: 'Singapore' },
    //     { latLng: [1.46, 173.03], name: 'Kiribati' },
    //     { latLng: [-21.13, -175.2], name: 'Tonga' },
    //     { latLng: [15.3, -61.38], name: 'Dominica' },
    //     { latLng: [-20.2, 57.5], name: 'Mauritius' },
    //     { latLng: [26.02, 50.55], name: 'Bahrain' },
    //     { latLng: [0.33, 6.73], name: 'São Tomé and Príncipe' }
    //   ]
    // });
  
    /* SPARKLINE CHARTS
     * ----------------
     * Create a inline charts with spark line
     */
  
    // -----------------
    // - SPARKLINE BAR -
    // -----------------
    // $('.sparkbar').each(function () {
    //   var $this = $(this);
    //   $this.sparkline('html', {
    //     type    : 'bar',
    //     height  : $this.data('height') ? $this.data('height') : '30',
    //     barColor: $this.data('color')
    //   });
    // });
  
    // -----------------
    // - SPARKLINE PIE -
    // -----------------
    // $('.sparkpie').each(function () {
    //   var $this = $(this);
    //   $this.sparkline('html', {
    //     type       : 'pie',
    //     height     : $this.data('height') ? $this.data('height') : '90',
    //     sliceColors: $this.data('color')
    //   });
    // });
  
    // ------------------
    // - SPARKLINE LINE -
    // ------------------
    // $('.sparkline').each(function () {
    //   var $this = $(this);
    //   $this.sparkline('html', {
    //     type     : 'line',
    //     height   : $this.data('height') ? $this.data('height') : '90',
    //     width    : '100%',
    //     lineColor: $this.data('linecolor'),
    //     fillColor: $this.data('fillcolor'),
    //     spotColor: $this.data('spotcolor')
    //   });
    // });

    //-----------------------------------------------------------------

});
  