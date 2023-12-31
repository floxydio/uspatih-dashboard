
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Uspatih">

    <title>Uspatih GO - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .bg-uspatih-new {
            background-color: #C12840;
        }
        .shorten-text {
        white-space: nowrap;      
        overflow: hidden;         
        text-overflow: ellipsis;  
        max-width: 200px;         
        }
        #img {
            width: 300px;
            height: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
}
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-uspatih-new sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
               
                <div class="sidebar-brand-text mx-3">Uspatih <sup>GO</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Dashboard Redeem
            </div>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route("main")}}">
                    <i class="fas fa-fw fa-gift"></i>
                    <span>Redeem Data</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{route("setting")}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Redeem Setting</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{route("user_redeem")}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>History User Redeem</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
          

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Cookie::get("name")}}</span>
                          
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row justify-content-between">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Data Redeem</h1>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <button class="btn btn-success" data-toggle="modal"  data-target="#modalAdd">+ Add Redeem</button>
                        </div>
                    </div>
                    
                   <div class="row">
                        <table class="table table-hover">
                            {{-- point,title,picture,quantity,description,active --}}
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Point</th>
                                <th scope="col">Active</th>
                                <th scope="col">Description</th>
                                <th scope="col">CreatedAt</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            @foreach($redeem as $key => $item)
                            <tbody> 
                                <td>{{$key + 1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->point}}</td>
                                @if($item->active == 1)
                                <td><span class="badge badge-pill badge-danger">Non Active</span>
                                </td>
                                @else
                                <td><span class="badge badge-pill badge-success">Active</span>
                                @endif
                               
                                </td>
                                <td class="shorten-text">{{$item->description}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->createdAt)->format('l, jS F Y h:i:s A') }}</td>
                                <td> 
                                    <button  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdit">Edit Data</button>
                                    <a class="btn btn-danger btn-sm" href="{{route("delete.redeem", $item->id)}}" >Delete</a>
                                    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="POST" action="{{route("edit.redeem", $item->id)}}">
                                               @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Judul</label>
                                                <input required type="text" class="form-control" value="{{old("title",$item->title)}}" name="title" placeholder="Masukkan Judul...">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quantity</label>
                                                <input type="text" class="form-control" value="{{old("quantity",$item->quantity)}}" name="quantity" placeholder="Masukkan Quantity...">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Point</label>
                                                <input type="text" class="form-control" value="{{old("point",$item->point)}}" name="point" placeholder="Masukkan Point...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Active</label>
                                                <input  type="text" class="form-control" value="{{old("active",$item->active)}}" name="active" placeholder="Masukkan Status Active...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description</label>
                                                <input type="text" class="form-control" value="{{old("description",$item->description)}}" name="description" placeholder="Masukkan Deskripsi...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Image Redeem</label>
                                               <img id="img" src="{{ old('picture', $item->picture) ? 'http://localhost:8000/uploads/' . $item->picture : '' }}" alt="Image">

                                            </div>

                                            <div style="margin-top: 20px">
                                            <div class="form-group">
                                                <input type="file" accept=".png, .jpg, .jpeg" class="form-control"  name="image" placeholder="Pick Image">
                                            </div>
                                            <div style="margin-top: 50px">
                                            <button  type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                            </div>
            
                                          </div>
                                        </div>
                                      </div>


                                </td>
                             
                            </tbody>
                            @endforeach
                          </table>
                    </div>

                    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{route("create.redeem")}}" enctype="multipart/form-data">
                                   @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Judul</label>
                                    <input required type="text" class="form-control" name="title" placeholder="Masukkan Judul...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="text" class="form-control"  name="quantity" placeholder="Masukkan Quantity...">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Point</label>
                                    <input type="text" class="form-control"  name="point" placeholder="Masukkan Point...">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Active</label>
                                    <input  type="text" class="form-control"  name="active_status" placeholder="Masukkan Status Active...">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control"  name="description" placeholder="Masukkan Deskripsi...">
                                </div>
                                <div class="form-group">
                                    <input type="file" accept=".png, .jpg, .jpeg" class="form-control"  name="image" placeholder="Pick Image">
                                </div>
                                <div style="margin-top: 50px">
                                <button  type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                                </div>

                              </div>
                        </div>
                      </div>


           
                    
                   


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route("logout")}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>