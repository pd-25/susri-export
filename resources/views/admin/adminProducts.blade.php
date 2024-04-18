<style>
    img.uploaded-images {
    width: 80px !important;
    height: 60px !important;
    margin: 4%;
    border: 1px solid black;
    border-radius: 4px !important;
    padding: 5px;
}
</style>

<x-adminheader />
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Top Products</p>

                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addnewModal">
                            Add New
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addnewModal" tabindex="-1" aria-labelledby="addnewmodalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addnewmodalLabel">Add New Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/addnew-product" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name" placeholder="Enter Product Name" class="form-control mb-2">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" placeholder="Enter Description" class="form-control mb-2">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" placeholder="Enter Price" class="form-control mb-2">
                                            <label for="image">Image</label>
                                            <input type="file" name="images[]" multiple accept="image/*" class="form-control mb-2">

                                            <input type="submit" name="save" class="btn btn-success rounded" value="Save Now">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless mt-2">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Price</th>
                                        <th>Updated-at</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($products as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td class="font-weight-bold">{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td class="font-weight-bold">Rs-{{$item->price}}</td>
                                        <td>{{$item->updated_at}}</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">Updated</div>
                                        </td>
                                        <td>
                                            @if(!empty($item->image))
                                            <img src="{{ asset($item->image[0]) }}" width="200px" alt="img">
                                            @endif
                                        </td>

                                        <td class="font-weight-medium">
                                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editBtn{{$i}}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editBtn{{$i}}" tabindex="-1" aria-labelledby="editbtnLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editbtnLabel">Edit Your Product</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/update-product" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <label for="name">Product Name</label>
                                                                <input type="text" name="name" value="{{$item->name}}" placeholder="Enter Product Name" class="form-control mb-2">
                                                                <label for="description">Description</label>
                                                                <input type="text" name="description" value="{{$item->description}}" placeholder="Enter Description" class="form-control mb-2">
                                                                <label for="price">Price</label>
                                                                <input type="text" name="price" value="{{$item->price}}" placeholder="Enter Price" class="form-control mb-2">
                                                                <label for="image">Image</label>
                                                                <input type="file" name="images[]" multiple accept="image/*" class="form-control mb-2">

                                                                <input type="hidden" name="id" value="{{$item->id}}" id="">
                                                                <div class="row">
                                                                @if(!empty($item->image))
                                                                @foreach($item->image as $image)
                                                                
                                                                <img class="uploaded-images" src="{{ asset($image) }}" width="200px" alt="img">

                                                                @endforeach
                                                                @endif
                                                                </div>
                                                                <input type="submit" name="save" class="btn btn-success rounded" value="Save Changes">
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="{{ route('delete.product', ['id' => $item->id]) }}" class="btn btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->

    <x-adminfooter />


