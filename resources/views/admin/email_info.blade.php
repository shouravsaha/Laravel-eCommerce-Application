<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="/public">
    @include('admin.css');

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 style="text-align: center; font-size: 25px;">Send Email to {{$order->email}}</h1>
                <div style="padding-left: 35%; padding-top: 30px;">
                    <label>Email Greeting</label>
                    <input type="text" name="greeting">
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>
