<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      @include('home.css')
   </head>
   <body>
        @include('sweetalert::alert')
        <div class="hero_area">
         <!-- header section strats -->
        @include('home.header');
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider');
         <!-- end slider section -->
        </div>
        @include('home.why');
        <!-- arrival section -->
        @include('home.new_arival');
        <!-- end arrival section -->
        <!-- product section -->
        @include('home.product');
         <!-- end product section -->

        {{-- Start comment and reply system --}}
          <div style="text-align: center; padding-bottom: 30px;">
            <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
            <form action="">
                <textarea style="height: 150px; width: 600px;" placeholder="Comment something here"></textarea>
                <br>
                <a href="" class="btn btn-primary">Comment</a>
            </form>
          </div>
          <div style="padding-left: 20%;">
            <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
            <div>
                <b>Shourav</b>
                <p>This is my first comment</p>
                <a href="javascript::void(0);" onclick="reply(this)">Reply</a>
            </div>
            <div>
                <b>Azam Khan</b>
                <p>This is my second comment</p>
                <a href="javascript::void(0);" onclick="reply(this)">Reply</a>
            </div>
            <div>
                <b>Junayed</b>
                <p>This is my third comment</p>
                <a href="javascript::void(0);" onclick="reply(this)">Reply</a>
            </div>
            <div style="display: none;" class="replyDiv">
                <textarea style="height: 100px; width: 500px;" placeholder="write something here"></textarea>
                <a href="" class="btn btn-primary">Reply</a>
              </div>
          </div>

        {{-- End comment and reply system --}}

        <!-- subscribe section -->
        @include('home.subscribe');
        <!-- end subscribe section -->
        <!-- client section -->
        @include('home.client');
        <!-- end client section -->
        <!-- footer start -->
        @include('home.footer');
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            </p>
        </div>
        <script type="text/javascript">
            function reply(caller){
                $('.replyDiv').insertAfter($(caller));
                $('.replydiv').show();
            }
        </script>
        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
    </body>
</html>
