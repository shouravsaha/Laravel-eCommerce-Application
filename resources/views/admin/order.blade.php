<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style>
        .title_deg{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        .table_deg{
            border: 2px solid white;
            width: 100%;
            margin: auto;
            text-align: center;
        }
        .th_deg{
            background: skyblue;
            padding: 10px;
        }
    </style>
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
                <h1 class="title_deg">All Orders</h1>
                <div style="padding-left: 400px; padding-bottom: 30px;">
                    <form action="{{url('/search')}}" method="get">
                    @csrf
                        <input type="text" name="search" style="color:black;" placeholder="Search For Something">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>
                <table class="table_deg">
                    <tr>
                        <th class="th_deg">Name</th>
                        <th class="th_deg">Email</th>
                        <th class="th_deg">Address</th>
                        <th class="th_deg">Phone</th>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Payment Status</th>
                        <th class="th_deg">Delivery Status</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Delivered</th>
                        <th class="th_deg">Print PDF</th>
                        <th class="th_deg">Send Email</th>

                    </tr>
                    @forelse ($order as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->product_title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->payment_status}}</td>
                            <td>{{$order->delivery_status}}</td>
                            <td>
                                <img style="height: 70px; width: 100px;" src="/product/{{$order->image}}" alt="">
                            </td>
                            <td>
                                @if ($order->delivery_status == 'processing')
                                <a href="{{url('delivered', $order->id)}}" onclick="return confirm('ARe you sure this product is delivered !!!')" class="btn btn-primary">Delivered</a>
                                @else
                                    <p>Delivered</p>
                                @endif
                            </td>
                            <td><a href="{{url('print_pdf', $order->id)}}" class="btn btn-primary">Print PDF</a></td>
                            <td>
                                <a href="{{url('send_email', $order->id)}}" class="btn btn-danger">Send Email</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16">No Data Found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>
