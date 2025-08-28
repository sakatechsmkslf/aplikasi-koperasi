/* AdminLTE Dashboard Init
 * Author: Almsaeed Studio
 * Website: https://adminlte.io
 * License: Open source - MIT
 * Description: This file is used to initialize the dashboard widgets
 */

$(function () {
  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  })

  // bootstrap WYSIHTML5 - text editor
  // $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // jvectormap data
  var visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000 // Russia
  }

  // World map by jvectormap - DENGAN PENGECEKAN ELEMENT
  if ($('#world-map-markers').length && $('#world-map-markers').width() > 0) {
    try {
      $('#world-map-markers').vectorMap({
        map: 'usa_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: 'transparent',
        regionStyle: {
          initial: {
            fill: 'rgba(255, 255, 255, 0.9)',
            'fill-opacity': 1,
            stroke: 'rgba(0, 0, 0, 0.05)',
            'stroke-width': 1,
            'stroke-opacity': 1
          }
        },
        markerStyle: {
          initial: {
            r: 9,
            'fill': '#fff',
            'fill-opacity': 1,
            'stroke': '#000',
            'stroke-width': 5,
            'stroke-opacity': 0.4
          }
        },
        markers: visitorsData
      })
    } catch (error) {
      console.log('VectorMap initialization failed:', error)
      // Hide the map container if initialization fails
      $('#world-map-markers').closest('.card').hide()
    }
  }

  // Sparkline charts - DENGAN PENGECEKAN ELEMENT
  var sparklineChartOptions = {
    type: 'line',
    lineColor: '#92c5dc',
    fillColor: '#ebf4f9',
    height: '50',
    width: '80'
  }
  
  // Check if sparkline elements exist before initializing
  if ($('#sparkline-1').length) {
    try {
      $('#sparkline-1').sparkline([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021], sparklineChartOptions)
    } catch (error) {
      console.log('Sparkline 1 initialization failed:', error)
    }
  }

  if ($('#sparkline-2').length) {
    try {
      $('#sparkline-2').sparkline([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921], sparklineChartOptions)
    } catch (error) {
      console.log('Sparkline 2 initialization failed:', error)
    }
  }

  if ($('#sparkline-3').length) {
    try {
      $('#sparkline-3').sparkline([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21], sparklineChartOptions)
    } catch (error) {
      console.log('Sparkline 3 initialization failed:', error)
    }
  }

  // The Calender
  if ($('#calendar').length) {
    $('#calendar').datepicker()
  }

  // SLIMSCROLL FOR CHAT WIDGET
  if ($('#chat-box').length) {
    $('#chat-box').overlayScrollbars({
      height: '250px'
    })
  }

  /* Chart.js Charts */
  // Sales chart - DENGAN PENGECEKAN CANVAS
  var salesChartCanvas = document.getElementById('salesChart')
  if (salesChartCanvas) {
    var salesChart = new Chart(salesChartCanvas.getContext('2d'), {
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Digital Goods',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label: 'Electronics',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 81, 56, 55, 40]
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
      }
    })
  }

  // Donut Chart - DENGAN PENGECEKAN CANVAS
  var donutChartCanvas = document.getElementById('donutChart')
  if (donutChartCanvas) {
    var donutData = {
      labels: [
        'Chrome',
        'IE',
        'FireFox',
        'Safari',
        'Opera',
        'Navigator'
      ],
      datasets: [
        {
          data: [700, 500, 400, 600, 300, 100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        }
      ]
    }
    var donutOptions = {
      maintainAspectRatio: false,
      responsive: true
    }
    // Create pie or donut chart
    // You can switch between pie and donut using the method below.
    new Chart(donutChartCanvas.getContext('2d'), {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
  }

  // Bar chart - DENGAN PENGECEKAN CANVAS
  var areaChartCanvas = document.getElementById('areaChart')
  if (areaChartCanvas) {
    var areaChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label: 'Digital Goods',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label: 'Electronics',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: [65, 59, 80, 81, 56, 55, 40]
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas.getContext('2d'), {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })
  }
})