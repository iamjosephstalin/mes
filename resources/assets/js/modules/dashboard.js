'use strict';

import {showConfirmation} from './common-function';
import DataTable from 'datatables.net-bs5';
import axios from 'axios';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis';
import 'datatables.net-buttons/js/buttons.flash';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import '../../css/datatables.bootstrap5.css';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import '@popperjs/core';
import '@form-validation/plugin-bootstrap';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';

pdfMake.vfs = pdfFonts.pdfMake.vfs

// $('#table-currency').hide();
document.addEventListener('DOMContentLoaded', function () {

let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;
      // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalHoursChartEl = document.querySelector('#totalHoursChart'),
  totalHoursChartOptions = {
    chart: {
        type: 'bar'
      },
      series: [{
        data: [{
          x: 'category A',
          y: 10
        }, {
          x: 'category B',
          y: 18
        }, {
          x: 'category C',
          y: 13
        }]
      }],
      plotOptions:{
        bar:{
            columnWidth: '10%',
        }
    }
  };
    if (typeof totalHoursChartEl !== undefined && totalHoursChartEl !== null) {
    const totalHoursChart = new ApexCharts(totalHoursChartEl, totalHoursChartOptions);
    totalHoursChart.render();
    }

  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalIndicatorsChartEl = document.querySelector('#totalIndicatorsChart'),
  totalIndicatorsOptions = {
    chart: {
        type: 'bar'
      },
      series: [{
        data: [{
          x: 'category A',
          y: 10
        }, {
          x: 'category B',
          y: 18,
          fillColor: '#EB8C87',
          strokeColor: '#C23829'
        }, {
          x: 'category C',
          y: 13
        }]
      }],
      plotOptions:{
        bar:{
            columnWidth: '10%',
        }
    }
  };
    if (typeof totalIndicatorsChartEl !== undefined && totalIndicatorsChartEl !== null) {
    const totalIndicatorsChart = new ApexCharts(totalIndicatorsChartEl, totalIndicatorsOptions);
    totalIndicatorsChart.render();
    }

      // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const productionHoursChartEl = document.querySelector('#productionHoursChart'),
  productionHoursChartOptions = {
    chart: {
        type: 'bar',
        height: '400px'
    },
    series: [{
        data: [{
          x: 'category A',
          y: 10
        }, {
          x: 'category B',
          y: 18,
          fillColor: '#EB8C87',
          strokeColor: '#C23829'
        }, {
          x: 'category C',
          y: 13
        }]
    }],
    plotOptions:{
        bar:{
            columnWidth: '15%',
        }
    }
  };
    if (typeof productionHoursChartEl !== undefined && productionHoursChartEl !== null) {
    const productionHoursChart = new ApexCharts(productionHoursChartEl, productionHoursChartOptions);
    productionHoursChart.render();
    }

    const productionIndicatorsChartEl = document.querySelector('#productionIndicatorsChart'),
    productionIndicatorsOptions = {
      chart: {
          type: 'bar',
          height: '400px'
        },
        series: [{
          data: [{
            x: 'category A',
            y: 10
          }, {
            x: 'category B',
            y: 18,
            fillColor: '#EB8C87',
            strokeColor: '#C23829'
          }, {
            x: 'category C',
            y: 13
          }]
        }],
        plotOptions:{
          bar:{
              columnWidth: '10%',
          }
      }
    };
      if (typeof productionIndicatorsChartEl !== undefined && productionIndicatorsChartEl !== null) {
      const productionIndicatorsChart = new ApexCharts(productionIndicatorsChartEl, productionIndicatorsOptions);
      productionIndicatorsChart.render();
      }

      const machineTotalHoursChartEl = document.querySelector('#machineTotalHoursChart'),
      machineTotalHoursOptions = {
        chart: {
            type: 'bar',
            height: '400px'
          },
          series: [{
            data: [{
              x: 'category A',
              y: 10
            }, {
              x: 'category B',
              y: 18,
              fillColor: '#EB8C87',
              strokeColor: '#C23829'
            }, {
              x: 'category C',
              y: 13
            }]
          }],
          plotOptions:{
            bar:{
                columnWidth: '10%',
            }
        }
      };
        if (typeof machineTotalHoursChartEl !== undefined && machineTotalHoursChartEl !== null) {
        const machineTotalHoursChart = new ApexCharts(machineTotalHoursChartEl, machineTotalHoursOptions);
        machineTotalHoursChart.render();
        }

        const dailyChartEl = document.querySelector('#dailyChart'),
        dailyChartOptions = {
            chart: {
                height: 350,
                type: "line",
                stacked: false
              },
              dataLabels: {
                enabled: false
              },
              colors: ["#FF1654", "#247BA0"],
              series: [
                {
                  name: "Series A",
                  data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                },
                {
                  name: "Series B",
                  data: [20, 29, 37, 36, 44, 45, 50, 58]
                }
              ],
              stroke: {
                width: [4, 4]
              },
              plotOptions: {
                bar: {
                  columnWidth: "20%"
                }
              },
              xaxis: {
                categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
              },
              yaxis: [
                {
                  axisTicks: {
                    show: true
                  },
                  axisBorder: {
                    show: true,
                    color: "#FF1654"
                  },
                  labels: {
                    style: {
                      colors: "#FF1654"
                    }
                  },
                  title: {
                    text: "Series A",
                    style: {
                      color: "#FF1654"
                    }
                  }
                },
                {
                  opposite: true,
                  axisTicks: {
                    show: true
                  },
                  axisBorder: {
                    show: true,
                    color: "#247BA0"
                  },
                  labels: {
                    style: {
                      colors: "#247BA0"
                    }
                  },
                  title: {
                    text: "Series B",
                    style: {
                      color: "#247BA0"
                    }
                  }
                }
              ],
              tooltip: {
                shared: false,
                intersect: true,
                x: {
                  show: false
                }
              },
              legend: {
                horizontalAlign: "left",
                offsetX: 40
              }
        };
          if (typeof dailyChartEl !== undefined && dailyChartEl !== null) {
          const dailyChart = new ApexCharts(dailyChartEl,dailyChartOptions);
          dailyChart.render();
          }

});









