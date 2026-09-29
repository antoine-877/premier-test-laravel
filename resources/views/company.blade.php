<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
     <h1>L'entreprise</h1>
     <ul>
        @foreach ($infos as $label=>$info)
            <li>{{$label}}:{{$info}}</li>
        @endforeach
     </ul>
</div>
