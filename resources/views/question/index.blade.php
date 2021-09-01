@extends('adminlte::page')

@section('title', 'Question Bank')

@section('content_header')
    <h1>Question Bank</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Question</h3>
                </div>
                <form action="{{route('questions.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="body">Question:</label>
                                <input type="text" id="body" name="body" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="level">Difficulty</label>
                                <select name="level" id="level" class="form-control">
                                    <option value="1">Easy</option>
                                    <option value="2">Normal</option>
                                    <option value="3">Hard</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="right">Select Right Answer</label>
                                <select name="right" id="right" class="form-control">
                                    <option value="1">First Answer</option>
                                    <option value="2">Second Answer</option>
                                    <option value="3">Third Answer</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <h4>Answers</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="answer_1">First Answer</label>
                                <input type="text" name="answers[]" id="answer_1" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="answer_2">First Answer</label>
                                <input type="text" name="answers[]" id="answer_2" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="answer_3">First Answer</label>
                                <input type="text" name="answers[]" id="answer_3" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="easy-tab" data-toggle="pill" href="#easy" role="tab" aria-controls="easy" aria-selected="true">Easy</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="normal-tab" data-toggle="pill" href="#normal" role="tab" aria-controls="normal" aria-selected="false">Normal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="hard-tab" data-toggle="pill" href="#hard" role="tab" aria-controls="hard" aria-selected="false">Hard</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="easy" role="tabpanel" aria-labelledby="easy-tab">
                       <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th aria-controls="example2" rowspan="1" colspan="1">index</th>
                                    <th aria-controls="example2" rowspan="1" colspan="1">Question</th>
                                    <th aria-controls="example2" rowspan="1" colspan="1">Answer</th>
                                    <th aria-controls="example2" rowspan="1" colspan="1">Options</th>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                @if($question->level == '1')
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$question->body}}</td>
                                    <td>
                                        @foreach($question->answers as $answer)
                                            @if($answer->right)
                                                {{$answer->body}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('questions.show', $question->id)}}"><i class="fas fa-envelope-open-text" style="font-size: 20px;"></i></a>
                                             - <a href="{{route('questions.edit', $question->id)}}"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                                             - <button type="button" class="btn btn-danger del-btn delete-one" title="مسح" data-url="{{route('questions.destroy', $question->id)}}" style="background-color: transparent;color: red;border: 0px;"><i class="far fa-edit" style="font-size: 20px;"></i></button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                          </table>
                       </div>
                    </div>
                    <div class="tab-pane fade" id="normal" role="tabpanel" aria-labelledby="normal-tab">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-striped table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th aria-controls="example2" rowspan="1" colspan="1">index</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Question</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Answer</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Options</th>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                    @if($question->level == '2')
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$question->body}}</td>
                                        <td>
                                            @foreach($question->answers as $answer)
                                            @if($answer->right)
                                            {{$answer->body}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{route('questions.show', $question->id)}}"><i class="fas fa-envelope-open-text" style="font-size: 20px;"></i></a>
                                             - <a href="{{route('questions.edit', $question->id)}}"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                                             - <button type="button" class="btn btn-danger del-btn delete-one" title="مسح" data-url="{{route('questions.destroy', $question->id)}}" style="background-color: transparent;color: red;border: 0px;"><i class="far fa-edit" style="font-size: 20px;"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                              </table>
                           </div>
                    </div>
                    <div class="tab-pane fade" id="hard" role="tabpanel" aria-labelledby="hard-tab">
                        <div class="col-md-12">
                            <table id="example3" class="table table-bordered table-striped table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th aria-controls="example2" rowspan="1" colspan="1">index</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Question</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Answer</th>
                                        <th aria-controls="example2" rowspan="1" colspan="1">Options</th>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                    @if($question->level == '3')
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$question->body}}</td>
                                        <td>
                                            @foreach($question->answers as $answer)
                                            @if($answer->right)
                                            {{$answer->body}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{route('questions.show', $question->id)}}"><i class="fas fa-envelope-open-text" style="font-size: 20px;" title="show"></i></a>
                                             - <a href="{{route('questions.edit', $question->id)}}"><i class="far fa-edit" style="font-size: 20px;" title="edit"></i></a>
                                             - <button type="button" class="btn btn-danger delete-one" title="delete" data-url="{{route('questions.destroy', $question->id)}}" style="background-color: transparent;color: red;border: 0px;"><i class="far fa-edit" style="font-size: 20px;"></i></button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                              </table>
                           </div>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
        </div>
    </div>
@stop



@section('js')
    <script src="https://kit.fontawesome.com/06e86d86b9.js" crossorigin="anonymous"></script>
    <script>
        $('#example1', '#example2', '#example3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('body').on('click', '.delete-one', function () {
                let url = $(this).data('url');
                Swal.fire({
                    title: "Are You Sure?",
                    text: "Do You Want to Delete this Question?",
                    type: "question",
                    showCancelButton: !0,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Delete!",
                    cancelButtonText: "Cancel",
                }).then(function (t) {
                    if (t.value) {
                        let formElement = document.createElement('form');
                        formElement.setAttribute('action', url);
                        formElement.setAttribute('method', 'post');
                        formElement.setAttribute('class', 'd-none');

                        let tokenElement = document.createElement('input');
                        tokenElement.setAttribute('name', '_token');
                        tokenElement.setAttribute('value', '{{ csrf_token() }}');
                        tokenElement.setAttribute('type', 'hidden');

                        formElement.append(tokenElement);

                        let methodElement = document.createElement('input');
                        methodElement.setAttribute('name', '_method');
                        methodElement.setAttribute('value', 'DELETE');
                        methodElement.setAttribute('type', 'hidden');

                        formElement.append(methodElement);

                        $("body").append(formElement);

                        formElement.submit();
                    }
                });
            });
    </script>
@stop
