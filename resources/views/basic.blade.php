<!DOCTYPE html>
<html>
<head>
  <title>Graph 11.2.3</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="site-url" content="{{ url('/') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css" />
  
</head>
<body id="App"> 

  <div class="container-fluid padding-tb-10" v-if="page=='Login'">
    <div class="row">
      <div class="col-sm-12">
        @include('login')
      </div>
    </div>
  </div>

  <div class="container-fluid padding-tb-10" v-if="page!='Login'">
    <div class="row">
      <div class="col-sm-1 report left np">
        @include('left')
      </div>
      <div class="col-sm-10">
        @include('top')
        @yield('content')
      </div>
      <div class="col-sm-1 report right np">
        @include('right')
      </div>
    </div>
  </div>

  <div class="loader" v-if="loader=='true'">
    <div class="book">
      <div class="book__page"></div>
      <div class="book__page"></div>
      <div class="book__page"></div>
    </div>
  </div>

  @include('invoice.index')
  @include('sales.index')
  @include('chalan.index')
  @include('offer.index')
  @include('perchase.index')
  @include('return.index')

  @include('account.index')
  @include('product.index')
  @include('customer.index')
  @include('supplier.index')
  
  @include('slip.slip')

  @include('owner.index')
  @include('asset.index')
  @include('expense.index')
  @include('loan.index')

  @include('ledger.index')
  @include('ledger_order.index')
  @include('ledger_due.index')
  @include('ledger_wages.index')
  @include('ledger_cash.index')

  @include('report.report')

  @include('employe.index')
  @include('wages.index')
  
  @include('service.index')

  @include('user.index')
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/bootbox.min.js"></script>
  <script src="js/vue.js"></script>
  <script src="js/script.js"></script>
  <script src="js/_invoice.js"></script>
  <script src="js/_sales.js"></script>
  <script src="js/_chalan.js"></script>
  <script src="js/_offer.js"></script>
  <script src="js/_perchase.js"></script>
  <script src="js/_return.js"></script>

  <script src="js/_account.js"></script>
  <script src="js/_product.js"></script>
  <script src="js/_customer.js"></script>
  <script src="js/_supplier.js"></script>

  <script src="js/_slip.js"></script>

  <script src="js/_owner.js"></script>
  <script src="js/_expenseaccount.js"></script>
  <script src="js/_loanaccount.js"></script>
  <script src="js/_assetaccount.js"></script>

  <script src="js/_ledger.js"></script>
  <script src="js/_ledger_order.js"></script>
  <script src="js/_ledger_due.js"></script>
  <script src="js/_ledger_wages.js"></script>
  <script src="js/_ledger_cash.js"></script>

  <script src="js/_report.js"></script>

  <script src="js/_employe.js"></script>
  <script src="js/_wages.js"></script>

  <script src="js/_user.js"></script>

  <script src="js/_service.js"></script>

  <script src="js/_app.js"></script>
</body>
</html>