@extends("main")
@section("content")
<div id="content">
    <div id="total" class="col-md-12">
        <div class="row">
            <div id="order-shipping" class="box-total">
                <h1>{{ number_format($callTotal['receipt_delivery'], 0) }}</h1>
                <hr>
                <p>Tổng số đơn hàng đang vận chuyển</p>
            </div>
            <div id="order-in-stock" class="box-total">
                <h1>{{ number_format($callTotal['receipt_in_stock'], 0) }}</h1>
                <hr>
                <p>Tổng số đơn nhập kho</p>
            </div>
            <div id="order-out-stock" class="box-total">
                <h1>{{ number_format($callTotal['receipt_out_stock'], 0) }}</h1>
                <hr>
                <p>Tổng số đơn xuất kho</p>
            </div>
            <div id="order-profit" class="box-total">
                <h1>{{ number_format($callTotal['profit'], 3) }}%</h1>
                <hr>
                <p>Tỷ suất lợi nhuận</p>
            </div>
        </div>
    </div>
    <!-- Begin charts -->
    <div id="charts" class="col-md-12">
        <div class="row">
            <div id="areaExportInMonth" class="col-md-8">
                <h4>Biểu đồ thống kê đơn nhập xuất theo tháng.</h4>
                <div class="col-md-12 d-flex">
                    <input type="month" id="txtChooseMonthForChart1" class="form-control txt-choose-month">
                    &nbsp;
                    <button class="btn btn-primary" id="btnStatisticChart1">Thống kê</button>
                </div>
                <div class="clear-fix"></div>
                <div>
                    <canvas id="chartExportInMonth"></canvas>
                </div>
            </div>
            <div id="areaInportExportRatioMonth" class="col-md-4">
                <h4>Thống kê tỷ lệ giữa nhập và xuất của tháng.</h4>
                <div class="col-md-12 d-flex">
                    <input type="datetime-local" id="txtChooseMonthForChart2" class="form-control txt-choose-month">
                    &nbsp;
                    <button class="btn btn-primary">Thống kê</button>
                </div>
                <div class="clear-fix"></div>
                <div>
                    <canvas id="chartImportExportRatio"></canvas>
                </div>
            </div>
            <div class="clear-fix"></div>  
            <div id="areaChartInterestRate" class="col-md-7">
                <h4>Biểu đồ thể hiện lãi suất.</h4>
                <div class="col-md-12 d-flex">
                    <input type="datetime-local" id="txtFromDateForChart3" class="form-control txt-choose-month">
                    &nbsp;
                    <input type="datetime-local" id="txtToDateForChart3" class="form-control txt-choose-month">
                    &nbsp;
                    <button class="btn btn-primary">Thống kê</button>
                </div>
                <div class="clear-fix"></div>
                <div>
                    <canvas id="chartInterestRate"></canvas>
                </div>
            </div>
            <div id="areaChartByCategory" class="col-md-5">
                <h4>Thống kê số lượng sản phẩm theo danh mục.</h4>
                <div class="clear-fix"></div>
                <div class="clear-fix"></div>
                <div>
                    <canvas id="chartByCategory"></canvas>
                </div>
                <br>
                <p>- Thống kê theo các mốc thời gian, bạn có thể lựa chọn tuỳ ý.</p>
                <p>- Đối với biểu đồ thể hiện lãi suất sẽ thống kê theo 1 khoảng thời gian.</p>
                <p>- Đối với biểu đồ tổng số đơn hàng theo danh mục sẽ là tổng thời gian từ đầu đến cuối.</p>
            </div>
        </div>
    </div>
    <!-- End charts -->
</div>
@endsection