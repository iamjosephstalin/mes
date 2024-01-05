@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script type="module" src="{{ mix('js/modules/dashboard.js') }}"></script>
@endsection

@section('content')

<div class="row mt-2 bg-light p-3">
    <div class="row mb-4">
        <div class="col-12 p-3 d-flex justify-content-between " style="background-color: #d9e1e7">
            <span class="fw-bold fs-5">Production - monthly report : 2024-01</span>
            <button class="btn btn-primary rounded-pill"><i class='bx bxs-calendar'></i> switch to daily</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-6">
            <span class="fs-4 fw-bold mb-2">Production - total hours</span>
            <div id="totalHoursChart"></div>
        </div>
        <div class="col-6">
            <span class="fs-4 fw-bold mb-2">Production - indicators</span>
            <div id="totalIndicatorsChart"></div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-4 product-dark p-3 border-end border-white">
            <div class="row mb-2">
                <div class="col-6">
                    Total Working time : 
                </div>
                <div class="col-6">
                   63:12:10
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    Total Pause time : 
                </div>
                <div class="col-6">
                   03:12:10
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    Pauses : 
                </div>
                <div class="col-6">
                   63%
                </div>
            </div>
        </div>
        <div class="col-4 product-dark p-3 border-end border-white">
            <div class="row mb-2">
                <div class="col-6">
                    Total tasks time : 
                </div>
                <div class="col-6">
                   63:12:10
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    Productivity : 
                </div>
                <div class="col-6">
                  20%
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                   Workers efficiency : 
                </div>
                <div class="col-6">
                   63%
                </div>
            </div>
        </div>
        <div class="col-4 product-dark p-3 border-end border-white">
            <div class="row mb-2">
                <div class="col-6">
                    No of deficiencies : 
                </div>
                <div class="col-6">
                   0
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    Deficiencies : 
                </div>
                <div class="col-6">
                  23%
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    No of finished products : 
                </div>
                <div class="col-6">
                   63%
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3" style="background-color: #d9e1e7">
            <span class="fw-bold fs-5">Summary by worker</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Worker</th>
                    <th>Time at work</th>
                    <th>Clock-out</th>
                    <th>Pauses</th>
                    <th>Work time</th>
                    <th>Work time on tasks with norm</th>
                    <th>Estimated working time</th>
                    <th>Productivity</th>
                    <th>Workers efficiency</th>
                    <th>Pauses</th>
                    <th>Deficiencies</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                    <td>87</td>
                 </tr>
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                    <td>87</td>
                 </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3">
            <span class="fs-4 fw-bold mb-2">Production total hours</span>
            <div id="productionHoursChart"></div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3">
            <span class="fs-4 fw-bold mb-2">Production indicators</span>
            <div id="productionIndicatorsChart"></div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3" style="background-color: #d9e1e7">
            <span class="fw-bold fs-5">Summary machine/Operations</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Machine/Operation</th>
                    <th>Work time</th>
                    <th>Work time on tasks with norm</th>
                    <th>Setup time</th>
                    <th>Estimated working time</th>
                    <th>Quantity</th>
                    <th>Pcs/h</th>
                    <th>Efficiency</th>
                    <th>Settings</th>
                    <th>Deficiencies</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                 </tr>
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                 </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3">
            <span class="fs-4 fw-bold mb-2">Machine - total hours</span>
            <div id="machineTotalHoursChart"></div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3" style="background-color: #d9e1e7">
            <span class="fw-bold fs-5">Summary for worker Alvin</span>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Time at work</th>
                    <th>Pauses</th>
                    <th>Work time</th>
                    <th>Work time on estimated norm</th>
                    <th>Estimated working time</th>
                    <th>Productivity</th>
                    <th>Workers efficiency</th>
                    <th>Pauses</th>
                    <th>Deficiencies</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                 </tr>
                 <tr>
                    <td>Patrycja Kowalska</td>
                    <td>23:59:21</td>
                    <td>23:59:21</td>
                    <td>0</td>
                    <td>10</td>
                    <td>26</td>
                    <td>89</td>
                    <td>0</td>
                    <td>-</td>
                    <td>56</td>
                 </tr>
                </tbody>
              </table>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 p-3">
            <span class="fs-4 fw-bold mb-2">Report: Alvin (Daily)</span>
            <div id="dailyChart"></div>
        </div>
    </div>

</div>

@endsection