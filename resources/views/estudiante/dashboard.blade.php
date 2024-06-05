<x-app-layout>
    <x-slot name="title">Tablero</x-slot>

    @section('main')
    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title">Overview</h1>

                    <div class="row g-4 mb-4">
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Total Sales</h4>
                                    <div class="stats-figure">$12,628</div>
                                    <div class="stats-meta text-success">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                                        </svg>
                                        20%
                                    </div>
                                </div>
                                <!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->

                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Expenses</h4>
                                    <div class="stats-figure">$2,250</div>
                                    <div class="stats-meta text-success">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                                        </svg>
                                        5%
                                    </div>
                                </div>
                                <!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Projects</h4>
                                    <div class="stats-figure">23</div>
                                    <div class="stats-meta">Open</div>
                                </div>
                                <!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Invoices</h4>
                                    <div class="stats-figure">6</div>
                                    <div class="stats-meta">New</div>
                                </div>
                                <!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-chart h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h4 class="app-card-title">
                                                Line Chart Example
                                            </h4>
                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <div class="card-header-action">
                                                <a href="charts.html">More charts</a>
                                            </div>
                                            <!--//card-header-actions-->
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//app-card-header-->
                                <div class="app-card-body p-3 p-lg-4">
                                    <div class="mb-3 d-flex">
                                        <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                            <option value="1" selected>
                                                This week
                                            </option>
                                            <option value="2">Today</option>
                                            <option value="3">This Month</option>
                                            <option value="3">This Year</option>
                                        </select>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="canvas-linechart"></canvas>
                                    </div>
                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-chart h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h4 class="app-card-title">
                                                Bar Chart Example
                                            </h4>
                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <div class="card-header-action">
                                                <a href="charts.html">More charts</a>
                                            </div>
                                            <!--//card-header-actions-->
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//app-card-header-->
                                <div class="app-card-body p-3 p-lg-4">
                                    <div class="mb-3 d-flex">
                                        <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                            <option value="1" selected>
                                                This week
                                            </option>
                                            <option value="2">Today</option>
                                            <option value="3">This Month</option>
                                            <option value="3">This Year</option>
                                        </select>
                                    </div>
                                    <div class="chart-container">
                                        <canvas id="canvas-barchart"></canvas>
                                    </div>
                                </div>
                                <!--//app-card-body-->
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->

                    <div class="app-card app-card-orders-table mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <x-loader></x-loader>
                                <table class="table mb-0 text-left d-none" id="myTable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="cell">Order</th>
                                            <th class="cell">Product</th>
                                            <th class="cell">Customer</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="cell">#15346</td>
                                            <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget
                                                    volutpat erat</span></td>
                                            <td class="cell">John Sanders</td>
                                            <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span></td>
                                            <td class="cell"><span class="badge bg-success">Paid</span></td>
                                            <td class="cell">$259.35</td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                        </tr>

                                        <tr>
                                            <td class="cell">#15344</td>
                                            <td class="cell"><span class="truncate">Pellentesque diam imperdiet</span>
                                            </td>
                                            <td class="cell">Teresa Holland</td>
                                            <td class="cell"><span class="cell-data">16 Oct</span><span
                                                    class="note">01:16 AM</span></td>
                                            <td class="cell"><span class="badge bg-success">Paid</span></td>
                                            <td class="cell">$123.00</td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                        </tr>

                                        <tr>
                                            <td class="cell">#15343</td>
                                            <td class="cell"><span class="truncate">Vestibulum a accumsan lectus sed
                                                    mollis ipsum</span></td>
                                            <td class="cell">Jayden Massey</td>
                                            <td class="cell"><span class="cell-data">15 Oct</span><span
                                                    class="note">8:07 PM</span></td>
                                            <td class="cell"><span class="badge bg-success">Paid</span></td>
                                            <td class="cell">$199.00</td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="cell">#15341</td>
                                            <td class="cell"><span class="truncate">Morbi vulputate lacinia neque et
                                                    sollicitudin</span></td>
                                            <td class="cell">Raymond Atkins</td>
                                            <td class="cell"><span class="cell-data">11 Oct</span><span
                                                    class="note">11:18 AM</span></td>
                                            <td class="cell"><span class="badge bg-success">Paid</span></td>
                                            <td class="cell">$678.26</td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
                <!--//container-fluid-->
            </div>
            <!--//app-content-->

        </div>
        <!--//app-wrapper-->
    </x-layouts.dashboard>
    @endsection
</x-app-layout>