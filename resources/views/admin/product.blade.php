<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style>
    .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .cat_font{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color{
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 50px;
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
                <div class="div_center">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                    <h1 class="cat_font">Add Product</h1>
                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="div_design">
                            <label for="">Product Title</label>
                            <input type="text" class="text_color" name="title" placeholder="Write a title" required>
                        </div>
                        <div class="div_design">
                            <label for="">Product Description :</label>
                            <input type="text" class="text_color" name="description" placeholder="Write a description" required>
                        </div>
                        <div class="div_design">
                            <label for="">Product Price :</label>
                            <input type="number" class="text_color" name="price" placeholder="Write a price" required>
                        </div>
                        <div class="div_design">
                            <label for="">Discount Price :</label>
                            <input type="number" class="text_color" name="discount_price" placeholder="Write a Discount is apply" required>
                        </div>
                        <div class="div_design">
                            <label for="">Product Quantity :</label>
                            <input type="number" class="text_color" name="quantity" placeholder="Write a quantity" required>
                        </div>
                        <div class="div_design">
                            <label for="">Product Catagory</label>
                            <select name="catagory" id="" class="text_color" required>
                                <option value="" selected>Add a catagory here</option>
                                @foreach ($catagory as $catagory)
                                    <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_design"
                            <label for="">Product Image Here</label>
                            <input type="file" name="image" required>
                        </div>
                        <div class="div_design">
                            <input type="submit" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script');
        <!-- End custom js for this page -->
  </body>
</html>


