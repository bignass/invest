@extends('layouts.app')

@section('content')
   <!-- Page Content -->
    <div class="container">
      <!-- Heading Row -->
      <div class="row align-items-center my-5">
        <div class="col-lg-7">
          <img
            class="img-fluid  mb-4 mb-lg-0"
            src="{{asset('storage/uploads/money_pile_dribble_1.gif')}}"
            alt=""
          />
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-5">
          <h1 class="font-weight-light">More Than Billion</h1>
          <p>
            More than a billion? That is how much money you will have after using our services! Don't know how to trade stocks? No worries though, there are a lot of professional stock, forex, indeces traders using our services, so you will be able to copy their trades and build your success in the markets!
          </p>
          <a class="btn btn-dark" style="background-color: #40992b !important; 
                                            border-color: #40992b; !important;
                                            box-shadow: #40992b !important;"
                                            href="/register"> <i class="fa fa-usd"></i> Call to Action!</a>
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->
      

      <!-- Content Row -->
      <div class="row text-center">
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Best Prices</h2>
              <p class="card-text">
                We take no to little commissions for purchasing any of our products or stocks!
              </p>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Copy Trade</h2>
              <p class="card-text">
                If you don't have time to trade, you can copy other successful traders!
              </p>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title">Transparency</h2>
              <p class="card-text">
                Investment regulators are checking us all the time, so your investments are safe with us!
            </p>
            </div>
          </div>
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    
    <!-- Footer -->
    <footer class="py-3 bg-dark footer fixed-bottom">
      <div class="container">
        <p class="m-0 text-center text-white">
          Copyright &copy; MoreThanBillion 2020
        </p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <!--<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
  </body>
</html>
@endsection
