<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <h1>Membres</h1>

    @if (empty($members))
        <p>Aucun membre</p>
    @else
        @foreach ($members as $member)
            <p>
                {{ $loop->iteration }}.
                {{ $member['first_name'] }} -

                @if ($member['age'] >= 18)
                    {{ $member['age'] }} ans
                @else
                    mineur
                @endif
            </p>
        @endforeach
    @endif
</div>
