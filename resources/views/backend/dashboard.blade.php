@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('page_name', 'Dashboard')

@section('content')
    <!--begin::Row-->
    <div class="row"> <!--begin::Col-->
        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path
                        d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                    </path>
                </svg> <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i> </a>
            </div> <!--end::Small Box Widget 1-->
        </div> <!--end::Col-->
        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>53<sup class="fs-5">%</sup></h3>
                    <p>Bounce Rate</p>
                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                    </path>
                </svg> <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i> </a>
            </div> <!--end::Small Box Widget 2-->
        </div> <!--end::Col-->
        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                    </path>
                </svg> <a href="#"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i> </a>
            </div> <!--end::Small Box Widget 3-->
        </div> <!--end::Col-->
        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                    </path>
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                    </path>
                </svg> <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i> </a>
            </div> <!--end::Small Box Widget 4-->
        </div> <!--end::Col-->
    </div> <!--end::Row-->
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Online Store Visitors</h3> <a href="javascript:void(0);"
                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                            Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column"> <span class="fw-bold fs-5">820</span> <span>Visitors Over Time</span>
                        </p>
                        <p class="ms-auto d-flex flex-column text-end"> <span class="text-success"> <i
                                    class="bi bi-arrow-up"></i> 12.5%
                            </span> <span class="text-secondary">Since last week</span> </p>
                    </div> <!-- /.d-flex -->
                    <div class="position-relative mb-4">
                        <div id="visitors-chart"></div>
                    </div>
                    <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i
                                class="bi bi-square-fill text-primary"></i> This Week
                        </span> <span> <i class="bi bi-square-fill text-secondary"></i> Last Week
                        </span> </div>
                </div>
            </div> <!-- /.card -->
            <div class="card mb-4">
                <div class="card-header border-0">
                    <h3 class="card-title">Products</h3>
                    <div class="card-tools"> <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Sales</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <img src="{{ asset('backend/assets/img/default-150x150.png') }}" alt="Product 1"
                                        class="rounded-circle img-size-32 me-2">
                                    Some Product
                                </td>
                                <td>$13 USD</td>
                                <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i>
                                        12%
                                    </small>
                                    12,000 Sold
                                </td>
                                <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                            </tr>
                            <tr>
                                <td> <img src="{{ asset('backend/assets/img/default-150x150.png') }}" alt="Product 1"
                                        class="rounded-circle img-size-32 me-2">
                                    Another Product
                                </td>
                                <td>$29 USD</td>
                                <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i>
                                        0.5%
                                    </small>
                                    123,234 Sold
                                </td>
                                <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                            </tr>
                            <tr>
                                <td> <img src="{{ asset('backend/assets/img/default-150x150.png') }}" alt="Product 1"
                                        class="rounded-circle img-size-32 me-2">
                                    Amazing Product
                                </td>
                                <td>$1,230 USD</td>
                                <td> <small class="text-danger me-1"> <i class="bi bi-arrow-down"></i>
                                        3%
                                    </small>
                                    198 Sold
                                </td>
                                <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                            </tr>
                            <tr>
                                <td> <img src="{{ asset('backend/assets/img/default-150x150.png') }}" alt="Product 1"
                                        class="rounded-circle img-size-32 me-2">
                                    Perfect Item
                                    <span class="badge text-bg-danger">NEW</span>
                                </td>
                                <td>$199 USD</td>
                                <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i>
                                        63%
                                    </small>
                                    87 Sold
                                </td>
                                <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-md-6 -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Sales</h3> <a href="javascript:void(0);"
                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                            Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column"> <span class="fw-bold fs-5">$18,230.00</span> <span>Sales Over
                                Time</span>
                        </p>
                        <p class="ms-auto d-flex flex-column text-end"> <span class="text-success"> <i
                                    class="bi bi-arrow-up"></i> 33.1%
                            </span> <span class="text-secondary">Since Past Year</span> </p>
                    </div> <!-- /.d-flex -->
                    <div class="position-relative mb-4">
                        <div id="sales-chart"></div>
                    </div>
                    <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i
                                class="bi bi-square-fill text-primary"></i> This year
                        </span> <span> <i class="bi bi-square-fill text-secondary"></i> Last year
                        </span> </div>
                </div>
            </div> <!-- /.card -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Online Store Overview</h3>
                    <div class="card-tools"> <a href="#" class="btn btn-sm btn-tool"> <i
                                class="bi bi-download"></i> </a>
                        <a href="#" class="btn btn-sm btn-tool"> <i class="bi bi-list"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success fs-2"> <svg height="32" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3">
                                </path>
                            </svg> </p>
                        <p class="d-flex flex-column text-end"> <span class="fw-bold"> <i
                                    class="bi bi-graph-up-arrow text-success"></i> 12%
                            </span> <span class="text-secondary">CONVERSION RATE</span> </p>
                    </div> <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-info fs-2"> <svg height="32" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                                </path>
                            </svg> </p>
                        <p class="d-flex flex-column text-end"> <span class="fw-bold"> <i
                                    class="bi bi-graph-up-arrow text-info"></i> 0.8%
                            </span> <span class="text-secondary">SALES RATE</span> </p>
                    </div> <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <p class="text-danger fs-2"> <svg height="32" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                </path>
                            </svg> </p>
                        <p class="d-flex flex-column text-end"> <span class="fw-bold"> <i
                                    class="bi bi-graph-down-arrow text-danger"></i>
                                1%
                            </span> <span class="text-secondary">REGISTRATION RATE</span> </p>
                    </div> <!-- /.d-flex -->
                </div>
            </div>
        </div> <!-- /.col-md-6 -->
    </div>

@endsection

@push('script')
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const visitors_chart_options = {
            series: [{
                    name: "High - 2023",
                    data: [100, 120, 170, 167, 180, 177, 160],
                },
                {
                    name: "Low - 2023",
                    data: [60, 80, 70, 67, 80, 77, 100],
                },
            ],
            chart: {
                height: 200,
                type: "line",
                toolbar: {
                    show: false,
                },
            },
            colors: ["#0d6efd", "#adb5bd"],
            stroke: {
                curve: "smooth",
            },
            grid: {
                borderColor: "#e7e7e7",
                row: {
                    colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                    opacity: 0.5,
                },
            },
            legend: {
                show: false,
            },
            markers: {
                size: 1,
            },
            xaxis: {
                categories: ["22th", "23th", "24th", "25th", "26th", "27th", "28th"],
            },
        };

        const visitors_chart = new ApexCharts(
            document.querySelector("#visitors-chart"),
            visitors_chart_options
        );
        visitors_chart.render();

        const sales_chart_options = {
            series: [{
                    name: "Net Profit",
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
                },
                {
                    name: "Revenue",
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                },
                {
                    name: "Free Cash Flow",
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
                },
            ],
            chart: {
                type: "bar",
                height: 200,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd", "#20c997", "#ffc107"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            xaxis: {
                categories: [
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                ],
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    },
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#sales-chart"),
            sales_chart_options
        );
        sales_chart.render();
    </script> <!--end::Script-->
@endpush
