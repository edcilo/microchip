<ul>
    @foreach($order->series as $series)
        <li>
            {{ Form::checkbox('ns[]', $series->id, null, ['id'=>'ns'.$series->id]) }}
            {{ Form::label('ns'.$series->id, $series->ns) }}
        </li>
    @endforeach
</ul>
