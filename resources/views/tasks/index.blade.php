@extends('tasks.layout')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Laravel 7 CRUD</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('tasks.index') }}"> Create New Task</a>

            </div>

        </div>

    </div>



    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif



    <table  id="table"  class="table table-bordered">
         <thead>
        <tr>
            <th></th>
            <th>No</th>

            <th>Name</th>


            <th width="280px">Action</th>

        </tr>
      </thead>
        <tbody   id="tablecontents">
        @foreach ($tasks as $task)

        <tr  class="row1"  data-id="{{ $task->id }}" draggable="true"  >
            <td ><i class="fa fa-sort"></i></td>
            <td >{{ ++$i }}</td>

            <td>{{ $task->task_name }}</td>



            <td>

                <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">







                    <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>



                    @csrf

                    @method('DELETE')



                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach
      </tbody>
    </table>



    {!! $tasks->links() !!}



    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


@if (isset($tasktoedit))
<form action="{{ route('tasks.update',$tasktoedit->id) }}" method="POST">
@method('PUT')

@else
<form action="{{ route('tasks.store') }}" method="POST">

@endif

        @csrf



         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">
                    @if (isset($tasktoedit))

                    <strong>Edit Task:</strong>
                    <input type="text" name="task_name" value="{{ $tasktoedit->task_name }}" class="form-control" placeholder="Name">
                    <input type="hidden" name="task_priority" value="{{ $tasktoedit->task_priority }}">

                    @else
                    <strong>Create New Task:</strong>

                    <input type="text" name="task_name" class="form-control" placeholder="Name">
                    <input type="hidden" name="task_priority" value="0">
                    @endif
                </div>

            </div>



            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>



    </form>






    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

    <script type="text/javascript">

      $(function () {

        $("#table").DataTable( {
          "paging": false,
           "searching": true,
        });


        $( "#tablecontents" ).sortable({

          items: "tr",

          cursor: 'move',

          opacity: 0.6,

          update: function() {

              sendOrderToServer();

          }

        });


        function sendOrderToServer() {

          var order = [];

          var token = $('meta[name="csrf-token"]').attr('content');

          $('tr.row1').each(function(index,element) {

            order.push({

              id: $(this).attr('data-id'),

              position: index+1

            });

          });


          $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{ url('task-sortable') }}",

                data: {

              order: order,

              _token: token

            },

            success: function(response) {

                if (response.status == "success") {

                  console.log(response);

                } else {

                  console.log(response);

                }

            }

          });

        }

      });

    </script>

@endsection
