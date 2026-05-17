/**
 * Define global init charts.
 */
var chartExportInMonth = null;

/**
 * Using JS ajax call to server get data to charts.
 * Response from server JSON format.
 * JS decode JSON format and convert to array.
 */
$(document).ready(function () {
    /**
     * ***************************************************************************************
     * *************** Innit page and call to calculate charts. ******************************
     * ***************************************************************************************
     */
    calculateDataChartExportInMonth(null);

    /**
     * *****************************************************************************************************
     * *************** Catch event selected data statistic and calculate data for charts. ******************
     * *****************************************************************************************************
     */
    //--- 
    $('#btnStatisticChart1').on('click', function () {
        let monthOfChartOutStock = $('#txtChooseMonthForChart1').val(); 
        calculateDataChartExportInMonth(monthOfChartOutStock);
    });
});

/**
 * Function call to server, calculate data statistic data in month.
 * After calculate data and render chart in view.
 * 
 * @param month month of selected, default current month.
 * @return void
 */
function calculateDataChartExportInMonth(monthOfChartOutStock) {
    // Call to server to receipt out stock per month.
    $.ajax({
        url: '/board/chart-out-stock', // Server URL
        data: {
            'month': monthOfChartOutStock ? monthOfChartOutStock : null   // Param send to server, month default current month.
        }, 
        type: 'GET',
        success: function (responseData) {
            // Catch data from server after process success.
            console.log(responseData);
            renderChartExportInMonth(
                responseData.day_in_month,
                responseData.in_stock,
                responseData.out_stock
            );
        }
    })
}

/**
 * Draw bar chart for in and out sotock of month
 * Find to div id chartExportInMonth
 * 
 * @param array List day in month.
 * @param array InStock data in stock in month.
 * @param array OutStock data out stock in month.
 */
function renderChartExportInMonth(dayInMonth, InStock, OutStock) {
    if (chartExportInMonth !== null) {
        chartExportInMonth.destroy();
    }

    const _chartExportInMonth = document.getElementById('chartExportInMonth');
    chartExportInMonth = new Chart(_chartExportInMonth, {
        type: 'bar',
        data: {
            labels: dayInMonth,
            datasets: [
                {
                    label: 'Đơn nhập',
                    data: InStock,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                },
                {
                    label: 'Đơn xuất',
                    data: OutStock,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


/**
 * Draw pie chart for export and import ratio per month
 * Find to div id chartImportExportRatio
 */
const _chartImportExportRatio = document.getElementById('chartImportExportRatio');
new Chart(_chartImportExportRatio, {
    type: 'pie',
    data: {
        labels: [
            'Đơn nhập',
            'Đơn xuất'
        ],
        datasets: [{
            label: 'Thống kê tỷ lệ nhập xuất trong tháng.',
            data: [300, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    },
});

/**
 * Draw line chart for interest rate.
 * Find to div id chartInterestRate
 */
const _chartInterestRate = document.getElementById('chartInterestRate');
new Chart(_chartInterestRate, {
    type: 'line',
    data: {
        labels: ['Ngày 01', 'Ngày 02', 'Ngày 03', 'Ngày 04', 'Ngày 05', 'Ngày 06', 'Ngày 07'],
        datasets: [{
            label: 'Lãi suất.',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(255, 99, 132)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

/**
 * Draw bar chart for in and out sotock of month
 * Find to div id chartExportInMonth
 */
const _chartByCategory = document.getElementById('chartByCategory');
new Chart(_chartByCategory, {
    type: 'bar',
    data: {
        labels: ['Laptop', 'PC', 'Điện thoại', 'Ti vi', 'Phụ kiện'],
        datasets: [
            {
                label: 'Tổng đơn theo danh mục.',
                data: [120, 170, 150, 180, 90],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});