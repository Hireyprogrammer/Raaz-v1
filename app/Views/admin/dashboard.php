<?= $this->extend("admin/layouts/base"); ?>

<?= $this->section('content'); ?>
<!-- <h2>Welcome...</h2> -->

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-md-5 align-self-center">
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Dashboard
            </li>
          </ol> 
        </nav> 
      </div>
    </div>
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
      <div class="d-flex">
        <div class="dropdown me-2">
          <button class="btn btn-secondary " type="button">
            <?= date('M Y') ?>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body pb-0" style="height:33vh">
          <div class="d-md-flex align-items-center">
            <h4 class="card-title"><?= lang('Site.labels.top_selling_product') ?></h4>

          </div>
          <div id="chart-pie-simple-2"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- Row -->
      <div class="row">
        <div class="col-sm-6">
          <div class="card card-body">
            <!-- Row -->
            <div class="row align-items-center">
              <div class="col-6">
                <h1 class="fw-light"><?= $no_clients ?></h1>
                <h6 class="text-muted mb-0"><?= lang('Site.labels.Clients') ?></h6>
              </div>
              <div class="col-6 text-end align-self-center">
                <i class="fa-solid fa-user" style="font-size:100px"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card card-body">
            <!-- Row -->
            <div class="row align-items-center">
              <div class="col-6">
                <h3 class="fw-light">$<?= $stock_value ?></h3> 
                <h6 class="text-muted mb-0"><?= lang('Site.labels.stockvalue') ?></h6>
              </div>
              <div class="col-6 text-end align-self-center">
                <i class="fa-solid fa-warehouse" style="font-size:100px"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card card-body">
            <!-- Row -->
            <div class="row align-items-center">
              <div class="col-6">
                <h3 class="fw-light">$<?= $netProfit; ?></h3>
                <h6 class="text-muted mb-0"><?= lang('Site.labels.netprofit') ?></h6>
              </div>
              <div class="col-6 text-end align-self-center">
                <i class="fa-solid fa-money-bill-trend-up" style="font-size:100px"></i>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-6">
          <div class="card card-body">
            <!-- Row -->
            <div class="row align-items-center">
              <div class="col-6">
                <h3 class="fw-light">$<?= $today_Sales; ?></h3>
                <h6 class="text-muted mb-0">Today Total Sales</h6>
              </div>
              <div class="col-6 text-end align-self-center">
                <i class="fa-solid fa-dollar-sign" style="margin-right: 8px; animation: bounce 1.5s infinite;color:green;font-size:100px"></i>
                <!-- <i class="fa-solid fa-money-bill-trend-up" style="font-size:100px"></i> -->
              </div>
            </div>
          </div>
        </div>

        

      </div>
    </div>
    <div class="col-lg-12">
      <div class="card w-100 overflow-hidden">
        <div class="card-body pb-8">
          <div class="d-md-flex no-block align-items-center">
            <h4 class="card-title mb-0"><?= lang('Site.labels.last_5_sales') ?></h4>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table stylish-table align-middle text-nowrap">
            <thead>
              <tr>
                <th class="border-bottom fs-3 ps-4">
                  Order No
                </th>
                <th class="border-bottom fs-3">
                  Amount
                </th>
                <th class="border-bottom fs-3">
                  VAT
                </th>
                <th class="border-bottom fs-3">
                  Grand Total
                </th>
                <th class="border-bottom fs-3">
                  STATUS
                </th>
                <th class="border-bottom fs-3">
                  Order Type
                </th>
                <th class="border-bottom fs-3 pe-4">
                  Order Date
                </th>

              </tr>
            </thead>
            <tbody>

              <?php foreach ($last_sales as $sale): ?>

                <tr>
                  <td>#<?= $sale['order_no'] ?></td>
                  <td>$<?= $sale['total'] ?></td>
                  <td>$<?= $sale['vat_amount'] ?></td>
                  <td>$<?= $sale['grand_total'] ?></td>
                  <td><?= $sale['status'] ?></td>
                  <td><?= $sale['order_type'] ?></td>
                  <td><?= $sale['order_date'] ?></td>
                </tr>

              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">

    <div class="col-lg-6 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-md-flex align-items-center no-block">
            <h4 class="card-title"><?= lang('Site.labels.sales_by_category') ?></h4>
            <div class="ms-auto">
              <select class="form-select" id="months_value">
                <?php $waiter_count = 1; ?>
                <?php foreach ($waiters as $waiter): ?>
                  <option <?= ($waiter_count == 1) ? 'selected' : '' ?> value="<?= $waiter['waiter_id'] ?>">
                    <?= $waiter['waiter_name'] ?>
                  </option>
                  <?php $waiter_count++; ?>
                <?php endforeach; ?>
              </select>
            </div> 
          </div>
          <!-- Row -->
          <div class="row mt-4">
            <div class="col-md-9" id="sales-of-the-month-parent">
              <div id="sales-of-the-month" class="m-auto"></div>
              <!-- <div class="round-overlap sales"><i class="mdi mdi-cart"></i></div> -->
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-md-flex align-items-center">
            <h4 class="card-title"><?= lang('Site.labels.incomevsexpense') ?></h4>

          </div>
          <div id="income-of-the-year" class="mx-n2"></div>
        </div>
      </div>
    </div>
    </div>

  </div>



</div>
<script>

  $(document).ready(function () {
    // sales_per_month(0, <?//= json_encode($month_sales['labels']) ?>)
    var cat_val = $('#months_value').val();
    if (cat_val) {
      $.ajax({
        url: '<?= base_url($locale) ?>/admin/sales_by_waiters',
        method: 'POST',
        dataType: 'json',
        data: {
          value: cat_val
        },
        success: function (response) {
          console.log(response.data)
          sales_per_month(response.data, response.labels);
        },
        error: function (xhr, status, error) {
          console.error('Error fetching data:', error);
        }
      });
    }
    $('#months_value').change(function () {
      var selectedValue = $(this).val();

      $.ajax({
        url: '<?= base_url($locale) ?>/admin/sales_by_waiters',
        method: 'POST',
        dataType: 'json',
        data: {
          value: selectedValue
        },
        success: function (response) {
          console.log(response.data)
          sales_per_month(response.data, response.labels);
        },
        error: function (xhr, status, error) {
          console.error('Error fetching data:', error);
        }
      });
    });

    function sales_per_month(data, labels) {
      var option_Sales_of_the_Month = {
        series: [{
          name: 'Sales',
          data: data
        }],
        chart: {
          type: 'bar',
          height: 270,
          offsetY: 20,
          fontFamily: 'inherit',
        },
        dataLabels: {
          enabled: true,
        },
        stroke: {
          width: 2,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          }
        },
        colors: ["var(--bs-success)", "var(--bs-secondary)", "var(--bs-primary)", "#04B440", "#009EFB"],
        tooltip: {
          shared: true,
          intersect: false,
        },
        legend: {
          show: true,
        },
        xaxis: {
          categories: labels,
          title: {
            text: 'Months',
          }
        },
        yaxis: {
          title: {
            text: 'Sales',
          }
        },
        responsive: [
          {
            breakpoint: 1025,
            options: {
              chart: {
                width: 250,
                height: 270,
              },
            },
          },
          {
            breakpoint: 769,
            options: {
              chart: {
                height: 270,
                width: 250,
              },
            },
          },
          {
            breakpoint: 426,
            options: {
              chart: {
                height: 250,
                offsetX: -20,
                width: 250,
              },
            },
          },
        ],
      };

      $('#sales-of-the-month').remove();
      $('#sales-of-the-month-parent').append('<div id="sales-of-the-month" style="width:100%" class="m-auto"></div>');
      console.log(option_Sales_of_the_Month);
      var chart_bar = new ApexCharts(
        document.querySelector("#sales-of-the-month"),
        option_Sales_of_the_Month
      );
      chart_bar.render();
    }



    var prod_sales_per = {
      series: [<?php
      $prodCount = count($prod_per_sales['total_sales']);
      foreach ($prod_per_sales['total_sales'] as $index => $value) {
        echo "" . $value . "";
        if ($index < $prodCount - 1) {
          echo ', ';
        }
      }
      echo ', ' . $prod_per_sales['others'] . '';
      ?>],
      chart: {
        fontFamily: "inherit",
        width: 380,
        type: "pie",
      },
      colors: [
        "#ffae1f",
        "#39b69a",
        "var(--bs-primary)",
        "var(--bs-secondary)",
        "#fa896b",
      ],
      labels: [<?php
      $names = $prod_per_sales['names'];
      $count = count($names);
      foreach ($names as $key => $value) {
        echo "'" . $value . "'";
        if ($key < $count - 1) {
          echo ', ';
        }
      }
      ?>, "others"],
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "bottom",
            },
          },
        },
      ],
      legend: {
        labels: {
          colors: "#a1aab2",
        },
      },
    };

    var chart_pie_simple = new ApexCharts(
      document.querySelector("#chart-pie-simple-2"),
      prod_sales_per
    );
    chart_pie_simple.render();
    var options_Income_of_the_Year = {
      series: [
        {
          name: "expense",
          data: <?= json_encode($income_expenses[1]) ?>,
        },
        {
          name: "Income",
          data: <?= json_encode($income_expenses[2]) ?>,
        },
      ],
      chart: {
        fontFamily: "inherit",
        type: "bar",
        width: 550,
        height: 315,
        offsetY: 10,
        toolbar: {
          show: false,
        },
      },
      grid: {
        show: true,
        strokeDashArray: 3,
        borderColor: "rgba(0,0,0,0.1)",
        xaxis: {
          lines: {
            show: true,
          },
        },
      },
      colors: ["var(--bs-primary)", "var(--bs-success)"],
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "70%",
          borderRadius: 5,
          endingShape: "rounded",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 5,
        colors: ["transparent"],
      },
      xaxis: {
        type: "category",
        categories: <?= json_encode($income_expenses[0]) ?>,
        tickAmount: "16",
        tickPlacement: "on",
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
          style: {
            colors: "#a1aab2",
          },
        },
      },
      yaxis: {
        labels: {
          style: {
            colors: "#a1aab2",
          },
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        theme: "dark",
      },
      legend: {
        show: true,
      },
    };

    var chart_column_basic = new ApexCharts(
      document.querySelector("#income-of-the-year"),
      options_Income_of_the_Year
    );
    chart_column_basic.render();




    var total_revenue = {
      series: [
        { name: "Last Month Sales", data: [] },
        { name: "This Month Sales", data: [] },
      ],
      chart: { fontFamily: "inherit", type: "area", width: '590px', height: 240, toolbar: { show: !1 } },
      plotOptions: {},
      legend: { show: 1 },
      dataLabels: { enabled: !1 },
      fill: { type: "solid", opacity: 0.07, colors: ["#04B440", "#009EFB"] },
      stroke: { curve: "smooth", show: !0, width: 2, colors: ["#04B440", "var(--bs-info)"] },
      xaxis: {
        categories: [],
        axisBorder: { show: !1 },
        axisTicks: { show: !1 },
        tickAmount: 6,
        labels: { rotate: 0, rotateAlways: !0, style: { fontSize: "12px", colors: "#a1aab2" } },
        crosshairs: { position: "front", stroke: { color: ["var(--bs-success)", "var(--bs-info)"], width: 1, dashArray: 3 } },

      },
      yaxis: { max: 120, min: 30, tickAmount: 6, labels: { style: { fontSize: "12px", colors: "#a1aab2" } } },
      states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
      tooltip: {
        theme: "dark",
      },
      colors: ["var(--bs-success)", "var(--bs-info) "],
      grid: { borderColor: "var(--bs-border-color)", strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
      markers: { strokeColor: ["var(--bs-success)", "var(--bs-info)"], strokeWidth: 3 },
    };

    var chart_area_spline = new ApexCharts(
      document.querySelector("#total-revenue"),
      total_revenue
    );
    chart_area_spline.render();

    // -----------------------------------------------------------------------
    // New Clients
    // -----------------------------------------------------------------------


    var options = {
      color: "#adb5bd",
      series: [12, 88],
      labels: ["12", "88"],
      chart: {
        type: "donut",
        height: 95,
        fontFamily: "inherit",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          donut: {
            size: '85%',
            background: 'transparent',
            labels: {
              show: true,
              name: {
                show: true,
                offsetY: 7,
              },
              value: {
                show: false,
              },
              total: {
                show: true,
                color: 'var(--bs-primary)',
                fontSize: '14px',
                fontWeight: "500",
                label: '86',
              },
            },
          },
        },
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      },
      stroke: {
        show: false,
      },
      dataLabels: {
        enabled: false,
      },

      legend: {
        show: false,
      },
      colors: ["var(--bs-primary)", "#9fa0a5",],

      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };

    var chart = new ApexCharts(document.querySelector("#new-clients"), options);
    chart.render();



    // -----------------------------------------------------------------------
    // All Projects
    // -----------------------------------------------------------------------


    var options = {
      color: "#adb5bd",
      series: [20, 80],
      labels: ["20", "80"],
      chart: {
        type: "donut",
        height: 95,
        fontFamily: "inherit",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          donut: {
            size: '85%',
            background: 'transparent',
            labels: {
              show: true,
              name: {
                show: true,
                offsetY: 7,
              },
              value: {
                show: false,
              },
              total: {
                show: true,
                color: 'var(--bs-danger)',
                fontSize: '14px',
                fontWeight: "500",
                label: '248',
              },
            },
          },
        },
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      },
      stroke: {
        show: false,
      },
      dataLabels: {
        enabled: false,
      },

      legend: {
        show: false,
      },
      colors: ["var(--bs-danger)", "#9fa0a5",],

      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };

    var chart = new ApexCharts(document.querySelector("#all-projects"), options);
    chart.render();




    // -----------------------------------------------------------------------
    // New Items
    // -----------------------------------------------------------------------


    var options = {
      color: "#adb5bd",
      series: [30, 70],
      labels: ["30", "70"],
      chart: {
        type: "donut",
        height: 95,
        fontFamily: "inherit",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          donut: {
            size: '85%',
            background: 'transparent',
            labels: {
              show: true,
              name: {
                show: true,
                offsetY: 7,
              },
              value: {
                show: false,
              },
              total: {
                show: true,
                color: 'var(--bs-warning)',
                fontSize: '14px',
                fontWeight: "500",
                label: '352',
              },
            },
          },
        },
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      },
      stroke: {
        show: false,
      },
      dataLabels: {
        enabled: false,
      },

      legend: {
        show: false,
      },
      colors: ["var(--bs-warning)", "#9fa0a5",],

      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };

    var chart = new ApexCharts(document.querySelector("#new-items"), options);
    chart.render();



    // -----------------------------------------------------------------------
    // Invoices
    // -----------------------------------------------------------------------


    var options = {
      color: "#adb5bd",
      series: [60, 40],
      labels: ["60", "40"],
      chart: {
        type: "donut",
        height: 95,
        fontFamily: "inherit",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          donut: {
            size: '85%',
            background: 'transparent',
            labels: {
              show: true,
              name: {
                show: true,
                offsetY: 7,
              },
              value: {
                show: false,
              },
              total: {
                show: true,
                color: 'var(--bs-success)',
                fontSize: '14px',
                fontWeight: "500",
                label: '159',
              },
            },
          },
        },
      },
      grid: {
        show: false,
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      },
      stroke: {
        show: false,
      },
      dataLabels: {
        enabled: false,
      },

      legend: {
        show: false,
      },
      colors: ["var(--bs-success)", "#9fa0a5",],

      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };

    var chart = new ApexCharts(document.querySelector("#invoices"), options);
    chart.render();

  })
</script>
<script src="<?php echo base_url() ?>public/assets/js/apexcharts.min.js"></script>
<!-- <script src="<?php echo base_url() ?>public/assets/js/dashboard2.js"></script> -->
<?= $this->endSection(); ?>