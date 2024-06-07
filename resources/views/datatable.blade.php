<x-app-layout>
    <x-slot name="title">Tablero</x-slot>

    @section('main')
    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title">Ejemplo datatable</h1>

                    <div class="app-card app-card-orders-table mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <x-loader/>
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
                                        @for ($i = 0; $i < 100; $i++)
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
                                        @endfor
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