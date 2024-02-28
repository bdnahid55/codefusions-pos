@extends('layouts.master')
@section('title', 'All Category')
@section('content')
    <div class="m-2"></div>
    <div class="card mb-4">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-6">
                    <i class="fas fa-table me-1"></i>All Category
                </div>
                <div class="col-6 text-right">
                    <button style="margin-right:5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete
                        selected</button>
                    <a class="btn btn-success " href="javascript:void(0)" id="createNew">Create</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Check Box</th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>

    {{-- modal section  --}}
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="Form" name="Form" class="form-horizontal">
                        {{-- Error message --}}
                        <div class="alert alert-danger print-error-msg" id="print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        {{-- End Error message --}}

                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-12">
                                <select id="is_active" name="is_active" class="form-select" aria-label="Default select"
                                    required="">
                                    <option></option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- script  --}}

@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.data-table').DataTable({
                dom: 'Bflrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                autoWidth: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNew').click(function() {
                $('#saveBtn').val("create");
                $('#saveBtn').html("Create");
                // code for Hide error message section
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'none');
                // Code End for Hide error message section
                $('#id').val('');
                $('#Form').trigger("reset");
                $('#modelHeading').html("Create New");
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.edit', function() {
                // code for Hide error message section
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'none');
                // Code End for Hide error message section
                $('#saveBtn').html("Update");
                var id = $(this).data('id');
                $.get("{{ route('category.index') }}" + '/' + id + '/edit', function(
                    data) {
                    $('#modelHeading').html("Edit data");
                    $('#saveBtn').val("edit");
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#is_active').val(data.is_active);
                })
            });

            /*------------------------------------------
            --------------------------------------------
            Create Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                //$(this).html('Sending..');

                $.ajax({
                    data: $('#Form').serialize(),
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            $('#Form').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            $(".print-error-msg").find("ul").html('');
                            $(".print-error-msg").css('display', 'none');
                            table.draw();

                            // ----- Notification toast -----
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Data saved successfully"
                            });
                            // -----------------------------------

                        } else {
                            printErrorMsg(data.error);
                            const Toast1 = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast1.fire({
                                icon: "error",
                                title: "Something is wrong !!!"
                            });
                        }

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
                // show errors list
                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }


            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.delete', function() {

                var id = $(this).data("id");
                swal.fire({
                    title: "Delete?",
                    icon: 'question',
                    text: "Are You sure want to delete !",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                }).then(function(e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            type: 'DELETE',
                            url: "{{ route('category.store') }}" + '/' + id,
                            data: {
                                _token: CSRF_TOKEN
                            },
                            dataType: 'JSON',
                            success: function(results) {
                                if (results.success === true) {
                                    swal.fire("Done!", results.message, "success");
                                    // refresh table after 2 seconds
                                    setTimeout(function() {
                                        //location.reload();
                                        table.draw();
                                    }, 1000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            }
                        });

                    } else {
                        e.dismiss;
                    }

                }, function(dismiss) {
                    return false;
                })
            }); // End of Delete Product Code

            // end of code
        });

        // Delete selected
        $('.delete-all').on('click', function(e) {

            var idsArr = [];
            $(".checkbox:checked").each(function() {
                idsArr.push($(this).attr('data-id'));
            });
            if (idsArr.length <= 0) {

                // --------- Alert message if no item is checked ----------------------
                // alert("Please select at least one data to delete.");
                const Toast2 = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast2.fire({
                    icon: "error",
                    title: "Please select at least one data to delete !!!"
                });

                // ---------- End of Alert message -----------------
            } else {
                if (confirm("Are you sure, you want to delete the selected data?")) {
                    var strIds = idsArr.join(",");
                    $.ajax({
                        url: "{{ route('delete-multiple-category') }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + strIds,
                        success: function(data) {
                            if (data.success === true) {
                                var oTable = $('.data-table').dataTable();
                                oTable.fnDraw(false);
                            } else {
                                swal.fire("Error!", data.message, "error");
                            }
                            ////////////////////////////////////////////////////
                            // if (data['status'] == true) {
                            //     $(".checkbox:checked").each(function() {
                            //         $(this).parents("tr").remove();
                            //     });

                            //     alert(data['success']); // show success message

                            //     var mytable = $('.data-table').dataTable();
                            //     mytable.ajax.reload(null, false);
                            //     //oTable.fnDraw(false);
                            // } else {
                            //     alert('Whoops Something went wrong!!');
                            // }
                            ///////////////////////////////////////////////////////
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                }
            }

        });
    </script>
@endsection
