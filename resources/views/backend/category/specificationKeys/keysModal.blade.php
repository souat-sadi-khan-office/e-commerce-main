
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created_by</th>
                                <th>Status</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach ($models as $data )
                            
                       
                        <tbody>
                            <td> {{$data->name}}</td>
                            <td>{{$data->admin->name}}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input data-url="{{route('admin.category.specification.key.status',$data->id)}}" class="form-check-input" type="checkbox" role="switch" name="status" id="status1" {{$data->status ==1 ? 'Cheaked':""}} data-id="{{$data->id}}"></div>
                            </td>
                            <td>
                                <form action="{{ route("admin.category.specification.key.position", $data->id) }}" method="POST" class="ajax-form" data-id="{{$data->id}}">
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="number" name="position" id="position" class="form-control" required value="{{ $data->position}}">
                                        </div>
                            
                                        <div class="col-md-6 mt-1 form-group">
                                            <button class="btn btn-sm btn-soft-success" type="submit" >
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td> <a href="javascript:;" id="delete_item" data-id ="{{ $data->id }}"
                                data-url="{{ route('admin.category.specification.key.delete', $data->id) }}" class="btn btn-soft-danger" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete">
                                <i class="bi bi-trash"></i>
                            </a></td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


