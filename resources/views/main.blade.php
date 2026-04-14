<!DOCTYPE html>
<html lang="en">
<head>
   @include("layouts.head")
</head>
<body>
    <div id="main">
        <div class="row">
            <!-- Begin sidebar -->
            @include("layouts.sidebar")
            <!-- End sidebar -->
            <div class="col-md-10">
                @include("layouts.header")
                @yield("content")
            </div>
        </div>
    </div>
    <!-- End box login -->
    @include("layouts.footer")
    @yield("custom-js")
</body>
</html>