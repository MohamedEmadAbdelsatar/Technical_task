                    <h2>Exam Page</h2>
                <h3>Subject: {{$exam->name}}</h3>

            @php $main_question = 1; $index=1; @endphp
            @foreach($questions as $question)
                @if($loop->index == 0 || $loop->index % 3 == 0 )
                    <p>{{$main_question}}  Question</p>
                    @php $main_question++; $index=1; @endphp
                @endif
                <p>{{$index}}. {{$question->body}}</p>
                <ul>
                    @foreach($question->answers as $answer)
                        <li style="padding-top:0px;font-size:18px;"> {{$answer->body}}</li>
                    @endforeach
                </ul>
                @php $order++ @endphp
            @endforeach


